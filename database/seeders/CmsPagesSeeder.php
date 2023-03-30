<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CmsPagesSeeder extends Seeder
{
    public function run()
    {
        $default_values = [
            [
                'title' => 'Privacy Policy',
                'subtitle' => 'Respecting the confidentiality of your personal information is of the utmost importance to us at First Canadian Benefits.',
                'slug' => 'privacy-policy',
                'description' => '<section class="privacy-policy-sec" id="privacy-policy-sec">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12">
                                                <div class="privacy-content">
                                                    <h3>Privacy Policy &amp; Terms of Service</h3>
                                                    <p>During the course of providing services, it is important to collect, record, sort, process, transmit, and otherwise handle personal information. Any personal information gathered is governed and subjected by the privacy standards under <a class="pipeda" href="">PIPEDA</a>.</p>
                                                </div>
                                                <div class="privacy-content" id="information-collected">
                                                    <h3>Information collected and its usage</h3>
                                                    <p>All personal information is collected through a secured channel and is protected from unlawful exposure. All information gathered is limited in access to authorized users only.</p>
                                                </div>
                                                <div class="privacy-content" id="consent">
                                                    <h3>Consent</h3>
                                                    <p>Consent is required for the collection, use, or disclosure of Personal Information except where required or permitted by law. Providing us with your Personal Information is always your choice. However, your decision not to provide certain information may limit our ability to provide you with our products or services. We will not require you to consent to the collection, use, or disclosure of information as a condition to the supply of a product or service, except as required to be able to supply the product or service.</p>
                                                </div>
                                                <div class="privacy-content" id="personal-information">
                                                    <h3>Need of Personal Information</h3>
                                                    <p>Personal information is collected to provide you with the product or service you have requested. Personal information also helps identify users, to communicate with users, and to customize their web experience. The consent to collect and use personal information can be withdrawn at any time, subject to legal and contractual restriction, and a reasonable notice in writing.</p>
                                                    <strong>Samples of information collected but not limited to:</strong>
                                                    <ul>
                                                        <li>Name</li>
                                                        <li>Age</li>
                                                        <li>Contact information: including
                                                            <ul>
                                                                <li>Address</li>
                                                                <li>Email</li>
                                                                <li>Telephone</li>
                                                                <li>Fax</li>
                                                                <li>IP Address</li>
                                                            </ul>
                                                        </li>
                                                        <li>Unique number (for Dentist/Health care provider only)</li>
                                                    </ul>
                                                </div>
                                                <div class="privacy-content" id="sharing-information">
                                                    <h3>Sharing of Information</h3>
                                                    <p>Your information may be shared with our partners to provide you with services you have requested in compliance with all federal and provincial laws. Third Parties are prohibited from using your personal information except to provide these services and are required to maintain the confidentiality of your information. The information can be shared for but not limited to:</p>
                                                    <ul>
                                                        <li>Processing credit card payments</li>
                                                        <li>Advertisements</li>
                                                        <li>Conducting surveys and or contests</li>
                                                        <li>Performing analysis of our customers demographics and services</li>
                                                        <li>Communicating with you, such as by way of telephone, mail, email or survey and/or contest</li>
                                                        <li>Customer service/relationship management</li>
                                                    </ul>
                                                    <p>Information collected is never sold.</p>
                                                </div>
                                                <div class="privacy-content" id="access-to-personal">
                                                    <h3>Access to personal information</h3>
                                                    <p>First Canadian Benefits is mandated to provide access to all personal information maintained about its users. Any request by users to know more about their personal information collected will be responded to within a reasonable time period at no cost to the user. Any request for copies of personal information will incur a handling fee.</p>
                                                </div>
                                                <div class="privacy-content" id="accuracy">
                                                    <h3>Accuracy</h3>
                                                    <p>First Canadian Benefits will try to ensure that Personal Information is as accurate, complete, and up-to-date as is necessary for the purposes for which it is to be used.</p>
                                                </div>
                                                <div class="privacy-content" id="correction-information">
                                                    <h3>Correction of Personal information</h3>
                                                    <p>Any user of the First Canadian Benefits website may request a correction of his/her personal information if the user deems it to be incorrect. All requests have to be made in writing along with adequate proof. All personal information will be corrected within a reasonable period of time and the user will be notified of the changes.</p>
                                                </div>
                                                <div class="privacy-content" id="security">
                                                    <h3>Security</h3>
                                                    <p>First Canadian Benefits will protect Personal Information with safeguards appropriate. First Canadian Benefits will protect all information gathered against theft and loss, as well as unauthorized access, disclosure, copying, use, or modification regardless of the format in which the information is held.</p>
                                                    <p>First Canadian Benefits will make its employees aware of the importance of maintaining the confidentiality of Personal Information and will exercise care in the disposal or destruction of Personal Information to prevent unauthorized parties from gaining access to the information.</p>
                                                </div>
                                                <div class="privacy-content" id="website-security">
                                                    <h3>Website Security</h3>
                                                    <p>Because we value your security, our website features SSL with a digital certificate to enforce a minimum of 128-bit encryption.</p>
                                                </div>
                                                <div class="privacy-content" id="cookies">
                                                    <h3>Cookies</h3>
                                                    <p>We may use cookies to optimize your online experience. Cookies do not collect any personal information and nor is any personal information stored on them. The website assigns a unique ID number to each visitor, which allows the website to recognize repeat users, track patterns, and better serve you when you return to the site.</p>
                                                </div>
                                                <div class="privacy-content" id="third-party">
                                                    <h3>Third-Party Links</h3>
                                                    <p>First Canadian Benefits website may have other third party links, that may provide related and helpful information to the user. Be advised we do not control or operate these sites and are not responsible for them. We recommend that you review their privacy policies before sharing any personal information.</p>
                                                </div>
                                                <div class="privacy-content" id="further-information">
                                                    <h3>Further information and complaints</h3>
                                                    <p>If you require any further information about the privacy policy or have a concern/complain regarding the security of your personal information, please contact:</p>
                                                    <strong>Chief Privacy Officer</strong>
                                                    <p>First Canadian Benefits<br />Privacy Department<br />421 Bloor Street East<br />Suite #206,<br />Toronto, ON<br />M4W 3T1<br />or 416-929-4685</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="quick-jump">
                                                    <h2>Quick Jump</h2>
                                                    <ul>
                                                        <li><a href="#information-collected">Information collected and its usage</a></li>
                                                        <li><a href="#consent">Consent</a></li>
                                                        <li><a href="#personal-information">Need of Personal Information</a></li>
                                                        <li><a href="#sharing-information">Sharing of Information</a></li>
                                                        <li><a href="#access-to-personal">Access to personal information</a></li>
                                                        <li><a href="#accuracy">Accuracy</a></li>
                                                        <li><a href="#correction-information">Correction of Personal information</a></li>
                                                        <li><a href="#security">Security</a></li>
                                                        <li><a href="#website-security">Website Security</a></li>
                                                        <li><a href="#cookies">Cookies</a></li>
                                                        <li><a href="#third-party">Third-Party Links</a></li>
                                                        <li><a href="#further-information">Further information and complaints</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>',
                'meta_title' => 'privacy meta title',
                'meta_keyword' => 'privacy,meta,keyword',
                'meta_description' => 'privacy meta description',
                'status' => 1,
            ],
            [
                'title' => 'Corporate Responsibility',
                'subtitle' => null,
                'slug' => 'corporate-responsibility',
                'description' => '<section class="health-and-dental" id="health-and-dental">
                                    <div class="container">
                                        <div class="ontario-health first-canadian-benefit">
                                            <p>First Canadian Benefits strongly believes in giving back to the community in which it serves. FCB strives to make a positive, long lasting impression by partnering with local charities and other nonprofit organizations. We provide financial backing to these organizations ensuring that we play our part in the assistance of growth and development of community-based programs, so that they can continue making a difference.</p>
                                            <p>FCB has already partnered with various organizations to ensure a future for our children and our community. We believe in giving at home and by supporting local communities, we are able to help each other.</p>
                                            <p>Though we may not be able to resolve all our communities&rsquo; issues, each dollar donated, will ensure we are a responsible corporate citizen.</p>
                                            <p>A percentage of payors savings will be donated to charity contributions on behalf of First Canadian Benefits.</p>
                                            <p>&nbsp;</p><p>&nbsp;</p>
                                        </div>
                                    </div>
                                </section>
                                <section class="corporate-imgs" id="corporate-imgs">
                                    <div class="container">
                                        <div class="imgg">
                                            <figure><img alt="canadian-cancer-society-logo" src="/storage/CkEditorUploads/canadian-cancer-society-logo_1636357599.png" style="width: 346px; height: 100px;" /></figure>
                                            <figure><img alt="frontline-fund" src="/storage/CkEditorUploads/frontline-fund_1636357615.png" /></figure>
                                            <figure><img alt="kidney-foundation" src="/storage/CkEditorUploads/kidney-foundation_1636357638.png" /></figure>
                                        </div>
                                    </div>
                                </section>',
                'meta_title' => null,
                'meta_keyword' => 'corporate,responsibility',
                'meta_description' => null,
                'status' => 1,
            ],
            [
                'title' => 'COVID-19 Health & Dental Relief Plan',
                'subtitle' => null,
                'slug' => 'covid-19-health-dental-relief-plan',
                'description' => '<section class="health-and-dental covid-sec" id="covid-sec">
                                    <div class="container">
                                        <div class="ontario-health">
                                            <p>FCB Health Network is offering a COVID-19 Relief Plan to all payors of Health Care. The FCB Health Network will be producing $1 Billion in benefit relief for all individuals seeking a benefit relief on claims payable.</p>
                                            <p>Access the link below to view our COVID-19 Health and Dental Relief Plan A001</p>
                                            <div class="my-link"><a class="enrol-btn popup-btn" href=""><i class="fas fa-file-pdf"></i> View The COVID-19 Health &amp; Dental Relief Plan</a></div>
                                        </div>
                                    </div>
                                </section>',
                'meta_title' => null,
                'meta_keyword' => null,
                'meta_description' => null,
                'status' => 1,
            ],
        ];

        foreach ($default_values as $i => $value) {
            $row = CmsPage::where("slug", $value['slug'])->first();
            if (isset($row)) {
                $row->title = $value['title'];
                $row->subtitle = $value['subtitle'];
                $row->description = $value['description'];
                $row->meta_title = $value['meta_title'];
                $row->meta_keyword = $value['meta_keyword'];
                $row->meta_description = $value['meta_description'];
                $row->status = $value['status'];
                $row->save();
            } else {
                CmsPage::create([
                    'title' => $value['title'],
                    'subtitle' => $value['subtitle'],
                    'slug' => $value['slug'],
                    'description' => $value['description'],
                    'meta_title' => $value['meta_title'],
                    'meta_keyword' => $value['meta_keyword'],
                    'meta_description' => $value['meta_description'],
                    'status' => $value['status'],
                ]);
            }
        }
    }
}
