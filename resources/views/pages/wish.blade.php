@extends('layout')

@section('content')
<div class="container">
    案件詳細
    <table class="table">
        <tr>
            <th>案件名</th>
            <th>依頼人</th>
        </tr>
        <tr>
            <td>{{$wish->title}}</td>
            <td>{{$wish->user->name}}</td>
        </tr>
        <tr>
            <th colspan="2">詳細</th>
        </tr>
        <tr>
            <img src="{{ $wish->file_path }}"  class="mb-4" max-width="500" max-height="500"/>
        </tr>
        <tr>
            <td colspan="2">{!!$wish->content!!}</td>
        </tr>
    </table>
    <a href="{{ url('/subscribes', $wish->id) }}" class="btn btn-primary btn-lg">応募</a>
</div>
@endsection
