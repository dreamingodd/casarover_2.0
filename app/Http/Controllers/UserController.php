<?php

namespace App\Http\Controllers;

use App\Entity\User;

use App\Http\Controllers\Controller;

/**
 *
 */
class UserController extends Controller
{
    /**
     * List all users in backstage.
     */
    public function showList() {
        $users = User::paginate(100);
        $total = $users->total();
        $page = $users->currentPage();
        return view('backstage.userList', compact(['users', 'total', 'page']));
    }

    /**
     * 注册成为测试用户
     * @param int $id
     * @param int $page
     */
    public function registerTester($id, $page) {
        $user = User::find($id);
        $user->test = 1;
        $user->save();
        return redirect('/back/system/user?page=' . $page);
    }

    /**
     * 取消测试用户资格
     * @param int $id
     * @param int $page
     */
    public function unregisterTester($id, $page) {
        $user = User::find($id);
        $user->test = 0;
        $user->save();
        return redirect('/back/system/user?page=' . $page);
    }
}
