<?php

namespace App\Http\Controllers;

use App\Events\soldOutEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlockFactoryInterface;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**
     * Show the cart products
     */
    public function index()
    {

        $cartProducts = \Cart::session(auth()->id())->getContent();

        return view('Cart.indexCart', compact('cartProducts'));
    }

    /**
     * Add a product to the Customer Cart
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Product $product, CartRequest $request)
    {


            if ($product->stock - $request->input('quantity') < 0) {
                return ('cantidad no encontrada');
            } else {
                \Cart::session(auth()->id())->add(array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->input('quantity'),
                    'attributes' => array(),
                    'associatedModel' => Product::class
                ));

                $product->stock = $product->stock - $request->input('quantity');
                $product->save();
                if ($product->stock == 2){
                    event(new soldOutEvent($product));
                }

                return redirect()->route('products/indexClient')
                    ->with('status', 'Tu producto a sido agregado');

            }

    }


    /**
     * @param int $id
     * @param CartRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, CartRequest $request)
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
     * Delete the specific cart product
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $productId)
    {

        \Cart::session(auth()->id())->remove($productId);

        return back()->with('status', 'Tu producto ha sido eliminado');
    }

    public function clear(){

        \Cart::session(auth()->id())->clear();
        return redirect()->route('home');
    }


}
