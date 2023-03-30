<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\EmailTrait;
use App\Models\Provider\Provider;
use App\Models\Provider\ProviderOffice;
use App\Models\Provider\ProviderOfficeEnrollment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{
    use EmailTrait;

    public function index()
    {
        return view('admin.import');
    }

    // Called by ajax function in view
    public function importFile(Request $request)
    {
        try {
            $data = $this->import_file($request);
            return response()->json(['success' => true, 'message' => "Successfully imported the file", 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error importing - ' . $e->getMessage()]);
        }
    }

    // Add the imported file under storage/app/test-import to read later
    private function import_file(Request $request)
    {
        if (!$request->file_type) {
            throw new Exception('Select the Import File type');
        }

        $file = $request->file('import_file');
        if (!$file) {
            throw new Exception('Choose a file to import');
        }

        $extension = $file->getClientOriginalExtension();
        $file_name = $file->getClientOriginalName();
        $temp_path = $file->getRealPath();
        $file_size = $file->getSize();
        $location = 'old-data-import';

        // File not csv
        if ($extension != 'csv') {
            throw new Exception('Please upload a csv file');
        }

        // File larger than 2MB
        if ($file_size > 2097152) {
            throw new Exception('Uploaded file should be below 2 MB');
        }

        $file_path = $file->storeAs($location, $file_name, ['disk' => 'local']);

        $file = fopen(storage_path() . '/app/' . $file_path, "r");
        $importData_arr = array();
        $i = 0;
        $headers = [];

        while (($filedata = fgetcsv($file, 0, ",")) !== FALSE) {
            $num = count($filedata);

            // Populate the headers and verify that all the expected ones exist
            if ($i == 0) {
                for ($c = 0; $c < $num; $c++) {
                    $headers[] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $filedata[$c])));
                }

                if (array_diff($this->get_type_headers($request->file_type), $headers)) {
                    throw new Exception("Missing necessary headers in the import file.");
                }
            } else {
                // Populate the import data array
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][$headers[$c]] = $filedata[$c];
                }
            }
            $i++;
        }
        fclose($file);

        $html = '';

        foreach ($importData_arr as $i => $row) {
            try {
                if ($this->import_row($row, $request->file_type)) {
                    $html .= '<div class="import-row-success">Row ' . $i . ' : Successfully added the row</div>';
                }
            } catch (Exception $e) {
                $html .= '<div class="import-row-error">Row ' . $i . ' : ' . $e->getMessage() . '</div>';
            }
        }
        
        if ($request->file_type == 'providers') {
            if ($this->cleanAllLicenseNos()) {
                $html .= '<div class="import-row-success">Successfully cleaned license no of dental providers</div>';
            } else {
                $html .= '<div class="import-row-error">Error cleaning license no of dental providers</div>';
            }
        }

        return $html;
    }

    private function import_row($row, $type)
    {
        if (!$row || !$type) {
            throw new Exception('Error adding new record to the database');
        }

        if (strcmp(strtolower($type), "providers") != 0 && strcmp(strtolower($type), "provider_offices") != 0) {
            throw new Exception('Unknown import file type selected');
        }

        if (strcmp($type, "provider_offices") == 0) {
            $this->create_new_provider_office($row);
        } elseif (strcmp($type, "providers") == 0) {
            $this->create_new_provider_and_enrollment($row);
        }

        return true;
    }

    // Get the headers for each import type
    private function get_type_headers($type)
    {
        if (strcmp($type, "provider_offices") == 0) {
            return ['clinic-name', 'address1', 'address2', 'address3', 'city', 'province', 'postal-code', 'latitude', 'longitude', 'telephone', 'fax', 'email', 'speciality'];
        } elseif (strcmp($type, "providers") == 0) {
            return ['first-name', 'last-name', 'license-number', 'speciality', 'clinic-name', 'address1', 'city', 'telephone'];
        }

        return [];
    }

    private function create_new_provider_office($data)
    {
        // Check if Provider Office with the same name and postal code or email exists
        $provider_office = ProviderOffice::where('clinic_name', $data['clinic-name'])
            ->where('postal_code', $data['postal-code'])
            ->orWhere('email', $data['email'])
            ->first();

        if ($provider_office) {
            throw new Exception('Clinic ' . $data['clinic-name'] . ' already exists with the same address/email');
        }

        // Check if Provider Office exists with the same telephone no
        $provider_office_with_same_telephone = ProviderOffice::where('telephone', $data['telephone'])
            ->first();

        if ($provider_office_with_same_telephone) {
            throw new Exception('Another clinic already exists with the same telephone # ' . $data['telephone']);
        }

        $office_location_number = ProviderOffice::where('location_number', '>', 9999)->get()->max('location_number');
        $full_address = $data['address1'] . ', ' . $data['city'] . ', ' . $data['province'] . ', Canada';

        if (is_null($office_location_number)) {
            $office_location_number = 10000;
        } else {
            $office_location_number++;
        }

        // For Dental Provider Offices set the location no to NULL
        $specility = $this->get_assigning_authority_and_speciality_code($data['speciality']);
        if ($specility) {
            $assigning_authority = DB::table('assigning_authorities')->where('assigning_authority_code_description', $specility['assigning_authority_code_description'])->first();
            if ($assigning_authority && $assigning_authority->assigning_authority_number == 1) {
                $office_location_number = NULL;
            }
        }

        if (empty($data['email'])) {
            throw new Exception('Error importing - no email found');
        }

        try {
            $provider_office = ProviderOffice::create([
                'location_number' => $office_location_number,
                'clinic_name' => $data['clinic-name'],
                'address1' => $full_address ? $full_address : '',
                'address2' => $data['address2'] ? $data['address2'] : '',
                'city' => $data['city'] ? $data['city'] : '',
                'postal_code' => $data['postal-code'] ? $data['postal-code'] : '',
                'province' => $data['province'] ? $data['province'] : '',
                'telephone' => $data['telephone'] ? $data['telephone'] : '',
                'fax' => $data['fax'] ? $data['fax'] : '',
                'email' => $data['email'],
                'latitude' => $data['latitude'] ? $data['latitude'] : NULL,
                'longitude' => $data['longitude'] ? $data['longitude'] : NULL,
                'website' => '',
                'social_media' => serialize([]),
            ]);
        } catch (Exception $e) {
            throw new Exception('Error adding Provider Office');
        }

        if (!$provider_office) {
            throw new Exception("Provider Office not created");
        }

        return true;
    }

    private function create_new_provider_and_enrollment($data)
    {
        $specility = $this->get_assigning_authority_and_speciality_code($data['speciality']);
        if (!$specility) {
            throw new Exception('Error importing - speciality not found');
        }

        $provider_office = ProviderOffice::where('clinic_name', $data['clinic-name'])
            ->where('address1', 'LIKE', substr($data['address1'], 0, 10) . '%')
            ->where('city', $data['city'])
            ->where('telephone', 'LIKE', substr($data['telephone'], 0, 10) . '%')
            ->first();

        $assigning_authority = DB::table('assigning_authorities')->where('assigning_authority_code_description', $specility['assigning_authority_code_description'])->first();
        $assigning_authority_prefix = ($assigning_authority) ? $assigning_authority->assigning_authority_prefix : 'F0';
        $speciality_code = DB::table('speciality_codes')->where('speciality_code_description', $specility['speciality_code_description'])->first();
        $license_no = trim(preg_replace('/[^A-Za-z0-9]+/', '', $data['license-number']));

        // generating fcb registration number to save
        $registration_id = Provider::where('registration_id', 'LIKE', $assigning_authority_prefix . '%')->max('registration_id');
        if (is_null($registration_id)) {
            $registration_id = $assigning_authority_prefix . '0000001';
        } else {
            $registration_id++;
        }

        if (!isset($license_no) || empty($license_no)) {
            $license_no = $registration_id;
        }

        // Check if another Provider exists with the same license no
        $provider_with_same_license = Provider::where('license_number', $license_no)
            ->where(function($query) use ($data) {
                $query->orWhere('first_name', '!=', $data['first-name'])
                    ->orWhere('last_name', '!=', $data['last-name']);
            })
            ->first();

        if ($provider_with_same_license) {
            $license_no = $registration_id;
        }

        // Verify that Provider and Provider Office Enrollment doesn't exist
        $provider = Provider::where('first_name', $data['first-name'])
            ->where('last_name', $data['last-name'])
            ->where('assigning_authority_number', $assigning_authority->assigning_authority_number)
            ->where('license_number', $license_no)
            ->where('speciality_code_number', $speciality_code->speciality_code_number)
            ->first();

        if ($provider) {
            if ($provider_office) {
                $provider_office_enrollment = DB::table('provider_office_enrollments')->where([['office_system_id', $provider_office->id], ['provider_system_id', $provider->id]])->first();
                if ($provider_office_enrollment) {
                    throw new Exception('Provide and Office Enrollment exists');
                }

                $enrollment = ProviderOfficeEnrollment::create([
                    'office_system_id' => $provider_office->id,
                    'provider_system_id' => $provider->id,
                ]);

                if (!$enrollment) {
                    throw new Exception('Error creating Provider Office Enrollment');
                }
            }
            return true;
        }

        // generating password
        $password = "FCB$" . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%@^&!$%@^&"), 0, 6);
        $encodedpassword = Hash::make($password);

        try {
            $provider = Provider::create([
                'license_number' => $license_no,
                'registration_id' => $registration_id,
                'password' => $encodedpassword,
                'registration_date' => date('Y-m-d'),
                'registration_method' => 'Batch',
                'assigning_authority_number' => $assigning_authority->assigning_authority_number,
                'last_name' => $data['last-name'],
                'first_name' => $data['first-name'],
                'speciality_code_number' => $speciality_code->speciality_code_number,
            ]);

            if (!$provider) {
                throw new Exception('Error creating Provider');
            }

            if ($provider_office) {
                $enrollment = ProviderOfficeEnrollment::create([
                    'office_system_id' => $provider_office->id,
                    'provider_system_id' => $provider->id,
                ]);

                if (!$enrollment) {
                    throw new Exception('Error creating Provider Office Enrollment');
                }
            }
        } catch (Exception $e) {
            throw new Exception('Error creating Provider - ' . $e->getMessage());
        }

        // Sending mail to user containing password and fcb id to login
        $send_data_in_mail = array('fname' => $data['first-name'], 'lname' => $data['last-name'], 'password' => $password, 'fcbid' => $registration_id);
        $emailtemplate =  $this->FindTemplate('provider-enrollment-password');

        if ($provider_office && !App::environment('staging')) {
            $send_to_email_address = $provider_office->email;

            try {
                // Send mail to user
                Mail::send('emails/provider/enrollment-password', array_merge($send_data_in_mail, ['template' => $emailtemplate]), function ($message) use ($data, $emailtemplate, $send_to_email_address) {
                    $message->from(Get_Meta_Tag_Value('General_Settings', 'Admin_Email'), env('APP_NAME'));
                    $message->to($send_to_email_address)->subject($emailtemplate->subject);
                });
            } catch (Exception $e) {
                throw new Exception('Error sending email.');
            }
        }

        return true;
    }

    // Get the assigning authority and speciality code
    private function get_assigning_authority_and_speciality_code($data)
    {
        $list = [
            'Acupuncturists' => [
                'assigning_authority_code_description' => 'Acupuncturist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Audiologists/Hearing' => [
                'assigning_authority_code_description' => 'Audiologists/Hearing',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Chiropodists' => [
                'assigning_authority_code_description' => 'Chiropodist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Chiropractors' => [
                'assigning_authority_code_description' => 'Chiropractor',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Clinical Psychologists' => [
                'assigning_authority_code_description' => 'Clinical Psychologist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Dental Practitioners / Specialists' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Denturists' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Denturist',
            ],
            'Endodontics' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Endodontist',
            ],
            'General Dentistry' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'General Dentist' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Massage Therapists' => [
                'assigning_authority_code_description' => 'Massage Therapist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Naturopaths' => [
                'assigning_authority_code_description' => 'Naturopath',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Optometry' => [
                'assigning_authority_code_description' => 'Optometrist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Oral Surgery' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Oral and Maxillofacial Surgeon',
            ],
            'Orthodontics' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Orthodontist',
            ],
            'Osteopaths' => [
                'assigning_authority_code_description' => 'Osteopath',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Pediatric Dentistry' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Pedodontist',
            ],
            'Periodontics' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Periodontist',
            ],
            'Physiotherapists' => [
                'assigning_authority_code_description' => 'Physiotherapist',
                'speciality_code_description' => 'General Practitioner',
            ],
            'Prosthodontics' => [
                'assigning_authority_code_description' => 'Dental Provider/Specialist',
                'speciality_code_description' => 'Prosthodontist',
            ],
        ];
        return array_key_exists($data, $list) ? $list[$data] : false;
    }

    // Called after import to clean the license no of dental providers
    private function cleanAllLicenseNos()
    {
        try {
            $dental_providers = Provider::where('assigning_authority_number', 1)
                ->where('registration_method', 'Batch')
                ->get();

            foreach ($dental_providers as $provider) {
                if (!$this->validate_license_no($provider->license_number, $provider->speciality_code_number)) {
                    $provider->license_number = $provider->registration_id;
                    $provider->save();
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Additional validation for Dental Providers license no
    private function validate_license_no($license_no, $speciality_code)
    {
        if (strlen($license_no) != 8 && strlen($license_no) != 9) {
            return false;
        }

        // validation for dental license no. with speciality codes
        $first_2_digits_license_no = substr($license_no, 0, 2);
        if ($first_2_digits_license_no != '80' && $first_2_digits_license_no != 20) {
            $eighth_digit_license_no = substr($license_no, 7, 1);
            $speciality_code = DB::table('speciality_codes')->where('speciality_code_number', $speciality_code)->first();
            $speciality_sub_category_code = ($speciality_code) ? $speciality_code->speciality_sub_category_code : NULL;

            if (isset($speciality_sub_category_code) && $eighth_digit_license_no != $speciality_sub_category_code) {
                return false;
            }
        }

        return true;
    }
}
