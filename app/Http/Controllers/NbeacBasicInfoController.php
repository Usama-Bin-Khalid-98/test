<?php

namespace App\Http\Controllers;

use App\Models\Config\NbeacBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NbeacBasicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        @$basic_info = NbeacBasicInfo::all()->first();
//        dd($basic_info);
        return view('admin.basic_info', compact('basic_info'));

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
//        dd($request->all());
        try {
            if ($request->id == null) {
                $insert = NbeacBasicInfo::create(
                    [
                        'name' => $request->name,
                        'short_name' => $request->short_name,
                        'email' => $request->email,
                        'phone1' => $request->phone1,
                        'phone2' => $request->phone2,
                        'fax' => $request->fax,
                        'website' => $request->website,
                        'director' => $request->director,
                        'chairman' => $request->chairman,
                        'address' => $request->address,
                        'user_id' => Auth::id(),
                    ]
                );
                if($insert)
                {
                    return response()->json(['success' => 'info added successfully'], 200);
                }else{
                    return response()->json(['message' => 'failed'], 422);
                }

            } else {
                $update = NbeacBasicInfo::find($request->id)->update(
                    [
                        'name' => $request->name,
                        'short_name' => $request->short_name,
                        'email' => $request->email,
                        'phone1' => $request->phone1,
                        'phone2' => $request->phone2,
                        'fax' => $request->fax,
                        'website' => $request->website,
                        'director' => $request->director,
                        'chairman' => $request->chairman,
                        'address' => $request->address,
                    ]
                );
                if($update)
                {
                    return response()->json(['success' => 'info added successfully'], 200);
                }else{
                    return response()->json(['message' => 'failed'], 422);

                }

            }
        }catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\NbeacBasicInfo  $nbeacBasicInfo
     * @return \Illuminate\Http\Response
     */
    public function show(NbeacBasicInfo $nbeacBasicInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\NbeacBasicInfo  $nbeacBasicInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(NbeacBasicInfo $nbeacBasicInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\NbeacBasicInfo  $nbeacBasicInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NbeacBasicInfo $nbeacBasicInfo)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\NbeacBasicInfo  $nbeacBasicInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(NbeacBasicInfo $nbeacBasicInfo)
    {
        //
    }
}
