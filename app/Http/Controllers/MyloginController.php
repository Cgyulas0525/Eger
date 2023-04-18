<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use App\Models\Users;
use App\Http\Controllers\ChangeActiveController;
use App\Models\Logitems;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon;
use myUser;
use App\Actions\DeActive;
use App\Actions\LogItemInsert;

class MyloginController extends Controller
{
    public static function login(Request $request)
    {

        $name = $request->name;
        $password = $request->password;

        if (empty($name)) {
            Flash::error(__('A név kötelező!'))->important();
            return back();
        }

        if (empty($password)) {
            return back();
        }

        $user = Users::where('username', $name)
            ->where('password', md5($password))
            ->first();


        if (empty($user)) {
            Flash::error(__('Hibás név vagy jelszó!'))->important();
            return back();
        }

        session(['userId' => $user->id]);
        $logitem = new LogItemInsert();
        $logitem->iudRecord(1, NULL, NULL);

        $deActive = new DeActive();
        $deActive->handle('Vouchers');
        $deActive->handle('Questionnaires');
        $deActive->handle('Lotteries');


        return view('home');
    }

    public static function myLogout() {
        $logitem = new LogItemInsert();
        $logitem->iudRecord(2, NULL, NULL);
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function settingIndex(Request $request)
    {
        return view('setting.edit');
    }


}

