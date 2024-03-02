@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 border d-flex vh-100" >
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person" style="border-radius:8px; color:rgba(0, 0, 0, 0.8); box-shadow: 0 0 8px rgba(0,0,0,0.2);">
      <table style="margin-left:5px;">
        <div>
          <span style="color:rgba(0, 0, 0, 0.5);">ID : </span><span>{{ $user->id }}</span>
        </div>
        <div>
          <span style="color:rgba(0, 0, 0, 0.5);">名前 : </span>
          <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="text-info">
            <span>{{ $user->over_name }}</span>
            <span>{{ $user->under_name }}</span>
          </a>
        </div>
        <div>
          <span style="color:rgba(0, 0, 0, 0.5);">カナ : </span>
          <span>({{ $user->over_name_kana }}</span>
          <span>{{ $user->under_name_kana }})</span>
        </div>
        <div>
          @if($user->sex == 1)
          <span style="color:rgba(0, 0, 0, 0.5);">性別 : </span><span>男</span>
          @elseif($user->sex == 2)
          <span style="color:rgba(0, 0, 0, 0.5);">性別 : </span><span>女</span>
          @else
          <span style="color:rgba(0, 0, 0, 0.5);">性別 : </span><span>その他</span>
          @endif
        </div>
        <div>
          <span style="color:rgba(0, 0, 0, 0.5);">生年月日 : </span><span>{{ $user->birth_day }}</span>
        </div>
        <div>
          @if($user->role == 1)
          <span style="color:rgba(0, 0, 0, 0.5);">権限 : </span><span>教師(国語)</span>
          @elseif($user->role == 2)
          <span style="color:rgba(0, 0, 0, 0.5);">権限 : </span><span>教師(数学)</span>
          @elseif($user->role == 3)
          <span style="color:rgba(0, 0, 0, 0.5);">権限 : </span><span>講師(英語)</span>
          @else
          <span style="color:rgba(0, 0, 0, 0.5);">権限 : </span><span>生徒</span>
          @endif
        </div>
        <div>
          @if($user->role == 4)
          <!-- 選択科目を表示する処理 -->
          <span style="color:rgba(0, 0, 0, 0.5);">選択科目 :</span>
          @foreach($user->subjects as $subject)
          <span>{{ $subject->subject }}</span>
          @endforeach
          @endif
        </div>
      </table>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 border">
    <div class="" style="width:90%; margin:20px 0 0 10px;">
      <h5 style="color: #2c5273;">検索</h5>
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest" style="background-color: rgba(0, 0, 0, 0.05);outline: none; border: 1px solid #ccc;border-radius:5px;width:90%;height:40px;">
      </div>
      <!-- ログインのロゴと同じく縦並びに変える。 -->
      <div style=" margin-top:15px;">
        <label style="color: #2c5273;">カテゴリ</label>
        <select form="userSearchRequest" name="category" style="background-color: rgba(0, 0, 0, 0.05);outline: none; border: 1px solid #ccc;border-radius:5px; width:30%; height:30px;" class="user-select">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label style="color: #2c5273; margin-top:10px;">並び替え</label>
        <select name="updown" form="userSearchRequest" style="background-color: rgba(0, 0, 0, 0.05);outline: none; border: 1px solid #ccc;border-radius:5px;width:30%;height:30px;" class="user-select">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>


      <div class="" style=" margin-top:15px;">
        <!-- モーダル -->
         <div class="d-flex search_conditions" style="align-items:center; justify-content: space-between;border-bottom:solid 1px rgba(0, 0, 0, 0.3);">
          <p class="m-0"><span>検索条件の追加</span></p>
            <div class="search-trigger">
              <span></span>
              <span></span>
            </div>
          </div>
        <div class="search_conditions_inner">
          <div class="search-list">
            <label style="color: #2c5273;" class="search-label">性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div class="search-list">
            <label style="color: #2c5273;" class="search-label">権限</label>
            <select name="role" form="userSearchRequest" class="engineer" style="background-color: rgba(0, 0, 0, 0.05);outline: none; border: 1px solid #ccc;border-radius:5px;width:40%;height:30px; font-size:13px;" >
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer search-list">
            <label style="color: #2c5273;" class="search-label">選択科目</label>
            @foreach($subjects as $subject)
              <span>{{ $subject->subject }}</span><input type="checkbox" name="subjects[]" value="{{ $subject->id }}" form="userSearchRequest">
            @endforeach
          </div>
        </div>
      </div>
      <div class="d-flex" style="justify-content:center;margin-top:15px;">
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest" class="btn btn-info" style="width:80%;border-radius:5px;margin-bottom:10px;">
      </div>

      <div class="d-flex" style="justify-content:center;">
        <a href="{{ route('user.show') }}" class="text-info">リセット</a>
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
