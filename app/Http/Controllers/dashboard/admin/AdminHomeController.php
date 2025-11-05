<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        $data = [];
        $data['customerCount'] = User::where('roles', 'Customer')->count();
        $data['orderCount'] = Order::count();
        $data['productCount'] = Product::count();
        $data['categoryCount'] = Category::count();
        $data['usersCount'] = User::count();
        $data['total'] = order::sum('total_amount');
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $data['this_week'] = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
        // Define start of current and previous month
        $thisMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = $thisMonthStart->copy()->subDay();
        // Customer growth
        $thisMonthCustomers = User::where('roles', 'Customer')->whereBetween('created_at', [$thisMonthStart, now()])->count();
        $lastMonthCustomers = User::where('roles', 'Customer')->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
    
        $customerGrowth = $lastMonthCustomers > 0
            ? (($thisMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100
            : 0;
        $data['customer_growth_percentage'] = round($customerGrowth, 2);

        // Order growth
        $thisMonthOrders = Order::whereBetween('created_at', [$thisMonthStart, now()])->count();
        $lastMonthOrders = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

        $orderGrowth = $lastMonthOrders > 0
            ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100
            : 0;
        $data['order_growth_percentage'] = round($orderGrowth, 2);

        // Revenue growth (based on 'orders.total_amount')
        $thisMonthRevenue = Order::whereBetween('created_at', [$thisMonthStart, now()])->sum('total_amount');
        $lastMonthRevenue = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total_amount');
        $revenueGrowth = $lastMonthRevenue > 0
            ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;
        $data['revenue_growth_percentage'] = round($revenueGrowth, 2);
        // Previous week (Monday to Sunday of last week)
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $data['last_week'] = Order::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                                ->sum('total_amount');
        $data['today_earning'] = Order::whereDate('created_at', Carbon::today())->sum('total_amount');

        $topSellingProducts = OrderItem::select('products.name',
            DB::raw('MAX(order_items.unit_amount) as unit_price'),
            DB::raw('SUM(order_items.quantity) as total_quantity'),
            DB::raw('SUM(order_items.total_amount) as total_amount'),
            DB::raw('MAX(order_items.created_at) as latest_date')
                )->join('products', 'order_items.product_id', '=', 'products.id')
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_quantity')
                ->take(6)
                ->get();
        // Current and previous month range
        $thisMonth = Carbon::now()->startOfMonth();
        $prevMonth = Carbon::now()->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $thisMonth->copy()->subDay();
        // This month total
        $thisMonthTotal = DB::table('order_items')
            ->whereBetween('created_at', [$thisMonth, now()])
            ->sum('total_amount');
        // Last month total
        $lastMonthTotal = DB::table('order_items')
            ->whereBetween('created_at', [$prevMonth, $lastMonthEnd])
            ->sum('total_amount');
        // Monthly growth compared to last month
        $lastMonthGrowth = 0;
        if ($lastMonthTotal > 0) {
            $lastMonthGrowth = (($thisMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
        }
        $data['monthly_growth_percentage'] = round($lastMonthGrowth, 2);
        // Total growth since the first month
        $firstMonth = DB::table('order_items')->orderBy('created_at')->value('created_at');
        $firstMonth = Carbon::parse($firstMonth)->startOfMonth();
        $firstMonthEnd = Carbon::parse($firstMonth)->endOfMonth();
        $firstMonthTotal = DB::table('order_items')
            ->whereBetween('created_at', [$firstMonth, $firstMonthEnd])
            ->sum('total_amount');
        // Total growth since first month
        $totalGrowth = 0;
        if ($firstMonthTotal > 0) {
            $totalGrowth = (($thisMonthTotal - $firstMonthTotal) / $firstMonthTotal) * 100;
        }
        $data['total_growth_percentage'] = round($totalGrowth, 2);

        return view('dashboard.home.analytics', $data,compact('topSellingProducts'));
    }

    public function contactIndex() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.add-quicklink');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
    }
}
