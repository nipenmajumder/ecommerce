<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $orderCount = Order::query()->where('created_at', '>=', today())->count();
        $totalBooks = Product::count();
        $totalStock = Stock::where('stock_status', 1)->count();
        $totalSold = Stock::where('stock_status', 2)->count();
        $totalStockPrice = Stock::where('stock_status', 1)->sum('purchase_price');
        $totalSoldBooksPrice = Stock::where('stock_status', 2)->sum('sell_price');
        return view('backend.dashboard', compact('orderCount', 'totalBooks', 'totalStock', 'totalSold', 'totalStockPrice', 'totalSoldBooksPrice'));
    }
}
