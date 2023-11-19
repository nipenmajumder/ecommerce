<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FragmentProduct;
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
        $books = Product::count();
        $fragmentBooks = FragmentProduct::count();
        $totalBooks = $books + $fragmentBooks;
        $stock = Stock::where('stock_status', 1)->count();
        $fragmentStock = Stock::where('stock_status', 1)->count();
        $totalStock = $stock + $fragmentStock;
        $sold = Stock::where('stock_status', 2)->count();
        $fragmentSold = Stock::where('stock_status', 2)->count();
        $totalSold = $sold + $fragmentSold;
        $stockPrice = Stock::where('stock_status', 1)->sum('purchase_price');
        $fragmentStockPrice = Stock::where('stock_status', 1)->sum('purchase_price');
        $totalStockPrice = $stockPrice + $fragmentStockPrice;
        $soldBooksPrice = Stock::where('stock_status', 2)->sum('sell_price');
        $fragmentSoldBooksPrice = Stock::where('stock_status', 2)->sum('sell_price');
        $totalSoldBooksPrice = $soldBooksPrice + $fragmentSoldBooksPrice;
        return view('backend.dashboard', compact('orderCount', 'totalBooks', 'totalStock', 'totalSold', 'totalStockPrice', 'totalSoldBooksPrice'));
    }
}
