<?php

namespace App\Http\Controllers;

use App\FacultyDegree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FacultyDegreeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $userInfo = Auth::user();
            $faculty_degree = FacultyDegree::
                where(['campus_id'=>$userInfo->campus_id, 'department_id'=> $userInfo->department_id])
                ->first();

        return view('faculty_degree.index',compact('faculty_degree'));
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
        // dd($request);
        try {
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {
                
                if($request->id){
                    $update = FacultyDegree::where('id', $request->id)
                          ->update(
                              [
                                  'campus_id' => Auth::user()->campus_id,
                                  'department_id' => Auth::user()->department_id,
                                  'faculty_foreign' => $request->faculty_foreign,
                                  'faculty_domestic' => $request->faculty_domestic,
                                  'faculty_international' => $request->faculty_international,
                                  'isComplete' => 'yes',
                                  'updated_by' => Auth::user()->id

                                  ]
                          );

                return response()->json(['success' => ' Faculty Degree Updated successfully.']);
            
                }else{

                $update = FacultyDegree::
                    create(
                        [
                            'campus_id' => Auth::user()->campus_id,
                            'department_id' => Auth::user()->department_id,
                            'faculty_foreign' => $request->faculty_foreign,
                            'faculty_domestic' => $request->faculty_domestic,
                            'faculty_international' => $request->faculty_international,
                            'isComplete' => 'yes',
                            'created_by' => Auth::user()->id

                        ]
                    );
                }

                return response()->json(['success' => ' Faculty Degree added successfully.']);
            }
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FacultyDegree  $facultyDegree
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyDegree $facultyDegree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FacultyDegree  $facultyDegree
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyDegree $facultyDegree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FacultyDegree  $facultyDegree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         try {
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {

                $update = FacultyDegree::where('id', $id)
                          ->update(
                              [
                                  'campus_id' => Auth::user()->campus_id,
                                  'department_id' => Auth::user()->department_id,
                                  'faculty_foreign' => $request->faculty_foreign,
                                  'faculty_domestic' => $request->faculty_domestic,
                                  'faculty_international' => $request->faculty_international,
                                  'isComplete' => 'yes',
                                  'updated_by' => Auth::user()->id

                                  ]
                          );

                return response()->json(['success' => ' Faculty Degree Updated successfully.']);
            }
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FacultyDegree  $facultyDegree
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyDegree $facultyDegree)
    {
        //
    }

    protected function rules() {
        return [
            'faculty_foreign' => 'required',
            'faculty_domestic' => 'required',
            'faculty_international' => 'required'
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
