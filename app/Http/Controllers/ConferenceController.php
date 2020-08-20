<?php

namespace App\Http\Controllers;

use App\Model\Research\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;
use Auth;

class ConferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }
    public function index()
    {
        $campus_id = Auth::user()->campus_id;
        $department_id = Auth::user()->department_id;
        $conferences  = Conference::with('campus')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();

         return view('registration.research_summary.conference', compact('conferences'));
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

            Conference::create([
                'campus_id' => Auth::user()->campus_id,
                'department_id' => Auth::user()->department_id,
                'conference' => $request->conference,
                'date' => $request->date,
                'isComplete' => 'yes',
                'created_by' => Auth::user()->id
            ]);

            return response()->json(['success' => 'Conference added successfully.']);


        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Research\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Research\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function edit(Conference $conference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Research\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conference $conference)
    {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->fails())
        {
            return response()->json($validation->messages()->all(), 422);
        }

        try {

            Conference::where('id', $conference->id)->update([
                'conference' => $request->conference,
                'date' => $request->date,
                'status' => $request->status,
                'updated_by' => Auth::user()->id
            ]);
            return response()->json(['success' => 'Conference updated successfully.']);

        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Research\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        try {
        Conference::where('id', $conference->id)->update([
               'deleted_by' => Auth::user()->id 
           ]);
        Conference::destroy($conference->id);
            return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
    }

    protected function rules() {
        return [
            'conference' => 'required',
            'date' => 'required'
        ];
    }



    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
