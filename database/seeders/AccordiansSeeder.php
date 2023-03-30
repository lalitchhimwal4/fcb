<?php

namespace Database\Seeders;

use App\Models\Accordian;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccordiansSeeder extends Seeder
{
    public function run()
    {
        $default_values = [
            [
                'slug' => 'are-we-required-to-utilize-all-of-the-disciplinesproviders-offered-by-the-fcb-health-network',
                'page_title' => 'agents-brokers',
                'title' => 'Are we required to utilize all of the disciplines/providers offered by the FCB Health Network?',
                'description' => '<p>&nbsp;No, these services can be obtained in whole or in part based upon each client&rsquo;s needs.</p>',
                'status' => 1,
            ],
            [
                'slug' => 'will-fcb-assist-agents-with-presentations-and-employee-education',
                'page_title' => 'agents-brokers',
                'title' => 'Will FCB assist agents with presentations and employee education?',
                'description' => '<p>&nbsp;FCB values its agent partners and will assist with any employer meeting, finalist presentation, employee enrolment or educational meeting when asked by the agent to do so.</p>',
                'status' => 1,
            ],
            [
                'slug' => 'does-fcb-provide-any-claims-adjudication-and-payment-services',
                'page_title' => 'agents-brokers',
                'title' => 'Does FCB provide any claims adjudication and payment services?',
                'description' => '<p>&nbsp;Yes, FCB provides claim adjudication and payment services for its covid 19 health and dental relief plan A001 and/or policies enrolling into the FCB Health Network.</p>',
                'status' => 1,
            ],
            [
                'slug' => 'does-fcb-have-a-payment-structure-for-brokers',
                'page_title' => 'agents-brokers',
                'title' => 'Does FCB have a payment structure for brokers?',
                'description' => '<p>&nbsp;Yes, agents/brokers utilizing the FCB Health Network for their clients will be reimbursed accordingly.</p>',
                'status' => 1,
            ],
            [
                'slug' => 'how-does-an-agent-broker-use-plan-policy-a001-as-a-supplementary-plan',
                'page_title' => 'agents-brokers',
                'title' => 'How does an agent/broker use Plan/policy A001 as a supplementary plan?',
                'description' => '<p>&nbsp;Agents/brokers must first complete the enrollment process to join the FCB health network and read/accept the plan sponsor agreement. Upon successful enrollment into the network, ensure that your client’s members are utilizing Plan/Policy A001 first when submitting a claim to meet industry standards and properly align with coordination of benefits.</p>',
                'status' => 1,
            ],
            [
                'slug' => 'how-will-reference-based-pricing-affect-my-employees',
                'page_title' => 'agents-brokers',
                'title' => 'How will reference based pricing affect my employees?',
                'description' => '<p>&nbsp;Plan members must be informed and engaged throughout their healthcare experience to ensure the right coverage outcome. Asking questions about the cost of a procedure is encouraged. Staying informed about providers who are RBP compliant is recommended. Patients still have a choice in using non-compliant providers but in doing so assume responsibility for the balance beyond the cost ceiling set by RBP.</p>',
                'status' => 1,
            ],
            [
                'slug' => 'how-do-the-payors-members-benefit-from-the-fcb-health-network',
                'page_title' => 'agents-brokers',
                'title' => 'How do the Payors/Members benefit from the FCB Health Network?',
                'description' => '<p>&nbsp;Plan members will receive further coverages with no annual maximum, deductibles, and reduced co-payments under RBP. Members will also have access to affiliated vendors for savings on goods and services, virtual pharmacy, and savings on prescription glasses and hearing aid devices. Payors can see their premiums stabilize by saving up to 30% on all claims payable.</p>',
                'status' => 1,
            ],
        ];

        foreach ($default_values as $i => $value) {
            $row = Accordian::where("slug", $value['slug'])->first();
            if (isset($row)) {
                $row->page_title = $value['page_title'];
                $row->title = $value['title'];
                $row->description = $value['description'];
                $row->status = $value['status'];
                $row->save();
            } else {
                Accordian::create([
                    'slug' => $value['slug'],
                    'page_title' => $value['page_title'],
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'status' => $value['status'],
                ]);
            }
        }
    }
}
