<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourtHearingsController extends Controller
{
    public function hcac()
    {
        return view('court_hearings.hcac', [
            'data' => [1, 2, 3]
        ]);
    }

    public function apel_hcac()
    {
        dd(2);
    }
}
