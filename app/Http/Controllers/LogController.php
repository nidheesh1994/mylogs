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
     * @param array $data
     * @return mixed
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


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveLog(Request $request){
        $log = new MyLog();
        $data = $this->validate($request, [
            'log' => 'required',
            'userId' => 'required'
        ]);
        $log->createLog($data);
        return view('logs.logs');

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showLog(Request $request){
        $user = Auth::user();
        try{
            $Logs = MyLog::where('userId', '=', $user->id)->orderBy('id','asc')->get();
//            $Logs = MyLog::find(1);
        }
        catch (Exception $e){
            echo 'Error : ' .$e->getMessage();
            return;
        }

        return view('logs.logs', compact('Logs'), compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitLog(Request $request){
        $this->validator($request->all())->validate();

        $log = new MyLog();
        $log->create([
            'userId' => $request['userId'],
            'log' => $request['log'],
            'date' => date('Y-m-d'),
        ]);

        return redirect()->action(
            'LogController@showLog'
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletelog(Request $request, $id){
        $log = MyLog::find($id);
        $log->delete();
        return redirect('/logs');
    }
}
