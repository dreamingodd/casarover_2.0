<?php

namespace App\Http\Controllers\Wx;

use App\Entity\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

/**
 *
 */
class WxUserController extends Controller
{
    /**
     * List all users in backstage.
     */
    public function showList() {
        $users = User::all();
        return view('backstage.wxUserList', compact(['users']));
    }

    public function registerTester($id) {
        $user = User::find($id);
        $user->test = 1;
        $user->save();
        return redirect('/back/system/wx/user');
    }

    public function unregisterTester($id) {
        $user = User::find($id);
        $user->test = 0;
        $user->save();
        return redirect('/back/system/wx/user');
    }
}
