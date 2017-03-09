<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins; //트레이트

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
//    protected $redirectTo = '/';
    protected $redirectTo = '/home'; // 로그인 인증된 사용자는 /home으로 전환되도록 하기위해서

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 291p
        // guest 미들웨어 등록, logout 제외
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|mobile_phone|min:11|max:13', //385p
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
        ]);
    }

    // 293p
    public function redirectPath() {
        if(property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * 사용자를 깃허브 인증 페이지로 전환
     *
     * @return Response
     */
    public function redirectToGitHub() {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 깃허브에서 인증이 완료된 사용자 정보를 받아서 처리
     *
     * @return Response
     */
    public function handleGitHubCallback(Request $request) {
        try {
            $user = Socialite::driver('github')->user();
        } catch(Exception $e) {
            return redirect('auth/github');
        }

        $user = $this->findOrCreateUser($user);

        \Auth::login($user);
        $request->session()->put('github_id',$user->id); // 세션에 github_id 저장

        return redirect()->intended($this->redirectPath());

    }

    /**
     * 깃허브 인증에 성공한 후 받은 사용자 정보가 db에 없을 경우 생성하고 이미 있을 경우 가져온다
     *
     * @param $githubUser 깃허브에서 전달받은 사용자 정보
     * @return User
     */
    private function findOrCreateUser($githubUser){
        if($user = User::where('github_id', $githubUser->id)->first()) {
            return $user;
        }

        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id'=> $githubUser->id,
        ]);
    }
}
