<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function render() 
    {
        $product = Product::with('attribute')->get();
        $view = [
            'data' => view('product.render')->with([
                'product' => $product
            ])->render()
        ];

        return response()->json($view);
    }

    public function create() 
    {
        $category = Category::pluck('name', 'id')->prepend('Pilih kategori...', '')->toArray();
        $view = [
            'data' => view('product.create', compact('category'))->render()
        ];

        return response()->json($view);
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'category_id' => $request->category,
                'price' => preg_replace('/[^0-9]/', '', $request->price),
                'sell_price' => preg_replace('/[^0-9]/', '', $request->sell_price),
            ];

            if($request->hasFile('image')) {
                //get filename with extension
                $filenamewithextension = $request->file('image')->getClientOriginalName();

                //get file extension
                $extension = $request->file('image')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->name . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/product';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('image')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $data['image'] = $save_path . '/' . $filenametostore;
            } else {
                $data['image'] = 'assets/images/blank.jpg';
            }
            Product::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Data gagal tersimpan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id) 
    {
        $product = Product::with('attribute')->where('id', $id)->first();
        $category = Category::pluck('name', 'id')->prepend('Pilih kategori...', '')->toArray();
        $view = [
            'data' => view('product.edit', compact('category', 'product'))->render()
        ];

        return response()->json($view);
    }

    public function update(ProductRequest $request)
    {
        try {
            $product = Product::find($request->id);
            $data = [
                'name' => $request->name,
                'category_id' => $request->category,
                'price' => preg_replace('/[^0-9]/', '', $request->price),
                'sell_price' => preg_replace('/[^0-9]/', '', $request->sell_price),
            ];

            if($request->hasFile('image')) {
                //get filename with extension
                $filenamewithextension = $request->file('image')->getClientOriginalName();

                //get file extension
                $extension = $request->file('image')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->name . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/product';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('image')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $data['image'] = $save_path . '/' . $filenametostore;
            }
            
            $product->update($data);

            // update attribute
            ProductAttributes::updateOrCreate([
                'product_id' => $request->id
            ], [
                'product_id' => $request->id,
                'stock' => $request->stock,
                'product_rejected' => $request->rejected,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Data gagal tersimpan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            unlink($product->image);
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
