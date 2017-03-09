<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{
    public function _construct() {
//        $this->middleware('web'); // laravel 5.2.27 이하 버전일 경우 주석제거, 이상이면 주석처리해야 제대로 동작
    }
    /**
     * 사이트 웰컴 화면
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $uc = User::count(); // User::count();
        $pc = Project::count(); // Project::count();
        $tc = Task::count(); // Task::count();

        $total = [
            'user' => $uc,
            'project' => $pc,
            'task' => $tc,
        ];

        return view('welcome')->with('total', $total); // 뷰에 with() 메서드로 표시할 정보를 전달
    }
}
