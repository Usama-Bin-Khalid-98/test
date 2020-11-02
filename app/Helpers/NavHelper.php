<?php
if (!function_exists('checkIsCompleted')) {

    function checkIsCompleted($model, $where)
    {
//        dd($where);
//        DB::enableQueryLog();

        if($model != 'App\Models\Common\Slip' && $model != 'App\Models\MentoringInvoice' && $model != 'App\BusinessSchool') {
            $whereIs = ['business_school_id' =>$where['campus_id'], 'department_id'=> $where['department_id'], 'regStatus'=>'SAR'];
            $isActiveSAR = getFirst('App\Models\Common\Slip', $whereIs);
//            dd($isActiveSAR);

            $isActiveSAR? $where['type'] = 'SAR' : '';
        }
//        dd($where);
            $check = $model::where($where)->get()->first() ? 'C' : 'In';
        //dd($check);
        //dd(DB::getQueryLog());
        return  $check;
    }
    function isCompletedSAR($model, $where)
    {
        return $model::where($where)->get()->first() ? 'C' : 'In';
    }

    function getFirst($model, $where)
    {
        // DB::enableQueryLog();
        $result = $model::where($where)->get()->first();
        //dd(DB::getQueryLog());
        //dd($result);
        return $result;
    }

    function get($model, $where)
    {
        $result = $model::where($where)->get();
        //dd($result);
        return $result;
    }

    function isFiveRegistrations($model, $where)
    {
        $result = $model::where($where)->get()->count();
        //dd($result);
        return $result;
    }
}
?>
