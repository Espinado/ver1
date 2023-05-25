<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Customers\Order;
use Illuminate\Http\Request;
use DateTime;



class ReportController extends Controller
{
    public function ReportView()
    {

        return view('admin.reports.report_view');
    }

    public function ReportByDate(Request $request) {
        $date=new DateTime($request->date);
        $formatDate=$date->format('d F Y');
        $orders=Order::where('order_date',$formatDate)->get();
        return view('admin.reports.report_show', compact('orders'));

    }
    public function ReportByMonth(Request $request)
    {
        $orders = Order::where('order_month', $request->month)
            ->where('order_year', $request->year_name)
            ->where('order_month', $request->month)
            ->get();
        return view('admin.reports.report_show', compact('orders'));
    }
    public function ReportByYear(Request $request)
    {
        $orders = Order::where('order_month', $request->month)
            ->where('order_year', $request->year)
            ->get();
        return view('admin.reports.report_show', compact('orders'));
    }
}
