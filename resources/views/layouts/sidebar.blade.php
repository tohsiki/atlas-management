<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body class="all_content">
  <div class="d-flex">
    <div class="sidebar" style="">
      @section('sidebar')
      <!-- トップ -->
      <div class="d-flex" style="align-items:left; justify-content:space-between; margin-left:5px;">
        <a href="{{ route('top.show') }}" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/house-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">トップ</p>
        </a>
      </div>
      <!-- ログアウト -->
      <div class="d-flex" style="align-items:left; justify-content:space-between; margin-left:5px;">
        <a href="/logout" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/arrow-right-from-bracket-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">ログアウト</p>
        </a>
      </div>
      <!-- スクール予約 -->
      <div class="d-flex" style="align-items:left; justify-content:space-between; margin-left:5px;">
        <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/calendar-days-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">スクール予約</p>
        </a>
      </div>
      <!-- スクール予約確認 -->
    @if(in_array(Auth::user()->role, [1, 2, 3]))
      <div class="d-flex" style="align-items:left; justify-content:space-between; margin-left:5px;">
        <a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/calendar-check-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">スクール予約確認</p>
        </a>
      </div>
      <!-- スクール枠登録 -->
      <div class="d-flex" style="align-items:left; justify-content:space-between; margin-left:5px;">
        <a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/calendar-day-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">スクール枠登録</p>
        </a>
      </div>
    @endif

      <!-- 掲示板 -->
      <div class="d-flex" style="align-items:left; justify-content:space-between; margin-left:5px;">
        <a href="{{ route('post.show') }}" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/message-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">掲示板</p>
        </a>
      </div>

      <!-- ユーザー検索 -->
      <div class="d-flex" style="align-items:center; justify-content:space-between; margin-left:5px;">
        <a href="{{ route('user.show') }}" style="text-decoration: none; color:white;" class="d-flex">
          <img src="{{ asset('image/users-solid.svg') }}" style="width:20px; margin-right:10px;">
          <p style=" font-size:15px;margin-top:1rem;">ユーザー検索</p>
      </a>
      </div>

      @show
    </div>
    <div class="main-container">
      @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>
