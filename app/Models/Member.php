<?php

namespace App\Models;

use App\Models\Provider\ProviderClaim;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
  use HasFactory;

  public function insured_profile()
  {
    return $this->belongsTo('App\Models\InsuredProfile');
  }

  public function claims()
  {
    return $this->hasMany(ProviderClaim::class, 'member_id', 'id');
  }

  // Check if the member has Active status
  public function isActive()
  {
    $account_statuses = get_default_values_from_mastertable('members', 'account_status');
    $active_status = ($account_statuses != 0) ? array_search('Active', $account_statuses) : 1;
    return ($this->account_status == $active_status) ? true : false;
  }

  // Set the member status to Active
  public function setActive()
  {
    $account_statuses = get_default_values_from_mastertable('members', 'account_status');
    $active_status = ($account_statuses != 0) ? array_search('Active', $account_statuses) : 1;
    $this->account_status = $active_status;
    $this->save();
  }

  // Check if the member has Inactive status
  public function isInactive()
  {
    $account_statuses = get_default_values_from_mastertable('members', 'account_status');
    $inactive_status = ($account_statuses != 0) ? array_search('Inactive', $account_statuses) : 2;
    return ($this->account_status == $inactive_status) ? true : false;
  }

  // Set the member status to Inactive
  public function setInactive()
  {
    $account_statuses = get_default_values_from_mastertable('members', 'account_status');
    $inactive_status = ($account_statuses != 0) ? array_search('Inactive', $account_statuses) : 2;

    // If the member is primary isured set all dependents as inactive
    if ($this->isPrimaryInsuredMember()) {
      $first_9_digits_member_no = substr($this->member_number, 0, 9);
      $dependent_members = Member::where('member_number', 'LIKE', $first_9_digits_member_no . '%')
        ->where('member_number', '!=', $this->member_number)
        ->get();

      foreach ($dependent_members as $member) {
        $member->setInactive();
      }
    }

    $this->account_status = $inactive_status;
    $this->save();
  }

  public function familyMembers()
  {
    return Member::where('family_number', $this->family_number)->get();
  }

  public function isPrimaryInsuredMember()
  {
    $member_relationships = get_default_values_from_mastertable('members', 'relationship');
    $primary_insured = ($member_relationships != 0) ? array_search('Primary Insured', $member_relationships) : 0;
    return ($this->relationship == $primary_insured) ? true : false;
  }
}
