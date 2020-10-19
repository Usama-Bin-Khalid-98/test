<?php

namespace App\Http\Controllers;

use App\Models\Common\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), ['name' => 'required'], ['required'=> 'The :name can not be blanked.']);
        if($validator->fails())
        {
            return response()->json($validator->messages()->all(), 422);
        }
        $insert = Discipline::create(['name' => $request->name, 'status' => 'active']);
        if($insert)
        {
            return response()->json(['success' => 'Discipline added successfully.', 'insert_id' => $insert->id], 200);
        }
        else {
            return response()->json(['message' => 'Failed to add Discipline.'], 422);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Common\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function show(Discipline $discipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Common\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function edit(Discipline $discipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Common\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discipline $discipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Common\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
