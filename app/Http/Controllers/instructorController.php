<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class instructorController extends Controller
{
    public function InstructorDashboard()
    {
        return view('instructor.index');
    } // End Method
}
