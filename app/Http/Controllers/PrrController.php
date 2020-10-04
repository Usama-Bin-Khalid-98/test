<?php

namespace App\Http\Controllers;

use App\Prr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class PrrController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
          try {
            $nbeac_criteria = Prr::get()->first();

         return view('eligibility_screening.prr',compact('nbeac_criteria'));
        }catch (\Exception $e) {
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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }
        try {
            $uni_id = Auth::user()->campus_id;
            $dept_id = Auth::user()->department_id;
            Prr::updateOrCreate([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'prr' => $request->prr,
                'updated_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Record Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prr  $prr
     * @return \Illuminate\Http\Response
     */
    public function show(Prr $prr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prr  $prr
     * @return \Illuminate\Http\Response
     */
    public function edit(Prr $prr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prr  $prr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {
           Prr::where('id', $id)->update([
                'prr' => $request->prr,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Record updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prr  $prr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prr $prr)
    {
        //
    }

     protected function rules() {
        return [
            'prr' => 'required'
        ];
    }
    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
