@extends('layout')

@section('content')
<div class="container">
    案件一覧
    <table class="table">
        <tr>
            <th>案件名</th>
            <th>依頼人</th>
            <th>状況</th>
        </tr>

    @foreach($list as $wish)
        <tr>
            <td><a href="/wish/{{ $wish->id }}">{{ $wish->title }}</a></td>
            <td>{{ $wish->user->name }}</td>
          @php
           $i = 0;
          @endphp
          @forelse($wish->subscribes as $subscribe)
          @if($subscribe->status!=1)
            <td>契約済み</td>
          @endif
          @if($subscribe->status==1)
          @php
           $i++;
          @endphp
          @if($i==$wish->subscribes->count())
            <td>募集中</td>
          @endif
          @endif
          @empty
            <td>募集中</td>
          @endforelse
        </tr>
    @endforeach
    </table>
    <div class="d-flex justify-content-center mb-5">
     {{ $list->links() }}
    </div>
</div>
@endsection
