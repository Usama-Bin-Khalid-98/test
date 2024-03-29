<?php

use App\Models\Common\Slip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

    if (!function_exists('checkIsCompleted')) {

        function checkIsCompleted($model, $where)
        {
            $check = $model::where($where)->get()->first() ? 'C' : 'In';
            return $check;
        }
    }
    if(!function_exists('checkIsCompletedAllProg')) {
        function checkIsCompletedAllProg($model, $where)
        {
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
            $result = \App\Models\Common\Slip::where([
                'regStatus' => 'Pending', 
                'status' => 'approved', 
                'business_school_id' => Auth::user()->campus_id])
                ->get()
                ->first();
                
            if (!$result){
                return -1;
            }
            return $result->id;
        }
    }

    if(!function_exists('isProcessingASlip')){

        function isProcessingASlip()
        {
            return \App\Models\Common\Slip::where('regStatus', '<>', 'inactive')
                ->where('status', '<>', 'inactive')
                ->where(['business_school_id' => Auth::user()->campus_id])
                ->exists();
        }
    }
    if(!function_exists('getDeskReviewCount')){

        function getDeskReviewCount()
        {
            return $registrations = DB::table('slips as s')
                ->join('users as u', 'u.id', '=', 's.created_by')
                ->where('s.regStatus', 'Review')
                ->count();
        }
    }
?>
