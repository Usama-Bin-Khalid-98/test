<?php

namespace App\Http\Controllers;

use App\Models\DeskReview;
use App\Models\StrategicManagement\ApplicationReceived;
use App\Models\StrategicManagement\MissionVision;
use App\Models\StrategicManagement\Scope;
use App\Models\StrategicManagement\StrategicPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $campus_id = Auth::user()->campus_id;
        $accreditation=  Scope::with('program')->where(['status'=> 'active', 'campus_id' => $campus_id])->get();
//        $accreditation=  Scope::where(['status'=> 'active', 'campus_id' => $campus_id])->get();
        //dd($accreditation);
        $program_dates = [];
        foreach ($accreditation as $accred)
        {
        @$program_dates[$accred->id]['date_diff'] = $this->dateDifference($accred->date_program, date('Y-m-d'), '%y Year %m Month');
        @$program_dates[$accred->id]['program'] = $accred->program->name;
        @$program_dates[$accred->id]['date'] = $accred->date_program;
        }

        $mission_vision = MissionVision::all()->where('campus_id', $campus_id)->first();
        $strategic_plan = StrategicPlan::all()->where('campus_id', $campus_id)->first();
        $strategic_plan = ApplicationReceived::all()->where('campus_id', $campus_id)->first();

       // dd($strategic_plan);

        //dd($program_dates);
        //// get scope
        //$scope = Scope::where('')
        return view('desk_review.index', compact(
            'program_dates',
            'mission_vision',
            'strategic_plan',

        ));
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

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);

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
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function show(DeskReview $deskReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function edit(DeskReview $deskReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeskReview $deskReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeskReview  $deskReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeskReview $deskReview)
    {
        //
    }
}
