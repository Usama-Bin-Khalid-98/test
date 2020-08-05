<?php

namespace App\Http\Controllers;

use App\NbeacCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class NbeacCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          try {
            $nbeac_criteria = NbeacCriteria::get()->first();

         return view('nbeac_criteria.index',compact('nbeac_criteria'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function show(NbeacCriteria $nbeacCriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(NbeacCriteria $nbeacCriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try {
            //$update = BasicInfo::find($basicInfo->id);
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {

                $update = NbeacCriteria::where('id', $id)
                          ->update(
                              [
                                  'campus_id' => Auth::user()->campus_id,
                                  'editor1' => $request->editor1,
                                  'editor2' => $request->editor2,
                                  'editor3' => $request->editor3,
                                  'editor4' => $request->editor4,
                                  'editor5' => $request->editor5,
                                  'editor6' => $request->editor6,
                                  'editor7' => $request->editor7,
                                  'editor8' => $request->editor8,
                                  'editor9' => $request->editor9,
                                  'updated_by' => Auth::user()->id

                                  ]
                          );
                

                return response()->json(['success' => 'Nbeac Criteria Updated successfully.']);
            }
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NbeacCriteria  $nbeacCriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(NbeacCriteria $nbeacCriteria)
    {
        //
    }

    protected function rules() {
        return [
            'editor1' => 'required',
            'editor2' => 'required',
            'editor3' => 'required',
            'editor4' => 'required',
            'editor5' => 'required',
            'editor6' => 'required',
            'editor7' => 'required',
            'editor8' => 'required',
            'editor9' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
