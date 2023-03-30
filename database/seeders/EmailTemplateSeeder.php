<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        $default_values = [
            1 => [
                'title' => 'Contact Us - Admin',
                'slug' => 'contact-us-admin',
                'subject' => 'Contact Us - Admin',
                'body' => '<section class="email-content cstm-sec">
                                <h1>Hello Admin</h1>
                                <p>Someone wants to connect with you. Here are the details:</p>
                            </section>
                            <section class="cstm-sec email-name">
                                <div class="heading">
                                    <h5>Basic Info</h5>
                                </div>
                                <div>
                                    <p><b>Name</b> {{$name}}</p>
                                    <p><b>Email</b> {{$email}}</p>
                                    <p><b>Subject</b> {{$subject}}</p>
                                    <p><b>Message</b> {{$messagecontent}}</p>
                                </div>
                            </section>',
            ],
            2 => [
                'title' => 'Contact Us - User',
                'slug' => 'contact-us-user',
                'subject' => 'Contact Us - User',
                'body' => '<table align="center" border="1" cellpadding="1" cellspacing="1" style="width: 500px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">{{$name}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td>{{$subject}}</td>
                                    </tr>
                                    <tr>
                                        <td>Content</td>
                                        <td>{{$messagecontent}}</td>
                                    </tr>
                                </tbody>
                            </table>',
            ],
            3 => [
                'title' => 'Member Enrollment - Password',
                'slug' => 'member-enrollment-password',
                'subject' => 'System Generated Member Passsword',
                'body' => '<p>Hi {{$fname}} {{$lname}}</p>
                            <p>Here are your credentails to login in member dashboard:</p>
                            <p>FCB ID: {{$fcbid}}</p>
                            <p>Password: {{$password}}&nbsp;</p>
                            <p>Thanks</p>
                            <p>FCB Network</p>',
            ],
            4 => [
                'title' => 'Member Forgot - Password',
                'slug' => 'member-forgot-password',
                'subject' => 'Forgot Password',
                'body' => '<h1>Reset Password Link</h1>
                            <p>Hi {{$first_name}} {{$last_name}}</p>
                            <p>To reset your password click on following link: <a href="{{$reset_password_link}}">Click Here</a></p>
                            <p>Thanks</p>
                            <p>FCB Network</p>',
            ],
            5 => [
                'title' => 'Provider Enrollment - Password',
                'slug' => 'provider-enrollment-password',
                'subject' => 'FCB Health Network',
                'body' => '<p>Hello {{$fname}} {{$lname}}</p>
                            <p>Thank you for joining the FCB Health Network.</p>
                            <p>Below are are your credentials to login into the provider dashboard:</p>
                            <p>FCB Provider ID: {{$fcbid}}</p>
                            <p>Password: {{$password}}&nbsp;</p>
                            <p>Thank You</p>
                            <p>FCB Network</p>',
            ],
            6 => [
                'title' => 'Member Status Active',
                'slug' => 'member-status-active',
                'subject' => 'Membership status changed to Active',
                'body' => '<p>Hi {{$first_name}} {{$last_name}},</p>
                            <p>Your membership status has changed to <strong>Active</strong> in {{$app}}. Please click <a href="{{$link}}">here</a> to login to your dashboard to see the changes.</p>
                            <p>You will need to login and change the account status of any dependent(s) or other members associated to you. The following changes were made to the accounts listed below:<br />{{$content}}</p>
                            <p>Thanks,<br />FCB Network</p>',
            ],
            7 => [
                'title' => 'Member Status Inactive',
                'slug' => 'member-status-inactive',
                'subject' => 'Membership status changed to Inactive',
                'body' => '<p>Hi {{$first_name}} {{$last_name}},</p>
                            <p>Your membership status has changed to <strong>Inactive</strong> in {{$app}}. Please click <a href="{{$link}}">here</a> to login to your dashboard to see the changes.</p>
                            <p>Any dependent(s) or other members associated to you are also set to <strong>Inactive</strong>. The following accounts were set to <strong>Inactive</strong>:<br />{{$content}}</p>
                            <p>Thanks,<br />FCB Network</p>',
            ],
            8 => [
                'title' => 'Member Account Activation',
                'slug' => 'member-account-activation',
                'subject' => 'Subscribe to FCB to Activate Membership',
                'body' => '<p>Hi {{$first_name}} {{$last_name}},</p>
                            <p>Please click the below link to pay for your {{$app}} Subscription:<br /><a href="{{$link}}">{{$link}}</a></p>
                            <p>Once the payment is made, your account will be activated. You will need to login and change the account status of any dependent(s) or other members associated to you. The following are the members associated to you:<br />{{$content}}</p>
                            <p>Thanks,<br />FCB Network</p>',
            ],
        ];

        foreach ($default_values as $i => $value) {
            $row = DB::table('email_templates')->where("slug", $value['slug'])->first();
            if (isset($row)) {
                DB::table('email_templates')->where("slug", $value['slug'])->update([
                    'title' => $value['title'],
                    'subject' => $value['subject'],
                    'body' => $value['body'],
                ]);
            } else {
                DB::table('email_templates')->insert([
                    'title' => $value['title'],
                    'slug' => $value['slug'],
                    'subject' => $value['subject'],
                    'body' => $value['body'],
                ]);
            }
        }
    }
}
