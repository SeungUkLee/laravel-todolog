<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 324p /project 로 요청 보냈을때 
    public function index()
    {
        $user = \Auth::user(); // 세션에서 현재 로그인한 사용자의 정보를 가져오기위해 Auth::user() 메서드를 사용
        $projects = Project::where('user_id',$user->id)->get();
        
        return view('project.index')->with('projects',$projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proj = new Project([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        
        $user = \Auth::user();
        
        $proj->user()->associate($user->id);
        
        $proj->save();

        Log::info('Project 등록 성공', ['user-id'=>$user->id, 'project-id'=>$proj->id]);
        
        return redirect('/project')->with('message', $proj->name . '이 생성되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 328p
    public function show($id)
    {
        $proj = Project::find($id);
        if($proj == null) {
            abort(404, $id, ' Model not found(모델을 찾을 수 없습니다.)');
        } 

        return view('project.show')->with('proj',$proj);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proj = Project::findOrFail($id);

        return view('project.edit')->with('proj',$proj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proj = Project::findOrFail($id);

        $proj->update([
           'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect('/project')->with('message', $proj->name . '프로젝트가 수정되었습니다');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proj = Project::findOrFail($id);

        foreach ($proj->tasks()->get() as $task) {
            $task->delete();
        }
        $proj->delete();
        
        return redirect('/project')->with('messgae', $proj->name . '이 삭제되었습니다');
    }
    
}
