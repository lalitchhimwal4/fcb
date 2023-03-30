<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accordian;

class PayorController extends Controller
{
    public function index()
    {
        return view('frontend.agent-brokers');
    }
}
