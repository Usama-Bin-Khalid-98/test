<?php

namespace App\Http\Controllers\StrategicManagement;
use App\Http\Controllers\Controller;

use App\Models\Common\Level;
use App\Models\Common\Program;
use App\Models\Common\Slip;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use DB;
class ScopeController extends Controller
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
        @$department_id = Slip::where(['business_school_id' => Auth::user()->campus_id, 'status'=>'paid' ])->get()->first()->department_id;
        //dd(DB::getQueryLog());
        //dd($department_id);
        $programs = Program::where(['status' => 'active', 'department_id' =>$department_id])->get();
        $levels = Level::where('status', 'active')->get();
        $scopes = Scope::with('level', 'program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->get();
        //dd($programs);
        return view('strategic_management.scope', compact('programs', 'levels', 'scopes'));
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
        try {
            //$update = BasicInfo::find($basicInfo->id);
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if (Scope::where(['campus_id' => auth()->user()->campus_id,'department_id'=> auth()->user()->department_id, 'program_id' => $request->program_id, 'level_id' => $request->level_id] )->exists()) {
                return response()->json(['error' => 'Record already Exists.'], 422);
            }
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {
                $campus_id = auth()->user()->campus_id;
                $department_id = auth()->user()->department_id;
                $created_id = auth()->user()->id;
                $request->merge(['campus_id' => $campus_id,'department_id' => $department_id,'created_by'=>$created_id, 'isComplete' =>'yes'] );
                $create = Scope::create($request->all());
                return response()->json(['success' => 'Updated successfully.'], 200);
            }
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicManagement\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function show(Scope $scope)
    {   //dd($scope);
        $result = Scope::get();
        dd($result);
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicManagement\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function edit(Scope $scope)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicManagement\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scope $scope)
    {
        //
        try {
            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {
                $updated_id = auth()->user()->id;
                $request->merge(['updated_by'=>$updated_id] );
                $scope->update($request->all());
                return response()->json(['success' => 'Updated successfully.'], 200);
            }
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 422);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicManagement\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scope $scope)
    {
        //dd($scope);
        try {
            Scope::where('id', $scope->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             Scope::destroy($scope->id);
                return response()->json(['success' => 'Record deleted successfully.']);
        }catch (Exception $e)
        {
            return response()->json(['error' => 'Failed to delete record.']);
        }
        //
    }

    protected function rules() {
        return [
            'program_id' => 'required',
            'level_id' => 'required',
            'date_program' => 'required|date',
        ];
    }

    protected function messages() {
        return [
            'required' => 'The :attribute can not be blank.'
        ];
    }
}
