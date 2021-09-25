<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function reports(){

        $orders_summary = DB::table('statuses')
            ->leftJoin('orders','orders.status','=','statuses.id')
            ->select('statuses.id','statuses.status',DB::raw('count(orders.id) AS qty'))
            ->groupBy('statuses.id','statuses.status')
            ->orderBy('statuses.id')
            ->get();

        

        //dd($orders_summary);
        return view('admin.reports.index',compact('orders_summary'));
    }

    public function generatereports(Request $request){
        $orders = Order::with('getstatus')->whereBetween('order_date',[date($request->start_date),date($request->end_date)])->get();

        

        return view('admin.reports.report',compact('orders'));
    }

    
}
