<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Mail\ActivationMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // get Registrations data
        $registrations = User::with('business_school', 'campus')->where('status', 'pending')->get();
       //dd($registrations);

        return view('admin.index', compact('registrations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function schoolStatus(Request $request, $id)
    {
        try {
            $validation = Validator::make($request->all(), ['id'=> 'required'], ['required'=> 'The :attribute can not be blank.']);
            if($validation->fails()){
                return response()->json($validation->messages()->all(), 422);
            }
            User::where('id', $id)->update(['status' => 'active']);

            $content = User::with('designation', 'department', 'business_school')->where('id',$id)->first();
            //dd($content->email);
            Mail::to($content->email)->queue(new ActivationMail($content));
            return response()->json(['success' => 'Status updated Successfully'], 200);
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }


}
