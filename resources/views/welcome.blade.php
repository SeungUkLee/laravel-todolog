@extends('layouts.app')

{{--app.blade.php--}}
@section('title')
    웰컴 페이지
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Laravel Todo site</div>

                <div class="panel-body">
                    <div class="'container">
                        {{--WelcomeController에서 받은 데이터출력--}}
                        Number of Subscribers : {{ $total['user'] }}</p>
                        Number of Projects : {{ $total['project'] }}</p>
                        Numver of Task : {{ $total['task'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
