<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class ExportPayorMember implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($payormembers)
    {
        $this->payormembers = $payormembers;
        //print_r($payormembers); die();
    }

    public function collection()
    {
        
        /*echo "<pre>";
        print_r($this->payormembers);
        $payor = Auth::guard('payor')->user();
        $payor_number = $payor->id;
        $mem = Member::where([['payor_number', '=', $payor_number]])->get();
        print_r($this->payormembers); die();*/
        return collect($this->payormembers);
        
    }
    public function headings() :array
    {
        return [
            'Member ID',
            'First Name',
            'Last Name',
            'DOB',
            'Gender',
            'Relationship',
            'Coverage',
            'Status',
        ];
    }
}
