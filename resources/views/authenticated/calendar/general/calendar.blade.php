@extends('layouts.sidebar')

@section('content')
<!-- スクール予約画面 -->
<!-- 以下のdivタグからvh-100を消した。もし課題に余裕があったらvh-100を戻してメインコンテンツをスクロールできるようにする。 -->
<div class="pt-5" style="background:#ECF1F6;">
  <div class="w-75 m-auto pt-5" style="border-radius:5px; background:#FFF; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
    <div class="w-75 m-auto" style="border-radius:5px;">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>

    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts" onclick="return confirm('予約してもよろしいでしょうか？')" style="margin:20px 0;">
    </div>
  </div>
</div>


<!-- 予約をキャンセル用のモーダル -->
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
          <input type="hidden" class="edit-modal-hidden" name="reserve_id" value="">
          <input type="submit" class="btn btn-danger d-block" value="キャンセル">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
