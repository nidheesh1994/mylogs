<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyLog;
use App\User;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class LogController extends Controller
{
    /**
     * UserController constructor.
     * Asuthentication middleware.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'userId' => 'required',
            'log' => 'required|string',
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function saveLog(Request $request){
        $log = new MyLog();
        $data = $this->validate($request, [
            'log' => 'required',
            'userId' => 'required'
        ]);
        $log->createLog($data);
        return view('logs.logs');

    }

    //
    public function showLog(Request $request){
        $user = Auth::user();
        try{
            $Logs = MyLog::where('userId', '=', $user->id)->get();
//            $Logs = MyLog::find(1);
        }
        catch (Exception $e){
            echo 'Error : ' .$e->getMessage();
            return;
        }

        return view('logs.logs', compact('Logs'), compact('user'));
    }

    public function submitLog(Request $request){
        $this->validator($request->all())->validate();

        $log = new MyLog();
        $log->create([
            'userId' => $request['userId'],
            'log' => $request['log'],
        ]);

        return redirect()->action(
            'LogController@showLog'
        );
    }
}
