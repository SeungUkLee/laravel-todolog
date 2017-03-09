<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()   // 컨트롤러의 생성자, auth 미들웨어를 설정->현재컨트롤러의 메서드는 로그인해야 사용 가능
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // 로그인된 경우 index() 메서드는 home뷰로 연결한다
    {
        return view('home');
    }
}
