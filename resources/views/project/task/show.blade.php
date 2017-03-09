@extends('layouts.app')

@section('title')
    Task 정보
@endsection

@section('content')

    <div class="col-md-8">

        <h3>Task 정보</h3>

        <div class="form-group">
            <label for="Project name">Task 명</label>
            <div>
                <input type="text" class="form-control" name="name" value="{{ $task->name }}" readonly="true">
            </div>
        </div>

        <div class="form-group">
            <label for="설명">설명</label>
            <div>
                <textarea class="form-control" rows="3" name="description" readonly="true">{{ $task->description }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="우선순위">우선순위</label>
            <div>
                <input type="text" class="form-control" name="created_at" value="{{ $task->priority }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="상태">상태</label>
            <div>
                <input type="text" class="form-control" name="created_at" value="{{ $task->status }}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="생성일">생성일</label>
            <div>
                <input type="text" class="form-control" name="created_at" value="{{ $task->created_at }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="수정일">수정일</label>
            <div>
                <input type="text" class="form-control" name="updated_at" value="{{ $task->updated_at }}" readonly>
            </div>
        </div>
    </div>
@endsection