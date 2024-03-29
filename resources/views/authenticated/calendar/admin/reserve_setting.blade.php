@extends('layouts.sidebar')
@section('content')
<!-- <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-100 vh-100 border p-5">
    {!! $calendar->render() !!}

    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div> -->
<!-- レイアウト確認用
 -->
 <div class=" pt-5" style="background:#ECF1F6;">
  <div class=" w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
    <div class="w-75 m-auto" style="border-radius:5px;">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
       {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')" style="margin:20px 0;">
    </div>
  </div>
</div>
@endsection
