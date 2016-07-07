<?php

namespace App\Http\Controllers;

use App\Common\Month;
use App\Entity\User;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
/**
 *
 */
class UserController extends Controller
{
    /**
     * List all users in backstage.
     * @param Request $request
     */
    public function showList(Request $request)
    {
        $searchText = $request->searchText;
        $hasPhone = $request->hasPhone;
        $users = User::where(function($query) use ($searchText) {
            $query->where('nickname', 'like', "%$searchText%")
                ->orWhere('realname', 'like', "%$searchText%")
                ->orWhere('cellphone', 'like', "%$searchText%");
        });
        if ($hasPhone) {
            $users = $users->where('cellphone', '<>', '')->paginate(20);
        } else {
            $users = $users->paginate(20);
        }
        $total = User::count();
        $page = $users->currentPage();
        return view('backstage.system.userList', compact(['users', 'total', 'page', 'searchText', 'hasPhone']));
    }

    /**
     * 注册成为测试用户
     * @param Request $request
     */
    public function registerTester(Request $request)
    {
        $id = $request->userId;
        $page = $request->page;
        $searchText = $request->searchText;
        $hasPhone = $request->hasPhone;
        $user = User::find($id);
        $user->test = 1;
        $user->save();
        return redirect('/back/system/user?page=' . $page . "&searchText=" . $searchText . "&hasPhone=" . $hasPhone);
    }

    /**
     * 取消测试用户资格
     * @param Request $request
     */
    public function unregisterTester(Request $request)
    {
        $id = $request->userId;
        $page = $request->page;
        $searchText = $request->searchText;
        $hasPhone = $request->hasPhone;
        $user = User::find($id);
        $user->test = 0;
        $user->save();
        return redirect('/back/system/user?page=' . $page . "&searchText=" . $searchText . "&hasPhone=" . $hasPhone);
    }

    /***/
    public function analyze(Request $request)
    {
        $year = $request->year;
        $curveType = $request->curveType;
        if (!$curveType) $curveType = 'function';
        // one month data
        if ($year) {
            $month = intval($request->month);
            $englishMonthName = Month::getEnglishMonth($month);
            $englishNextMonthName = Month::getEnglishMonth($month + 1);
            $monthStart = new Carbon('first day of ' . $englishMonthName . ' ' . $year, 'America/Vancouver');
            $monthEnd = new Carbon('first day of ' . $englishNextMonthName . ' ' . $year, 'America/Vancouver');
            $users = User::where('created_at', '>=', $monthStart)->where('created_at', '<', $monthEnd)
                    ->orderBy('created_at')->get();
        }
        // whole period data
        else {
            $users = User::orderBy('created_at')->get();
        }
        $dataArray = array();
        foreach ($users as $user) {
            $key = $user->login_date = $user->created_at->format('m-d');
            if (array_key_exists($key, $dataArray)) {
                $dataArray[$key]++;
            } else {
                $dataArray[$key] = 1;
            }
        }
        $data = json_encode($dataArray);
        return view('backstage.system.userLineChart', compact(['data', 'year', 'month' ,'curveType']));
    }
}
