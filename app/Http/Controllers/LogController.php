<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogController extends Controller
{
    /**
     * UserController constructor.
     * Asuthentication middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function saveLog(Request $request){
        $log = new Log();
        $data = $this->validate($request, [
            'log' => 'required',
            'userId' => 'required'
        ]);
        $log->createLog($data);
        return view('logs.logs');

    }

    //
    public function showLog(Request $request){
        return view('logs.logs');
    }
}
