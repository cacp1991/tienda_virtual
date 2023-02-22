<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Product\ProductRequest;

class ProductController extends Controller
{

    // obtener productos con categorias vista categorielectro
	public function getAProduct(Product $product)
	{
		$product = Product::with('product')->get();
		$product->load('product');
    	return view('CategoriElectro.index', compact('category'));

	}
    // mostramos productos
    // public function getAproduct(Product $product)
    // {
    //     $product->load('Category');
    //     return view('CategoriElectro.index', compact('product'));
    //     // $category->load('product');
	// 	// return view('CategoriElectro.index', compact('category'));

    // }
    public function showProducts()
    {
        return view('Items.index');
    }

    public function showAllProducts()
    {
        $products = $this->getAllProducts()->original;
        ['products'];
        return view('Items.index', compact('products'));
    }

    // public function getAllProducts()
    // {
    //     $products = Product::with('products')->get();
    //     return response()->json(['products' => $products], 200);
    // }

    // consultamos
    public function getAllProducts()
    {
        $products = Product::get();
        return response()->json(['products' => $products], 200);
    }

    // funcion para editar productos y cargar el producto consultado


    public function getProduct(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }

    // para guardar productos
    public function saveProduct( ProductRequest $request)
    {
        $products = new Product($request->all());
        $this->uploadImages($request, $products);
        $products->save();
        return response()->json(['products' => $products], 201);
        // return response()->json(['saved' => 'OK'], 201);
    }

    public function updateProduct(  Product $product, ProductRequest $request)
    {
        $requestAll = $request->all();  //tomamos request
        $this->uploadImages($request, $product);  //realizamos subida
        $requestAll['image'] = $product->image;
        $product->update($requestAll);
        return response()->json(['product' => $product->refresh()->load('category')], 201);
    }

    public function deleteProduct( Product $product)
    {
        $product->delete();
        return response()->noContent();
    }

    // subimos imagen por medio de este controlador el & conserva el mismo espacio de memoria
    private function uploadImages($request, &$products){
        if (!isset($request->image))
            return;
        $random = Str::random(20);

        // aca sacamos el nombre de la imagen
        $image_name = "{$random}.{$request->image->clientExtension()}";
        $request->image->move(storage_path('app/public/images'), $image_name);
        $products->image = $image_name;
    }

    public function getAllProductsForDataTable()
    {
        $products = Product::get();
        return DataTables::of($products)
            ->addColumn('actions', function ($row) {
                return "<a
				href='#'
				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='edit'
				class='btn btn-warning btn-sm'>Edit</a>
				<a

				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='delete'
				class='btn btn-danger btn-sm'>Delete</a>";
            })
            ->rawColumns(['actions'])
            ->make();
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $product = new Product;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->save();

    return response()->json(['message' => 'Producto guardado exitosamente'], 201);
}


}
