@extends('layouts.sidebar')

@section('content')
<!-- スクール予約確認画面-->
<!-- この画面をまるパクりしたい。 -->
<div class="pt-5" style="background:#ECF1F6;">
  <div class="w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
    <div class="w-75 m-auto" style="border-radius:5px;">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
