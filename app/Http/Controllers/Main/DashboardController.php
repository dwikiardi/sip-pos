<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function chart(Request $request)
    {
        $chart = array();
        if($request->filter == 'product') {
            $data = DB::table('products')
                    ->select('products.id', 'products.name', DB::raw('SUM(sale_details.quantity) as quantity'))
                    ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
                    ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
                    ->whereMonth('sales.sale_date', $request->bulan)
                    ->whereYear('sales.sale_date', $request->tahun)
                    ->groupBy('products.id')
                    ->get();
        }
        foreach ($data as $key => $value) {
            $chart[] = [
                'nama_produk' => $value->name,
                'jumlah' => $value->quantity,
            ];
        }
        $maxVal = array_keys(array_column($chart, 'jumlah'), max(array_column($chart, 'jumlah')));
        $minVal = array_keys(array_column($chart, 'jumlah'), min(array_column($chart, 'jumlah')));

        $terendahProduk = [];
        $terendahValue = [];
        $terendah = [];
        for($i = 0; $i < count($minVal); $i++) {
            array_push($terendahValue, $chart[$minVal[$i]]['jumlah']);
            array_push($terendahProduk, $chart[$minVal[$i]]['nama_produk']);
            array_push($terendah, $chart[$minVal[$i]]['nama_produk'] . ' dengan ' . $chart[$minVal[$i]]['jumlah'] . ' buah');
        }

        $tertinggiProduk = [];
        $tertinggiValue = [];
        $tertinggi = [];
        for($i = 0; $i < count($maxVal); $i++) {
            array_push($tertinggiValue, $chart[$maxVal[$i]]['jumlah']);
            array_push($tertinggiProduk, $chart[$maxVal[$i]]['nama_produk']);
            array_push($tertinggi, $chart[$maxVal[$i]]['nama_produk'] . ' ' . $chart[$maxVal[$i]]['jumlah'] . ' buah');
        }

        $view = [
            'data' => view('dashboard.chart.index')->with([
                'bulan' => bulan()[$request->bulan-1],
                'tahun' => $request->tahun,
                'chart' => $chart,
                'totalData' => count($data),
                'tertinggiProduk' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($tertinggiProduk))),
                'tertinggiValue' => str_replace(' ', ', ', implode(" ", $tertinggiValue)),
                'terendahProduk' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($terendahProduk))),
                'terendahValue' => str_replace(' ', ', ', implode(" ", $terendahValue)),
                
                'tertinggi' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($tertinggi))),
                'terendah' => str_replace(',', ', ', str_replace(['["', '"]', '"'], '', json_encode($terendah)))
            ])->render()
        ];

        return response()->json($view);
    }
}
