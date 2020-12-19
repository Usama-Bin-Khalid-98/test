<?php
if(!function_exists('getMentors')){
    function getMentors($slip_id)
    {
        $getMenttors = \App\Models\MentoringMentor::with('user')->where(['slip_id'=>$slip_id])->get();
        $getDate = \App\Models\EligibilityScreening\ReviewerAvailability::where(['slip_id'=>$slip_id])->first();
//        dd($getMenttors);
        $list = '';
        foreach ($getMenttors as $mentor)
        {
            $list.= $mentor->user->name.', ';
        }
        return 'Mentors :'. $list. '<br/> Date: '. $getDate->availability_dates;
    }
}


