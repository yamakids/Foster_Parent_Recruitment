@extends('layout')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
    応募案件
    <table class="table">
        <tr>
            <th>依頼人</th>
            <th>案件名</th>
            <th>状況</th>
            <th>管理</th>
        </tr>
    @if(isset($subscribes))
    @foreach($subscribes as $subscribe)
        <tr>
            <td>{{ $subscribe->wish->user->name }}</td>
            <td>{{ $subscribe->wish->title }}</td>
            <td>{{ $subscribe->getStatusName($subscribe->status) }}</td>
            <td>
              {{ Form::open(['url' => '/subscribes', 'method' => 'post']) }}
                  {{ Form::hidden('wish_id',$subscribe->wish->id) }}
                  {{ Form::hidden('user_id',$subscribe->user->id) }}
                  {{ Form::hidden('status',3) }}
                  {{ Form::submit('引き取り', ['class' => 'btn btn-primary btn-sm']) }}
              {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    @endif
    </table>
</div>
</div>
</div>
@endsection
