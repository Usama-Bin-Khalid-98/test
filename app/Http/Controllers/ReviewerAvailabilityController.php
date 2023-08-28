<?php

namespace App\Http\Controllers;

use App\Models\EligibilityScreening\EligibilityScreening;
use App\Models\EligibilityScreening\ReviewerAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ReviewerAvailabilityController extends Controller
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
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        } else {
            try {
                $dates = explode(',', $request->dates);
                $getEvent = EligibilityScreening::where('id', $request->eligibility_screenings_id)->get()->first();
               // dd($getEvent);
                foreach ($dates as $date_val)
                {
                    $check= ReviewerAvailability::where([
                        'campus_id' =>$getEvent->campus_id,
                        'department_id' =>$getEvent->department_id,
                        'slip_id' =>$getEvent->slip_id,
                        'user_id' =>Auth::id(),
                        'availability_dates' => date('Y-m-d', strtotime($date_val))])->exists();
                   // dd($check);
                    if(!$check) {
                        ReviewerAvailability::create([
                            'campus_id' => $getEvent->campus_id,
                            'department_id' => $getEvent->department_id,
                            'slip_id' => $getEvent->slip_id,
                            'user_id' => Auth::id(),
                            'is_confirm' => 'no',
                            'availability_dates' => date('Y-m-d', strtotime($date_val))
                        ]);
                    }
                }
                return response()->json(['success' => 'Your availability dates added Successfully'], 200);
                dd($request->all());
            }catch (Exception $e)
            {
                return response()->json(['message' =>$e->getMessage()], 422);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EligibilityScreening\ReviewerAvailability  $reviewerAvailability
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewerAvailability $reviewerAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EligibilityScreening\ReviewerAvailability  $reviewerAvailability
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewerAvailability $reviewerAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EligibilityScreening\ReviewerAvailability  $reviewerAvailability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewerAvailability $reviewerAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EligibilityScreening\ReviewerAvailability  $reviewerAvailability
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewerAvailability $reviewerAvailability)
    {
        //
    }


    protected function rules() {
        return [
            'eligibility_screenings_id'=> 'required',
            'dates'=> 'required',
        ];
    }
    protected function messages() {
        return [
            'required'=> 'The :attribute can not be blanked. '
        ];
    }
}
