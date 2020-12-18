@extends('layout')

@section('content')
<div class="container">
    応募
    <table class="table">
        <tr>
            <th>案件名</th>
            <th>依頼人</th>
        </tr>
        <tr>
            <td>{{$wish->title}}</td>
            <td>{{$wish->user->name}}</td>
        </tr>
    </table>
    <div class="row justify-content-center">
        <div class="col-md-8" style="height: 100px;">
        応募が完了しました。依頼者から決定されるまでお待ちください。<a href="{{ url('/subscribes') }}" class="btn btn-primary">応募状況</a>
        </div>
        <div class="col-md-8">
            応募メッセージ
        </div>
        <div class="col-md-8">
            {{$message}}
        </div>
    </div>
</div>
@endsection
