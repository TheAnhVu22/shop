<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistical;
use Carbon\Carbon;
class StatisticalController extends Controller
{
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        // return $from_date." ".$to_date;
        $get= Statistical::whereBetween('order_date',[$from_date,$to_date])->orderby('order_date','ASC')->get();

        // chuyển về json
        foreach ($get as $key => $value) {
            $chart_data[]= array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sub30day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $get= Statistical::whereBetween('order_date',[$sub30day,$now])->orderby('order_date','ASC')->get();

        // chuyển về json
        foreach ($get as $key => $value) {
            $chart_data[]= array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        
        if ($data['dashboard_value']=='7ngay') {
             $get= Statistical::whereBetween('order_date',[$sub7day,$now])->orderby('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
             $get= Statistical::whereBetween('order_date',[$thangnay,$now])->orderby('order_date','ASC')->get();
        }
        elseif($data['dashboard_value']=='thangtruoc'){
             $get= Statistical::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderby('order_date','ASC')->get();
        }else{
             $get= Statistical::whereBetween('order_date',[$sub365day,$now])->orderby('order_date','ASC')->get();
        }
       

        // chuyển về json
        foreach ($get as $key => $value) {
            $chart_data[]= array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
