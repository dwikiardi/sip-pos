<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('sale.index');
    }

    public function search($slug)
    {
        $product = Product::with('attribute')->where('name', 'LIKE', '%' . $slug . '%')->get();

        return response()->json($product);
    }

    public function detail()
    {
        $data = Sale::with('detail.product', 'user')->get();
        return view('sale.detail', compact('data'));
    }

    public function detailRender()
    {
        $data = Sale::with('detail.product', 'user')->get();
        
        $view = [
            'data' => view('sale.detail.update', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function detailFilter($start, $end)
    {
        $data = Sale::with('detail.product', 'user')->whereBetween('sale_date', [$start, $end])->get();
        $view = [
            'data' => view('sale.detail.update', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function print($start, $end)
    {
        $data = Sale::with('detail.product', 'user')->whereBetween('sale_date', [$start, $end])->get();
        $view = [
            'data' => view('sale.detail.print', compact('data'))->render()
        ];

        return response()->json($view);
    }
}
