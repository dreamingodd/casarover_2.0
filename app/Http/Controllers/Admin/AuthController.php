<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/back';
    protected $redirectAfterLogout = '/back';
    protected $guard = 'admin';
    protected $loginView = 'admin.login';
    protected $registerView = 'admin.register';

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);

    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
        ]);

    }
    /**
     * 重写login 进行自定义验证
     * status 用来判定是否是被允许的管理员
    **/
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt(['name' => $request->name, 'password' => $request->password,'status' => 1],$request->remember)) {
            // 认证通过...
            return redirect()->intended('/back');
        }
        else
        {
            return redirect()->back()->withErrors(['message'=>'密码错误']);
        }
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->create($request->all());

        return redirect('/admin/wait');
    }

    public function wait()
    {
        return view('admin.wait');
    }

}