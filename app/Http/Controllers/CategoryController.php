<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{




    //mostramos categorias creadas



    //vita principal para crud de categorias
    public function showAllCategories()
    {
        $categories = $this->getAllCategories()->original['categories'];
        return view('crudcategorias.index', compact('categories'));
    }

    //funcion de selector en formulario
    public function getAllCategories()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories], 200);
    }

    public function getAllCategory(Category $category)
    {
        return response()->json(['category' => $category], 200);
    }




    // obtener  categorias vista principal
    public function getCategoriesWithProducts(Category $category)
    {
        $category = Category::with('product')->get();
        $category->load('product');
        return response()->json(['category' => $category], 200);
    }


    // obtener vistas de las categorias en index
    public function getCategoryProduct(Request $request, $id)  //el id es el de la categoria
    {
        $request = $request->all(); // carga todo
        $category = Product::where('category_id', $id)->get();
        // $category->load('product');
        return view('categoriauno.index', ['category' => $category]);
    }

    // obtener productos por categoria vista categoria 1
    public function getCategoryElectric(Product $product)
    {
        return view('detalleuno.index', compact('product'));
    }

    // para guardar categoria
    public function saveCategory(category $categories, CategoryRequest $request)
    {
        $categories = new Category($request->all());
        $this->uploadImages($request, $categories);
        $categories->save();
        return response()->json(['categories' => $categories], 201);
    }

    public function updateCategory(Category $category, CategoryRequest $request)
    {
        $requestAll = $request->all();  //tomamos request
        $this->uploadImages($request, $category);  //realizamos subida
        $requestAll['image'] = $category->image;
        $category->update($requestAll);
        return response()->json($category->refresh(), 201);

        // return response()->json(['category' => $category->refresh()->load('category')], 201);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }

    // subimos imagen por medio de este controlador el & conserva el mismo espacio de memoria
    private function uploadImages($request, &$categories)
    {
        if (!isset($request->image))
            return;
        $random = Str::random(20);

        // aca sacamos el nombre de la imagen
        $image_name = "{$random}.{$request->image->clientExtension()}";
        $request->image->move(storage_path('app/public/images'), $image_name);
        $categories->image = $image_name;
    }

    //datatable
    public function getAllCategoriesForDataTable()
    {
        $categories = Category::get();
        return DataTables::of($categories)
            ->addColumn('actions', function ($row) {
                return "<a
				href='#'
				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='edit'
				class='btn btn-warning btn-sm'>Editar</a>
				<a

				onclick='event.preventDefault();'
				data-id='{$row->id}'
				role='delete'
				class='btn btn-danger btn-sm'>Eliminar</a>";
            })
            ->rawColumns(['actions'])
            ->make();
    }


}
