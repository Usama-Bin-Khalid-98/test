<?php
if (!function_exists('human_file_size')) {

    function checkIsCompleted($model, $where)
    {
//        dd($where);
//        DB::enableQueryLog();
        $check = $model::where($where)->get()->first()?'C':'In';
        //dd($check);
        //dd(DB::getQueryLog());
        return  $check;
    }

    function getFirst($model, $where)
    {
        $result = $model::where($where)->get()->first();
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
