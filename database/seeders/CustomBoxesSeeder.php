<?php

namespace Database\Seeders;

use App\Models\CustomBox;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomBoxesSeeder extends Seeder
{
    public function run()
    {
        $default_values = [
            [
                'type' => 'homepage',
                'title' => 'Providers',
                'slug' => 'providers',
                'description' => 'We take great pride in our health network of registered health care professionals who serve our partners with the highest level of quality service at contracted rates.',
                'button_text' => 'Enroll Now',
                'button_link' => '/provider/enroll/step1',
                'status' => 1,
            ],
            [
                'type' => 'homepage',
                'title' => 'Payors',
                'slug' => 'payors',
                'description' => 'Public members, insurers, 3rd party administrators (TPAs), corporations, benefit consultants, brokers, organizations, and government are all referred to as payors in the FCB Health Network.',
                'button_text' => 'Enroll Now',
                'button_link' => '/fcb/enroll',
                'status' => 1,
            ],
            [
                'type' => 'homepage',
                'title' => 'Members',
                'slug' => 'members',
                'description' => 'Giving you access to the First Canadian Benefits Health Network that provides complete high quality healthcare services at contracted discounted rates.',
                'button_text' => 'Enroll Now',
                'button_link' => '/member/enroll/step1',
                'status' => 1,
            ],
            [
                'type' => 'agents-brokers',
                'title' => 'Savings',
                'slug' => 'savings',
                'description' => 'FCB integrates a contracted health network of providers, under clinical governance, to provide payors savings in compliance to industry standards. FCB integrates provider services as it offers its proprietary health network under suggested program guidelines to payors. Payors savings produced are between 20-30% on claims payable.',
                'button_text' => null,
                'button_link' => null,
                'status' => 1,
            ],
            [
                'type' => 'agents-brokers',
                'title' => 'Accessibility',
                'slug' => 'accessibility',
                'description' => 'FCB’s website is designed to give you immediate access to the information that agents/brokers request the most. FCB is here to serve you in order to assist you in meeting the ongoing needs of your clients. We will interact with you and your clients as much or as little as you choose.',
                'button_text' => null,
                'button_link' => null,
                'status' => 1,
            ],
            [
                'type' => 'agents-brokers',
                'title' => 'Support',
                'slug' => 'support',
                'description' => 'We can simply provide you with the data and information that you need to present the FCB Health Network and introduce network solutions to your clients, either way we are available to assist you with any employer meeting, finalist presentation, employee enrolment or educational meeting if asked to do so.',
                'button_text' => null,
                'button_link' => null,
                'status' => 1,
            ],
            [
                'type' => 'providers',
                'title' => 'Become A Provider Today!',
                'slug' => 'become-a-provider-today',
                'description' => 'The First Canadian Benefits Health Network is the largest network in Canada. It offers providers the advantage of size and leverage, with a large patient volume, established relationships with multiple payors, high client retention rate and competitive reimbursements. Please contact us or select Enroll Now to complete the online registration form below. Once registered, providers will be enabling new patients to search and access their clinic for an appointment. Across Canada, employed and unemployed residents will be presenting their FCB Benefit Card outlining plan details and eligibility. FCB plans will reimburse all providers, at the point of service, by submitting claims through the FCB E-Portal.',
                'button_text' => 'Register Here',
                'button_link' => '/fcb/enroll',
                'status' => 1,
            ],
        ];

        foreach ($default_values as $i => $value) {
            $row = CustomBox::where("slug", $value['slug'])->first();
            if (isset($row)) {
                $row->type = $value['type'];
                $row->title = $value['title'];
                $row->description = $value['description'];
                $row->button_text = $value['button_text'];
                $row->button_link = $value['button_link'];
                $row->status = $value['status'];
                $row->save();
            } else {
                CustomBox::create([
                    'type' => $value['type'],
                    'title' => $value['title'],
                    'slug' => $value['slug'],
                    'description' => $value['description'],
                    'button_text' => $value['button_text'],
                    'button_link' => $value['button_link'],
                    'status' => $value['status'],
                ]);
            }
        }
    }
}
