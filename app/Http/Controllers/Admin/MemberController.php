<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\EmailTrait;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class MemberController extends Controller
{
    use EmailTrait;

    public function index(Request $request)
    {
        $member_relationships = get_default_values_from_mastertable('members', 'relationship');
        $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;
        $primary_members = [];
        $search = '';

        if($request->search) {
            $search = $request->search;
            $primary_members = Member::join('insured_profiles', 'members.insured_profile_id', '=', 'insured_profiles.id')
                ->whereIn('members.family_number', function ($query) use ($search) {
                    $query->select('family_number')
                    ->from('members')
                    ->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%');
                })
                ->where('members.relationship', '=', $primary_insured)
                ->paginate(10);
        } else {
            $primary_members = Member::join('insured_profiles', 'members.insured_profile_id', '=', 'insured_profiles.id')
                ->select('members.*', 'insured_profiles.email')
                ->where('members.relationship', '=', $primary_insured)
                ->paginate(10);
        }

        $account_statuses = get_default_values_from_mastertable('members', 'account_status');
        return view('admin.members.index')->with(['members' => $primary_members, 'account_statuses' => $account_statuses, 'search' => $search]);
    }

    public function edit(Request $request, $id)
    {
        if(!$id) {
            return Redirect::route('admin.members.index')->with('error_flash_message', 'Select the Primary Insured Member');
        }

        $member = Member::find($id);

        if(!$member || !$member->isPrimaryInsuredMember()) {
            return Redirect::route('admin.members.index')->with('error_flash_message', 'Select the Primary Insured Member');
        }

        $insure_profile = $member->insured_profile()->first();
        $payments = $insure_profile->payments()->get();
        $account_statuses = get_default_values_from_mastertable('members', 'account_status');
        $member_relationships = get_default_values_from_mastertable('members', 'relationship');

        return view('admin.members.edit')
            ->with([
                'member' => $member,
                'insured_profile' => $insure_profile,
                'payments' => $payments,
                'account_statuses' => $account_statuses,
                'member_relationships' => $member_relationships
            ]);
    }

    public function activateMember($id)
    {
        if (!$id) {
            return Redirect::back()->with('error_flash_message', 'Member not found');
        }

        $member = Member::find($id);
        if (!$member || !$member->isPrimaryInsuredMember()) {
            return Redirect::back()->with('error_flash_message', 'Member not found');
        }

        if ($member->isActive()) {
            return Redirect::back()->with('error_flash_message', 'Member is already active');
        }

        $member->setActive();
        return Redirect::back()->with('flash_message', 'Successfully activated the Member');
    }

    public function sendMemberActivationEmail($id)
    {
        if (!$id) {
            return Redirect::back()->with('error_flash_message', 'Member not found');
        }

        $member = Member::find($id);
        if (!$member || !$member->isPrimaryInsuredMember()) {
            return Redirect::back()->with('error_flash_message', 'Member not found');
        }

        if ($member->isActive()) {
            return Redirect::back()->with('error_flash_message', 'Member is already active');
        }

        if (!$member->isPrimaryInsuredMember()) {
            return Redirect::back()->with('error_flash_message', 'Member is not Primary Insured');
        }

        $primaryinsured = $member->insured_profile()->first();
        $html = '<ul>';

        // Get all the family members of the primary member
        $first_9_digits_member_no = substr($member->member_number, 0, 9);
        $dependent_members = Member::where('member_number', 'LIKE', $first_9_digits_member_no . '%')->get();

        foreach ($dependent_members as $member) {
            if ($member->id == $id) {
                continue;
            }
            $status = $member->isActive() ? 'Active' : 'Inactive';
            $html .= '<li>' . $member->first_name . ' ' . $member->last_name . ' - ' . $status . '</li>';
        }

        $html .= '</ul>';

        $send_data_in_mail = [
            'first_name' => $member->first_name,
            'last_name' => $member->last_name,
            'app' => env('APP_NAME'),
            'link' => route('member.login'),
            'content' => $html,
        ];
        $emailtemplate =  $this->FindTemplate('member-account-activation');

        try {
            Mail::send('emails/member/template', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($primaryinsured, $emailtemplate) {
                $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
                $message->to($primaryinsured->email)->subject($emailtemplate->subject);
            });
        } catch (Exception $e) {
            return Redirect::back()->with('error_flash_message', 'Something went wrong in sending the email.');
        }

        return Redirect::back()->with('flash_message', 'Successfully send the activation email to Member');
    }
}
