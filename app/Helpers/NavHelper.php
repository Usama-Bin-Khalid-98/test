<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

    if (!function_exists('checkIsCompleted')) {

        function checkIsCompleted($model, $where)
        {
    //        dd($where);
    //        DB::enableQueryLog();

            if ($model != 'App\Models\Common\Slip' && $model != 'App\Models\External_Linkages\Linkages' && $model != 'App\Models\MentoringInvoice' && $model != 'App\BusinessSchool' && $model != 'App\StudentIntake') {
                $whereIs = ['business_school_id' => $where['campus_id'], 'department_id' => $where['department_id'], 'regStatus' => 'SAR'];
                $isActiveSAR = getFirst('App\Models\Common\Slip', $whereIs);
    //            dd($isActiveSAR);

                $isActiveSAR ? $where['type'] = 'SAR' : '';
            }
    //        dd($where);
            $check = $model::where($where)->get()->first() ? 'C' : 'In';
            //dd($check);
            //dd(DB::getQueryLog());
            return $check;
        }
    }
    if(!function_exists('checkIsCompletedAllProg')) {
        function checkIsCompletedAllProg($model, $where)
        {

            if ($model != 'App\Models\Common\Slip' && $model != 'App\Models\MentoringInvoice' && $model != 'App\BusinessSchool') {
                $whereIs = ['business_school_id' => $where['campus_id'], 'department_id' => $where['department_id'], 'regStatus' => 'SAR'];
                $isActiveSAR = getFirst('App\Models\Common\Slip', $whereIs);
                $isActiveSAR ? $where['type'] = 'SAR' : '';
            }


            $getScope = \App\Models\StrategicManagement\Scope::where(['campus_id' => $where['campus_id'], 'department_id' => $where['department_id']])->get();
            $check_program = false;
            foreach ($getScope as $key=>$scope)
            {
            $getPortfolio = $model::where($where)
                ->where(
                [
                    'program_id'=>$scope->program_id
                ])->exists();
                if($getPortfolio){
                    $check_program = true;
                }else {
                    $check_program = false;
                    break;
                }
            }

//            dd($check_program);
            return $check = $model::where($where)->get()->first() && $check_program ? 'C' : 'In';
        }

    }
    if(!function_exists('isCompletedSAR')) {
        function isCompletedSAR($model, $where)
        {
            return $model::where($where)->get()->first() ? 'C' : 'In';
        }
    }
    if(!function_exists('getFirst')){

        function getFirst($model, $where)
        {
            // DB::enableQueryLog();
            $result = $model::where($where)->get()->first();
            //dd(DB::getQueryLog());
            //dd($result);
            return $result;
        }
    }
    if(!function_exists('get')){

        function get($model, $where)
        {
            $result = $model::where($where)->get();
            //dd($result);
            return $result;
        }
    }
    if(!function_exists('isFiveRegistrations')){

        function isFiveRegistrations($model, $where)
        {
            $result = $model::where($where)->get()->count();
            //dd($result);
            return $result;
        }
    }
    if(!function_exists('isChecked')){
        function isChecked($where){
           return  \App\Models\Carriculum\MappingPos::where($where)->first()->isChecked;
//            dd($result);
        }
    }

    if(!function_exists('getRegInvoiceId')){

        function getRegInvoiceId()
        {
            $result = \App\Models\Common\Slip::where(['regStatus'=>'Pending', 'status'=>'approved', 'business_school_id'=>Auth::user()->campus_id])->get()->first();
            if (!$result){
                return -1;
            }
            return $result->id;
        }
    }

    if(!function_exists('isProcessingASlip')){

        function isProcessingASlip()
        {
            Log::debug(Auth::user()->campus->id);
            return \App\Models\Common\Slip::where('regStatus','<>','inactive')->where('status','<>','inactive')->where(['business_school_id'=>Auth::user()->campus_id])->exists();
        }
    }
?>
