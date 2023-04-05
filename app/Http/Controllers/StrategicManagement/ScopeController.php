<?php

namespace App\Http\Controllers\StrategicManagement;
use App\Http\Controllers\Controller;
use App\Models\Common\Discipline;
use App\Models\Common\Level;
use App\Models\Common\Program;
use App\Models\Common\Slip;
use App\Models\StrategicManagement\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
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
//        @$department_id = Slip::where(
//            [
//                'business_school_id' => Auth::user()->campus_id,
//                'status'=>'approved'
//            ])->get()->first()->department_id;

        //dd(DB::getQueryLog());
        //dd($department_id);
        $programs = Program::where(['status' => 'active'])->get();
        $disciplines = Discipline::where(['status' => 'active'])->get();
        $levels = Level::where('status', 'active')->get();
        $slip = Slip::where(['business_school_id'=>$campus_id,'department_id'=> $department_id])
            ->where('regStatus','SAR')
            ->orWhere('regStatus', 'SAP')
            ->orWhere('regStatus', 'SARDeskReview')
//            ->orWhere('regStatus', 'PeerReviewVisit')
//            ->orWhere('regStatus', 'ScheduledPRVisit')
//            ->orWhere('regStatus', 'PeerReviewReport')
                ->first();
//       dd($slip);
        $isSAR = false;
//        dd($slip);

        if($slip){
            $scopes = Scope::with('level', 'program')
                ->where(['campus_id'=> $campus_id,'department_id'=> $department_id])
                ->where('type','SAR')
                ->get();
            $isSAR = true;
        }else {
            $scopes = Scope::with('level', 'program')->where(['campus_id'=> $campus_id,'department_id'=> $department_id])->where('type','REG')->get();
        }
        return view('strategic_management.scope', compact('programs', 'levels', 'scopes', 'isSAR', 'disciplines'));
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
            $campus_id = Auth::user()->campus_id;
            $department_id = Auth::user()->department_id;

            $dateDifference = $this->dateDifference($request->date_program, date('Y-m-d'), '%y.%m');
            if($request->level_id == 1 && $dateDifference < 3.5){
                return response()->json(['error' => 'Graduated should be greater then 3.5 years.'], 422);
            }
            elseif($request->level_id == 2 && $dateDifference < 5.5){
                return response()->json(['error' => 'Under-graduated should be greater then 5.5 years.'], 422);
            }
           // dd($dateDifference);

            $validation= Validator::make($request->all(), $this->rules(), $this->messages());
            if($validation->fails())
            {
                return response()->json($validation->messages()->all(), 422);
            }else {
                if($request->program_id == "other"){
                    $data = Program::create([
                        "name" => $request->other_name,
                        "discipline_id" => $request->discipline_id,
                        "status" => "active"
                    ]);
                    $request->program_id = $data->id;
                }
                $slip = Slip::where(['business_school_id' => $campus_id, 'department_id' => $department_id])->where('regStatus', 'SAR')->first();
                $campus_id = auth()->user()->campus_id;
                $department_id = auth()->user()->department_id;
                $created_id = auth()->user()->id;

                if ($slip) {
                    $type = 'SAR';
                    if (Scope::where(['campus_id' => auth()->user()->campus_id, 'department_id' => auth()->user()->department_id,
                        'program_id' => $request->program_id, 'level_id' => $request->level_id, 'type' => $type])
                        ->exists()) {
                        return response()->json(['error' => 'Record already Exists.'], 422);
                    }
                    $create = Scope::create([
                        'campus_id' => $campus_id,
                        'department_id' => $department_id,
                        'created_by' => $created_id,
                        'isComplete' => 'yes',
                        'type' => $type,
                        'program_id' => $request->program_id,
                        'level_id' => $request->level_id,
                        'date_program' => $request->date_program,
                        'status' => 'active'
                    ]);

                } else {
                    $type = 'REG';
                    if (Scope::where(['campus_id' => auth()->user()->campus_id, 'department_id' => auth()->user()->department_id,
                        'program_id' => $request->program_id, 'level_id' => $request->level_id, 'type' => $type])
                        ->exists()) {
                        return response()->json(['error' => 'Record already Exists.'], 422);
                    }
                    $create = Scope::create([
                        'campus_id' => $campus_id,
                        'department_id' => $department_id,
                        'created_by' => $created_id,
                        'isComplete' => 'yes',
                        'type' => $type,
                        'program_id' => $request->program_id,
                        'level_id' => $request->level_id,
                        'date_program' => $request->date_program,
                        'status' => 'active'
                    ]);

                    $request->merge(['type'=> 'SAR']);
//                    dd($request);
                    $createsar = Scope::create([
                        'campus_id' => $campus_id,
                        'department_id' => $department_id,
                        'created_by' => $created_id,
                        'isComplete' => 'yes',
                        'type' => 'SAR',
                        'program_id' => $request->program_id,
                        'level_id' => $request->level_id,
                        'date_program' => $request->date_program,
                        'status' => 'active'
                    ]);

                    return response()->json(['success' => 'Added successfully.'], 200);
                }
            }
        }catch (Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
//        dd($date_1,$date_2);
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);

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
//        dd($scope);
        try {
            Scope::where('id', $scope->id)->update([
               'deleted_by' => Auth::user()->id
           ]);
             Scope::destroy($scope->id);
             Scope::where(["campus_id" => $scope->campus_id,
                "department_id" => $scope->department_id,
                "program_id" => $scope->program_id,
                "level_id" => $scope->level_id,
                "date_program" => $scope->date_program,
                "isComplete" => "yes",
                "created_by" =>$scope->created_by])->delete();
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
