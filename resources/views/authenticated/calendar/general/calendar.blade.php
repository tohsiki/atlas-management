@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

<!-- 予約をキャンセルするモーダルに変える -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <!-- 送り先をキャンセルするところに変更する 　idも添えて送れるようにしたい。-->
    <form action="{{ route('deleteParts') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <!-- 選択した日付 -->
          <p>予約日：<span name="reserve_date"></span></p>
          <!-- 選択した時間 -->
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
           <p>時間：<span name="reserve_part" ></span></p>
           <p>上記の予約をキャンセルしてもよろいでしょうか？</p>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-primary d-inline-block" href="">閉じる</a>
          <!-- idを受け取る。　ここは投稿の編集画面から引っ張れる？ -->
          <input type="hidden" class="edit-modal-hidden" name="reserve_setting_id" value="">
          <input type="submit" class="btn btn-danger d-block" value="キャンセル">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
