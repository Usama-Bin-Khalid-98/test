<?php

namespace App\Http\Controllers;

use App\Models\External_Linkages\PlacementOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class PlacementOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        try {

            $placement_office = PlacementOffice::get()->first();

        return view('external_linkages.placement_office',compact('placement_office'));
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
            PlacementOffice::updateOrCreate([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'hierarchical_position' => $request->hierarchical_position,
                'year_establishment' => $request->year_establishment,
                'head' => $request->head,
                'reports_to' => $request->reports_to,
                'composition' => $request->composition,
                'total_staff' => $request->total_staff,
                'printers' => $request->printers,
                'photocopiers' => $request->photocopiers,
                'isComplete' => 'yes',
                'updated_by' => Auth::user()->id
            ]);

            return response()->json(['success' => ' Placement Office Inserted successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\External_Linkages\PlacementOffice  $placementOffice
     * @return \Illuminate\Http\Response
     */
    public function show(PlacementOffice $placementOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\External_Linkages\PlacementOffice  $placementOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacementOffice $placementOffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\External_Linkages\PlacementOffice  $placementOffice
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
            PlacementOffice::where('id', $id)->update([
                'hierarchical_position' => $request->hierarchical_position,
                'year_establishment' => $request->year_establishment,
                'head' => $request->head,
                'reports_to' => $request->reports_to,
                'composition' => $request->composition,
                'total_staff' => $request->total_staff,
                'printers' => $request->printers,
                'photocopiers' => $request->photocopiers,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Placement Office updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\External_Linkages\PlacementOffice  $placementOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacementOffice $placementOffice)
    {
        //
    }

    protected function rules() {
        return [
            'hierarchical_position' => 'required',
            'year_establishment' => 'required',
            'head' => 'required',
            'reports_to' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
