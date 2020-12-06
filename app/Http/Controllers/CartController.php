<?php

namespace App\Http\Controllers;

use App\Events\soldOutEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use phpDocumentor\Reflection\DocBlockFactoryInterface;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $cartProducts = \Cart::session(auth()->id())->getContent();
        return view('Cart.indexCart', compact('cartProducts'));
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Product $product, CartRequest $request): RedirectResponse
    {
        $products = Product::with([
            'image' => function ($query) {
                $query->select('id', 'name');
            }
        ])->get();
        foreach ($products as $product) {
            if ($product->stock - $request->input('quantity') < 0) {
                return redirect()->route('products.show')
                    ->with('status', 'cantidad de producto no encontrada');
            } else {
                \Cart::session(auth()->id())->add(array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->input('quantity'),
                    'attributes' => array(
                        'relations' => array()
                    ),
                    'associatedModel' => Product::class
                ));

                $product->stock = $product->stock - $request->input('quantity');
                $product->save();
                if ($product->stock <= 2) {
                    event(new soldOutEvent($product));
                }
            }
        }
        return redirect()->route('products/indexClient')
            ->with('status', 'Tu producto a sido agregado');
    }


    /**
     * @param int $id
     * @param CartRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, CartRequest $request): RedirectResponse
    {
        \Cart::session(auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->input('quantity'),
            ),
        ));
        return back();
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function destroy(int $productId): RedirectResponse
    {
        \Cart::session(auth()->id())->remove($productId);

        return back()->with('status', 'Tu producto ha sido eliminado');
    }

    /**
     * @return RedirectResponse
     */
    public function clear(): RedirectResponse
    {

        \Cart::session(auth()->id())->clear();
        return redirect()->route('home');
    }
}
