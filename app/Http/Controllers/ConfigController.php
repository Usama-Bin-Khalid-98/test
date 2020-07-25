<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Common\CourseType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index()
    {

        $courses = CourseType::get();

        return view('config', compact('courses'));
    }
}
