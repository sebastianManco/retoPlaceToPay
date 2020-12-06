<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Product;
use App\Category;
use App\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**
     * @param SearchRequest $request
     * @return View
     */
    public function index(SearchRequest $request): View
    {
        $request->user()->authorizeRoles('admin');

        $category = $request->get('type');
        $search = $request->get('search');

        $products = (new Product())->searchProducts($category, $search);

        return view('products.index', ['products' => $products, 'search' => $products]);
    }

    /**
    * Undocumented function
    * @return View
    */
    public function create(): View
    {
        return view('products.create', ['product' => new Product()]);
    }

    /**
     * @param ProductCreateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $this->storeUpdate($request, new product());

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        app()->setLocale('en');

        $product = Product::with(
            [
                'image' => function ($query) {
                    $query->select('id', 'name', 'product_id');
                },
                'category' =>  function ($query) {
                    $query->select('id', 'name');
                }
            ]
        )->findOrFail($id);


        return view('products.details', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return  View
     */
    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);

        $categories = (new Category())->getCachedCategories();
        return view('products.edit', [
            'categories' => $categories,
            'product' => $product,

        ]);
    }

    /**
     * @param ProductEditRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(productEditRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $this->storeUpdate($request, $product);

        return redirect(route('products.index')) ;
    }


    /**
     * @param Request $request
     * @param Product $product
     * @return Product
     */
    private function storeUpdate(Request $request, Product $product): Product
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->stock = $request->input('stock');
        $product->active = (!request()->has('active') == '1' ? '0' : '1');
        $product->save();

        if ($request->hasFile('image')) {
            $images = new Image();
            $image = $request->file('image')->store('Images');
            $images->name = $image;
            $images->product_id = $product->id;
            $product->image()->save($images);
        }
        return $product;
    }
}
