@extends('layout')

@section('content')
<div class="container">
    実績一覧
    <table class="table">
        <tr>
          <td>案件名</td>
        </tr>
    @foreach($list as $portfolio)
        <tr>
          <td>{{ $portfolio->title }}</td>
        </tr>
    @endforeach
    </table>
</div>
@endsection
