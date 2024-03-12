<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $chartSP = $this->getChartOrderByDate();
        $chartOrders = $this->getOrderChart();
        $report = $this->getNumberReport();
        // var_dump($report);
        return view('admin.dashboard.index', ['chartOrders' => $chartOrders, 'chartSP' => $chartSP, 'report' => $report]);
    }
    public function getOrderChart()
    {
        $chart = [];
        $countOrderCancel =  Order::where('status', config('app.order_status.CANCEL'))->count();
        if ($countOrderCancel) {
            $chart[] = $countOrderCancel;
        } else {
            $chart[] = 0;
        };
        $countOrderActive = Order::where('status', config('app.order_status.ORDER'))->orwhere('status', config('app.order_status.ACCEPT'))->orwhere('status', config('app.order_status.SHIPPING'))->count();
        if ($countOrderActive) {
            $chart[] = $countOrderActive;
        } else {
            $chart[] = 0;
        };
        $countOrderDone = Order::where('status', config('app.order_status.DONE'))->count();
        if ($countOrderDone) {
            $chart[] = $countOrderDone;
        } else {
            $chart[] = 0;
        };
        return $chart;
    }
    public function getChartOrderByDate()
    {
        $chart = [];
        $orders = Order::select(DB::raw('DATE(created_at) as order_date'), DB::raw('count(*) as total_orders'))->groupBy('order_date')->orderBy('order_date', 'asc')->limit(7)->get();
        foreach ($orders as $key => $order) {
            $chart['label'][] = date('d/m', strtotime($order->order_date));
            $chart['data'][] = $order->total_orders;
        }
        return $chart;
    }
    public function getNumberReport()
    {
        $report = [];
        $countOrders = Order::count();
        $report['countOrder'] = $countOrders;
        $countProduct = Product::count();
        $report['countProduct'] = $countProduct;
        $countCategory = Category::count();
        $report['countCategory'] = $countCategory;
        $countUser = User::count();
        $report['countUser'] = $countUser;
        return $report;
    }
}
