@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
     {{ Form::open(['url' => '/wishes', 'method' => 'post', 'files' => true]) }}
        <div class="form-group row">
        {{ Form::label('title', '案件名') }}
        {{ Form::text('title',$title, ['class' => 'form-control']) }}
        @if($errors->has('title'))<br><span class="error" style='color:red;'>{{ $errors->first('title') }}</span> @endif
        </div>
        <div class="form-group row">
        {{ Form::label('body', '詳細') }}
        {{ Form::textarea('body',$body, ['class' => 'form-control']) }}
        @if($errors->has('body'))<br><span class="error" style='color:red;'>{{ $errors->first('body') }}</span> @endif
        </div>
        <div class="form-group row">
        {{ Form::label('image', '写真') }}
        {{ Form::file('image', ['id' => 'image','class' => 'form-control' ,'accept' => 'image/png, image/jpeg ,image/jpg']) }}
        @if($errors->has('image'))<br><span class="error" style='color:red;'>{{ $errors->first('image') }}</span> @endif
        </div>
        <div class="form-group row">
        {{ Form::submit('登録', ['class' => 'btn']) }}
        {{ Form::hidden('func',1) }}
        </div>
      {{ Form::close() }}
    </div>
    <div class="col-md-8">
      {{ Form::open(['url' => '/wishes', 'method' => 'post']) }}
          応募一覧
          <table class="table">
              <tr>
                  <th>応募者</th>
                  <th>メッセージ</th>
                  <th>状況</th>
              </tr>
          @if(isset($subscribes))
          @foreach($subscribes as $subscribe)
              <tr>@php\Debugbar::addMessage($subscribe->user->id);@endphp
                  <td>{{Form::radio('user_id',$subscribe->user->id)}} <a href='/portfolio/{{ $subscribe->user->id }}'>{{ $subscribe->user->name }}</a></td>
                  <td>{{ $subscribe->message }}</td>
                  <td>{{ $subscribe->getStatusName($subscribe->status) }}</td>
              </tr>
          @endforeach
          @endif
          </table>
          {{ Form::submit('決定', ['class' => 'btn btn-primary']) }}
          {{ Form::hidden('func',2) }}
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection
