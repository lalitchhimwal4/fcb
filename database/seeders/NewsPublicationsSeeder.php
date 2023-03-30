<?php

namespace Database\Seeders;

use App\Models\NewsPublication;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NewsPublicationsSeeder extends Seeder
{
    public function run()
    {
        $default_values = [
            [
                'title' => 'Insurance Trends Article',
                'slug' => 'insurance-trends-article-1',
                'type' => 1,
                'short_description' => 'Professionals at two thousand dental clinics and other health-care providers in Ontario have formed a preferred provider network (PPN) that will deliver services to Ontario residents for discounted fees, in a model that will allow employers, other sponsors of group health plans and individuals to achieve savings. FCB Health Network says its contracted providers will be accepting fees for services at 20 to 30 per cent lower than suggested fee schedules from their professional associations.',
                'full_description' => '<h3>Ontario Health &amp; Dental Provider Network preparing to offer discounts on service fees to save money for employers &amp; individuals</h3>
                                        <p><span>P</span>rofessionals at two thousand dental clinics and other health-care providers in Ontario have formed a preferred provider network (PPN) that will deliver services to Ontario residents for discounted fees, in a model that will allow employers, other sponsors of group health plans and individuals to achieve savings.</p>
                                        <p>FCB Health Network says its contracted providers will be accepting fees for services at 20 to 30 per cent lower than suggested fee schedules from their professional associations. Network providers include dentists, dental hygienists and other health professionals, such as chiropractors, physiotherapists, acupuncturists and other practitioners whose services are not covered by OHIP. Instead, their services are billed through group benefit plans or paid for by patients who have no plan coverage.</p>
                                        <div class="promote-sec">
                                            <h2><span>&quot;We want to promote the importance of maintaining your health care, bring patients back into the providers&rsquo; offices and avoid neglect of people&rsquo;s health.&quot;</span></h2>
                                            <span>&ndash; George Grivogiannis Founding President, CEO and dental provider of FCB Health Network</span>
                                        </div>
                                        <p>FCB Health Network calls its program the COVID-19 Health and Dental Relief Program. It is going to be rolled out on January 1, 2021, in Ontario, and the network plans to launch similar programs for other provinces around the same time. Part of the incentive for building the network is to encourage patients to return to their dentists and other health-care providers after the government-mandated shutdowns that took effect earlier this year because of the pandemic. At the same time, the reduced service fees will give a financial break to employers and individuals who are also still trying to recover from COVID-19 impacts.</p>
                                        <p>&ldquo;The economy is still suffering due to COVID-19, and revenues remain down for many businesses,&rdquo; says George Grivogiannis, a former administrator to unionized health and welfare funds and founding president, CEO and dental provider of FCB Health Network. &ldquo;Health-care costs are still growing, and companies continue to fund health benefits for their employees; there is no financial relief in sight for plan sponsors.</p>
                                        <p>&ldquo;We want to promote the importance of maintaining your health care, bring patients back into the providers&rsquo; offices and avoid neglect of people&rsquo;s health,&rdquo; he says. &ldquo;And the longer people wait to return to their health-care providers, the more serious the impact on their health and the more expensive it will be for the health-care system down the road. I predict at least a 20 to 30 per cent increase in cost of care within the next one to two years due to chronic conditions if maintenance/preventative treatments and acute conditions continue to be avoided.&rdquo;</p>
                                        <p>FCB Health Network is encouraging both plan sponsors and individuals who don&rsquo;t have group health plans to enroll in the program and get access to the providers offering their reduced fees. Here is how the program will work for an individual seeking coverage or whose employer enrolls in the network. Consider a dental service that typically costs $100. Under the 30 per cent discount, the dentist will be accepting $70 for fee for service. If your employer plan covers 80 per cent of the service, they will reimburse you for $56 &ndash; resulting in a lower cost for your employer and for you because your co-payment is also lower.</p>
                                        <p>The professional associations for the health-care providers have acknowledged the program, says Mr. Grivogiannis. &ldquo;They have reviewed and recognized this program, and their members are unfettered in joining the network.&rdquo; FCB Health Network is not-for-profit and is not economically incentivized by any third party. Instead, it applies an ethical approach to benefit relief that does not compromise the doctor-patient relationship and its outcome.</p>
                                        <p>FCB Health Network says plan sponsors that enroll pay a licensing fee of five per cent from the savings produced to use the network, and the network will contribute a percentage of the revenue from those fees to the Kidney Foundation. The savings produced for plan sponsors will generate a funding model that will be re-introduced back into the plan for its clients, businesses and their employees.</p>',
                'status' => 1,
            ],
            [
                'title' => 'Question of the week from thought leaders',
                'slug' => 'question-of-the-week-from-thought-leaders-1',
                'type' => 1,
                'short_description' => 'We all have overextended ourselves as we continue to navigate through these uncertain realities. Governments, institutions, individuals, etc., have sacrificed and endlessly continue to contribute aid during this pandemic. Health care costs have spiraled out of control. Our real GDP has plummeted at an annualized rate of 38.7%. There is currently no form of relief in health benefits. First Canadian Benefits (FCB) is putting forth a primary health network that provides benefit relief through contracted health and dental providers.',
                'full_description' => '<h3>What benefit relief is being offered to plan sponsors, businesses, and their employees to aid in this pandemic?</h3>
                                        <p><span>W</span>e all have overextended ourselves as we continue to navigate through these uncertain realities. Governments, institutions, individuals, etc., have sacrificed and endlessly continue to contribute aid during this pandemic. Health care costs have spiraled out of control. Our real GDP has plummeted at an annualized rate of 38.7%. There is currently no form of relief in health benefits. First Canadian Benefits (FCB) is putting forth a primary health network that provides benefit relief through contracted health and dental providers.</p>
                                        <p>Thousands of health and dental providers have enrolled under the FCB delivery of care model to provide relief on fees for services being performed. This relief translates to savings for the plan sponsors and inevitably to Canadian businesses and their employees. FCB Health Network is away from common ownership, as it functions under governance with recommended program guidelines and Schedule of Services that are put forth and recognized by the health and dental provider&rsquo;s professional associations. Procurements utilizing the FCB Health Network for benefit relief are established by the FCB executive team and approved, amended, and/or recommended by a governance board of the Ontario Managed Care Association (OMCA).</p>
                                        <p>We encourage all Payors, Funds, and Industry Affiliates to enroll by visiting our website www.Firstcanadianbenefits.ca. Once enrolled our procurement team will contact you with the terms and conditions.</p>
                                        <p>Processors of health and dental benefits will be adopting, through their plan sponsors, the FCB Health Network, its guidelines, and schedules into their system as they enable FCB as a PPN (Preferred Provider Network) to payors of health and dental employee benefits. We will be rolling out the COVID-19 Health and Dental Relief Program for an effective date, Jan 01, 2021. Please join us in this non incentivized not for profit care model and contribute to FCB&rsquo;s social contract through these unusual times. Enroll now!</p>
                                        <div class="promote-sec">
                                            <h2><span>&quot;FCB pledges $1 billion in benefits relief to Payors of Health and Dental employee benefits. Savings being produced by plan sponsors range between 20-30% on all health and dental claims payable. FCB contributes a percentage of savings back to healthcare/charity.&quot;</span></h2>
                                            <span>&ndash; Answer from George Grivogiannis, CEO, First Canadian Benefits</span>
                                        </div>
                                        <p><button class="btn enrol-btn" onclick="javscript:void(0);">Enroll Now</button></p>',
                'status' => 1,
            ],
            [
                'title' => 'Insurance Trends Article',
                'slug' => 'insurance-trends-article',
                'type' => 2,
                'short_description' => 'Professionals at two thousand dental clinics and other health-care providers in Ontario have formed a preferred provider network (PPN) that will deliver services to Ontario residents for discounted fees, in a model that will allow employers, other sponsors of group health plans and individuals to achieve savings. FCB Health Network says its contracted providers will be accepting fees for services at 20 to 30 per cent lower than suggested fee schedules from their professional associations.',
                'full_description' => '<h3>Ontario Health &amp; Dental Provider Network preparing to offer discounts on service fees to save money for employers &amp; individuals</h3>
                                        <p><span>P</span>rofessionals at two thousand dental clinics and other health-care providers in Ontario have formed a preferred provider network (PPN) that will deliver services to Ontario residents for discounted fees, in a model that will allow employers, other sponsors of group health plans and individuals to achieve savings.</p>
                                        <p>FCB Health Network says its contracted providers will be accepting fees for services at 20 to 30 per cent lower than suggested fee schedules from their professional associations. Network providers include dentists, dental hygienists and other health professionals, such as chiropractors, physiotherapists, acupuncturists and other practitioners whose services are not covered by OHIP. Instead, their services are billed through group benefit plans or paid for by patients who have no plan coverage.</p>
                                        <div class="promote-sec">
                                            <h2><span>&quot;We want to promote the importance of maintaining your health care, bring patients back into the providers&rsquo; offices and avoid neglect of people&rsquo;s health.&quot;</span></h2>
                                            <span>&ndash; George Grivogiannis Founding President, CEO and dental provider of FCB Health Network</span>
                                        </div>
                                        <p>FCB Health Network calls its program the COVID-19 Health and Dental Relief Program. It is going to be rolled out on January 1, 2021, in Ontario, and the network plans to launch similar programs for other provinces around the same time. Part of the incentive for building the network is to encourage patients to return to their dentists and other health-care providers after the government-mandated shutdowns that took effect earlier this year because of the pandemic. At the same time, the reduced service fees will give a financial break to employers and individuals who are also still trying to recover from COVID-19 impacts.</p>
                                        <p>&ldquo;The economy is still suffering due to COVID-19, and revenues remain down for many businesses,&rdquo; says George Grivogiannis, a former administrator to unionized health and welfare funds and founding president, CEO and dental provider of FCB Health Network. &ldquo;Health-care costs are still growing, and companies continue to fund health benefits for their employees; there is no financial relief in sight for plan sponsors.</p>
                                        <p>&ldquo;We want to promote the importance of maintaining your health care, bring patients back into the providers&rsquo; offices and avoid neglect of people&rsquo;s health,&rdquo; he says. &ldquo;And the longer people wait to return to their health-care providers, the more serious the impact on their health and the more expensive it will be for the health-care system down the road. I predict at least a 20 to 30 per cent increase in cost of care within the next one to two years due to chronic conditions if maintenance/preventative treatments and acute conditions continue to be avoided.&rdquo;</p>
                                        <p>FCB Health Network is encouraging both plan sponsors and individuals who don&rsquo;t have group health plans to enroll in the program and get access to the providers offering their reduced fees. Here is how the program will work for an individual seeking coverage or whose employer enrolls in the network. Consider a dental service that typically costs $100. Under the 30 per cent discount, the dentist will be accepting $70 for fee for service. If your employer plan covers 80 per cent of the service, they will reimburse you for $56 &ndash; resulting in a lower cost for your employer and for you because your co-payment is also lower.</p>
                                        <p>The professional associations for the health-care providers have acknowledged the program, says Mr. Grivogiannis. &ldquo;They have reviewed and recognized this program, and their members are unfettered in joining the network.&rdquo; FCB Health Network is not-for-profit and is not economically incentivized by any third party. Instead, it applies an ethical approach to benefit relief that does not compromise the doctor-patient relationship and its outcome.</p>
                                        <p>FCB Health Network says plan sponsors that enroll pay a licensing fee of five per cent from the savings produced to use the network, and the network will contribute a percentage of the revenue from those fees to the Kidney Foundation. The savings produced for plan sponsors will generate a funding model that will be re-introduced back into the plan for its clients, businesses and their employees.</p>',
                'status' => 1,
            ],
            [
                'title' => 'Question of the week from thought leaders',
                'slug' => 'question-of-the-week-from-thought-leaders',
                'type' => 2,
                'short_description' => 'We all have overextended ourselves as we continue to navigate through these uncertain realities. Governments, institutions, individuals, etc., have sacrificed and endlessly continue to contribute aid during this pandemic. Health care costs have spiraled out of control. Our real GDP has plummeted at an annualized rate of 38.7%. There is currently no form of relief in health benefits. First Canadian Benefits (FCB) is putting forth a primary health network that provides benefit relief through contracted health and dental providers.',
                'full_description' => '<h3>What benefit relief is being offered to plan sponsors, businesses, and their employees to aid in this pandemic?</h3>
                                        <p><span>W</span>e all have overextended ourselves as we continue to navigate through these uncertain realities. Governments, institutions, individuals, etc., have sacrificed and endlessly continue to contribute aid during this pandemic. Health care costs have spiraled out of control. Our real GDP has plummeted at an annualized rate of 38.7%. There is currently no form of relief in health benefits. First Canadian Benefits (FCB) is putting forth a primary health network that provides benefit relief through contracted health and dental providers.</p>
                                        <p>Thousands of health and dental providers have enrolled under the FCB delivery of care model to provide relief on fees for services being performed. This relief translates to savings for the plan sponsors and inevitably to Canadian businesses and their employees. FCB Health Network is away from common ownership, as it functions under governance with recommended program guidelines and Schedule of Services that are put forth and recognized by the health and dental provider&rsquo;s professional associations. Procurements utilizing the FCB Health Network for benefit relief are established by the FCB executive team and approved, amended, and/or recommended by a governance board of the Ontario Managed Care Association (OMCA).</p>
                                        <p>We encourage all Payors, Funds, and Industry Affiliates to enroll by visiting our website www.Firstcanadianbenefits.ca. Once enrolled our procurement team will contact you with the terms and conditions.</p>
                                        <p>Processors of health and dental benefits will be adopting, through their plan sponsors, the FCB Health Network, its guidelines, and schedules into their system as they enable FCB as a PPN (Preferred Provider Network) to payors of health and dental employee benefits. We will be rolling out the COVID-19 Health and Dental Relief Program for an effective date, Jan 01, 2021. Please join us in this non incentivized not for profit care model and contribute to FCB&rsquo;s social contract through these unusual times. Enroll now!</p>
                                        <div class="promote-sec">
                                            <h2><span>&quot;FCB pledges $1 billion in benefits relief to Payors of Health and Dental employee benefits. Savings being produced by plan sponsors range between 20-30% on all health and dental claims payable. FCB contributes a percentage of savings back to healthcare/charity.&quot;</span></h2>
                                            <span>&ndash; Answer from George Grivogiannis, CEO, First Canadian Benefits</span>
                                        </div>
                                        <p><button onclick="javscript:void(0);" class="btn enrol-btn">Enroll Now</button></p>',
                'status' => 1,
            ],
        ];

        foreach ($default_values as $i => $value) {
            $row = NewsPublication::where("slug", $value['slug'])->first();
            if (isset($row)) {
                $row->title = $value['title'];
                $row->type = $value['type'];
                $row->short_description = $value['short_description'];
                $row->full_description = $value['full_description'];
                $row->status = $value['status'];
                $row->save();
            } else {
                NewsPublication::create([
                    'title' => $value['title'],
                    'slug' => $value['slug'],
                    'type' => $value['type'],
                    'short_description' => $value['short_description'],
                    'full_description' => $value['full_description'],
                    'status' => $value['status'],
                ]);
            }
        }
    }
}
