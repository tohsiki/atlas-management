<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    // デリート時にも使えるようにする。
    public function reserve(Request $request){
       DB::beginTransaction(); // トランザクションを開始します。
        try {
            $getPart = $request->getPart; // リクエストからgetPartを取得します。
            $getDate = $request->getData; // リクエストからgetDataを取得します。

            $reserveDays = array_filter(array_combine($getDate, $getPart)); // $getDateと$getPartを組み合わせて、空でない要素のみをフィルタリングします。
            foreach ($reserveDays as $key => $value) {
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first(); // 特定の条件に一致するReserveSettingsを取得します
                $reserve_settings->decrement('limit_users'); // 'limit_users'をデクリメントします。
                $reserve_settings->users()->attach(Auth::id()); // 現在のユーザーを関連付けます。

            }
            DB::commit(); // トランザクションをコミットします。
        } catch (\Exception $e) {
            DB::rollback(); // 例外が発生した場合はロールバックします。
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    // 予約をキャンセルする機能
    public function delete(Request $request){
        // $getPart = $request->setting_part; // リクエストからgetPartを取得します。
        // $getDate = $request->setting_reserve;
        // dd($request,$getPart,$getDate);
        // $getPart = $request->id->ReserveSettings()->;
        $reserve_settings = ReserveSettings::where('reserve_setting_id', $request )->first();
        // $getDate = $request->getData;
        // $getPart = $request->id;
        // 部数を戻す記述が必要？
        // $reserve_settings = ReserveSettings::where('setting_reserve', $getDate )->where('setting_part', $getPart)->first();

        $reserve_settings->increment('limit_users');
        $reserve_settings->users()->detach(Auth::id());
        return redirect()->route('calendar.general.show');
    }
}
