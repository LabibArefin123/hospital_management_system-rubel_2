<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomePageController extends Controller
{
    public function index()
    {
        return view('frontend.welcome');
    }

    public function doctor(Request $request)
    {
        $search = $request->query('search');

        return view('frontend.doctor_page.doctor', compact('search'));
    }
    
    public function doctor_1()
    {
        return view('frontend.doctor_page.doctor_information.doc_1');
    }

    public function doctor_2()
    {
        return view('frontend.doctor_page.doctor_information.doc_2');
    }

    public function doctor_3()
    {
        return view('frontend.doctor_page.doctor_information.doc_3');
    }

    public function contact()
    {
        return view('frontend.contact_page.contact');
    }

    public function service()
    {
        return view('frontend.service_page.service');
    }

    public function service_page_1()
    {
        return view('frontend.service_page.page_1.service_1');
    }

    public function service_page_2()
    {
        return view('frontend.service_page.page_2.service_2');
    }

    public function service_page_3()
    {
        return view('frontend.service_page.page_3.service_3');
    }

    public function service_page_4()
    {
        return view('frontend.service_page.page_4.service_4');
    }

    public function service_page_5()
    {
        return view('frontend.service_page.page_5.service_5');
    }
}
