<?php
namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Product;
use App\Category;
use App\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use Illuminate\View\View;

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

        $category = $request->get('type');
        $search= $request->get('search');
        $query = Product::with(
            ['image' => function ($query) {
                $query->select('id', 'name', 'product_id');
            },
            'category' => function ($query) {
                $query->select('id', 'name');
            }
            ]
        );
        switch ($category) {
            case 'name':
                $query->name($search);
                break;
            default:
                $query->category($search);
                break;
        }
        $products = $query->paginate(3, ['id','name']);

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

        $categories = Cache::remember(
            'categories',
            now()
            ->addDay(),
            function () {
                return Category::all();
            }
        );
        return view('products.edit', compact('product'), compact('categories'));
    }

    /**
     * Undocumented function
     * @param int $id
     * @param ProductEditRequest $request
     * @return Redirector
     */
    public function update(ProductEditRequest $request, int $id):Redirector
    {
        $products = Product::find($id);
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->stock = $request->input('stock');
        $products->active = (!request()->has('active') == '1' ? '0' : '1');
        $products->save();
        foreach ($products->image as $images) {
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('public');
                $images->name = $image;
                $images->save();
            }
        }
        return redirect(route('products.index')) ;
    }
}
