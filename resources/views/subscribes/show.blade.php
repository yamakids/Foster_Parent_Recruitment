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
    応募しますか？<br>メッセージを書いて自分をアピールしてください。
    </div>
    <div class="col-md-8">
      {{ Form::open(['url' => '/subscribes', 'method' => 'post']) }}
        <div class="form-group row">
          {{ Form::label('message', '応募メッセージ') }}
          {{ Form::textarea('message',$message, ['class' => 'form-control']) }}
        @if($errors->has('message'))<br><span class="error" style='color:red;'>{{ $errors->first('message') }}</span> @endif
          {{ Form::hidden('wish_id',$wish_id) }}
          {{ Form::hidden('user_id',$user_id) }}
          {{ Form::hidden('status',1) }}
        </div>
        <div class="form-group row">
          {{ Form::submit('応募', ['class' => 'btn btn-primary']) }}
        </div>
      {{ Form::close() }}
    </div>
</div>
</div>
@endsection
