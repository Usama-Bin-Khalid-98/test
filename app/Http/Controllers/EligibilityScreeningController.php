<?php

namespace App\Http\Controllers;

use App\Models\EligibilityScreening\EligibilityScreening;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;



class EligibilityScreeningController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedule()
    {
        //
        return view('eligibility_screening.scheduler');

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
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function show(EligibilityScreening $eligibilityScreening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function edit(EligibilityScreening $eligibilityScreening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EligibilityScreening $eligibilityScreening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EligibilityScreening\EligibilityScreening  $eligibilityScreening
     * @return \Illuminate\Http\Response
     */
    public function destroy(EligibilityScreening $eligibilityScreening)
    {
        //
    }
}
