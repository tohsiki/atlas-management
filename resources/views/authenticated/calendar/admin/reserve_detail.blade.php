@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-75 m-auto h-75">
    <p><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class="h-75 ">
      <table class="reserve-table" style="width:100%;">
        <tr class="text-center">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>
        @foreach($reservePersons as $reservePerson)
          @foreach($reservePerson->users as $user)
          <tr class="text-center">
            <!-- id -->
            <td class="w-25">{{$user->id}}</td>
            <!-- ユーザーネーム -->
            <td class="w-25">{{$user->over_name}}{{$user->under_name}}</td>
            <td>リモート</td>
          </tr>
          @endforeach
        @endforeach
      </table>
    </div>
  </div>
</div>
<style>
table th {
	background: #17a2b8;
  color: white;
}

table td {
	background: #fff;
}

table tr:nth-child(odd) td {
	background: #dff;
}

</style>

@endsection
