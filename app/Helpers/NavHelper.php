<<<<<<< HEAD
=======
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
}
?>
>>>>>>> c4af9e790e4ce5d37249be4f354f62853a32856e
