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
}
