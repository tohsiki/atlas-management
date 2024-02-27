<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

// スクール予約
class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table m-auto border">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th class="border">月</th>';
    $html[] = '<th class="border">火</th>';
    $html[] = '<th class="border">水</th>';
    $html[] = '<th class="border">木</th>';
    $html[] = '<th class="border">金</th>';
    $html[] = '<th class="border">土</th>';
    $html[] = '<th class="border">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();

    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay > $day->everyDay()){
          $html[] = '<td class="calendar-td past-day border">';
        }else{
          $html[] = '<td class="calendar-td border '.$day->getClassName().'">';
        }
        $html[] = $day->render();


        if(in_array($day->everyDay(), $day->authReserveDay())){
          // 予約したら赤く出るやつ
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          // 処理終わったらtoDayから=取る。
           if($startDay <= $day->everyDay() && $toDay >$day->everyDay()){
            // 予約している過去
            // $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px;color:black">受付終了b</p>';
             $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
            if($reservePart == 1){
                $reservePart = "1部参加";
            }else if($reservePart == 2){
                $reservePart = "2部参加";
            }else if($reservePart == 3){
                $reservePart = "3部参加";
            }
             $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px;color:black">' . $reservePart . '</p>';
             $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $reserveId = $day->authReserveDate($day->everyDay())->first()->id;
            // dd($reserveId);
            // 予約している今と未来
                         // ボタンに選択された予約日とreservePartをデータ属性として追加し、モーダルで取得して表示する
            $html[] = '<button type="submit" class="cancel-modal-open btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px"
            value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'"
            data-reserve-part="'. $reservePart .'"
            data-reserve-date="'. $day->everyDay() .'"
            data-reserve-id="' .$reserveId. '">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          //予約をしていない場合
          // ここに過去と未来のif文を足す
          if($startDay <= $day->everyDay() && $toDay >$day->everyDay()){
            //予約をしていない過去
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px;color:black">受付終了</p>';
              $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
            }else{
            //予約をしていない未来
             $html[] = $day->selectPart($day->everyDay());
          }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }


  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
