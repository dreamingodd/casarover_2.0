<?php

namespace App\Http\Controllers\Wx;

use App\Entity\Wx\WxUser;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class WxUserController extends Controller
{
    public function showList() {
        $users = WxUser::all();
        return view('backstage.wxUserList', compact(['users']));
    }

    public function registerTester($id) {
        $user = WxUser::find($id);
        $user->test = 1;
        $user->save();
        return redirect('/back/system/wx/user');
    }

    public function unregisterTester($id) {
        $user = WxUser::find($id);
        $user->test = 0;
        $user->save();
        return redirect('/back/system/wx/user');
    }
}
