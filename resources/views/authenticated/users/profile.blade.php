@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="profile-title" style="font-weight: 200;"><h5><span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span></h5></div>


  <div class="top_area w-75 m-auto pt-5">
    <div class="user_status p-3">
      <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
      <div>選択科目 :
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
      </div>
      <div class="">
        @can('admin')
        <div class="subject_edit_btn d-flex" style="align-items:center;">
          <span class="text-info">選択科目の編集</span>
        <div class="subject-trigger">
          <span></span>
          <span></span>
        </div>
        </div>
        <div class="subject_inner">
          <div class="d-flex" style="width:45%;">
           <form action="{{ route('user.edit') }}" method="post" class="d-flex" style="justify-content:space-between;align-items:center;" >
              @foreach($subject_lists as $subject_list)
              <div style="margin-right:8px; margin-top:5px;">
                <label>{{ $subject_list->subject }}</label>
                <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
              </div>
              @endforeach
              <input type="submit" value="登録" class="btn btn-primary">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              {{ csrf_field() }}
            </form>

          </div>

        </div>
        @endcan
      </div>
    </div>
  </div>
</div>

@endsection
