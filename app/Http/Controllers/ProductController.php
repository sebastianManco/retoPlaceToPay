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
        $search= $request->get('search');
        $products = (new Product)->searchProducts($category, $search );

        return view('products.index', ['products' => $products, 'search' => $products]);
    }

    /**
    * Undocumented function
    * @return View
    */
    public function create() : View
    {
        return view('products.create', ['product' => new Product()]);
    }

    /**
     * @param ProductCreateRequest $request
     * @param Product $products
     * @return RedirectResponse
     */
    public function store(ProductCreateRequest $request, Product $products): RedirectResponse
    {
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->stock = $request->input('stock');
        $products->save();

        if ($request->hasFile('image')) {
            $images = new Image();
            $image = $request->file('image')->store('Images');
            $images->name = $image;
            $images->product_id = $products->id;
            $products->image()->save($images);
        }
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
            ['image'=> function ($query) {
                $query->select('id', 'name', 'product_id');
            }
            ]
        )
            ->find($id);
        return view('products.details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return  View
     */
    public function edit(int $id): View
    {
        $product = Product::find($id);
        $images = Image::find($id);

        $categories = (new Category)->getCachedCategories();
        return view('products.edit', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    /**
     * Undocumented function
     * @param ProductEditRequest $request
     * @param int $id
     */
    public function update(productEditRequest $request, int $id)
    {
        $products = Product::find($id);
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->stock = $request->input('stock');
        $products->active = (!request()->has('active') == '1' ? '0' : '1');
        $products->save();
        if ($request->hasFile('image')) {
            $images = new Image();
            $image = $request->file('image')->store('Images');
            $images->name = $image;
            $images->product_id = $products->id;
            $products->image()->save($images);
        }
        return redirect(route('products.index')) ;
    }
}
