<?php

namespace App\Http\Controllers;

use App\Entity\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
/**
 *
 */
class UserController extends Controller
{
    /**
     * List all users in backstage.
     */
    public function showList(Request $request) {
        $searchText = $request->searchText;
        $hasPhone = $request->hasPhone;
        $users = User::where('nickname', 'like', "%$searchText%")
                    ->orWhere('realname', 'like', "%$searchText%")
                    ->orWhere('cellphone', 'like', "%$searchText%")
                    ->paginate(20);
        $total = User::count();
        $page = $users->currentPage();
        return view('backstage.system.userList', compact(['users', 'total', 'page', 'searchText', 'hasPhone']));
    }

    /**
     * 注册成为测试用户
     * @param int $id
     * @param int $page
     */
    public function registerTester($id, $page, $searchText, $hasPhone) {
        $user = User::find($id);
        $user->test = 1;
        $user->save();
        return redirect('/back/system/user?page=' . $page . "&searchText=" . $searchText . "&hasPhone=" . $hasPhone);
    }

    /**
     * 取消测试用户资格
     * @param int $id
     * @param int $page
     */
    public function unregisterTester($id, $page, $searchText, $hasPhone) {
        $user = User::find($id);
        $user->test = 0;
        $user->save();
        return redirect('/back/system/user?page=' . $page . "&searchText=" . $searchText . "&hasPhone=" . $hasPhone);
    }
}
