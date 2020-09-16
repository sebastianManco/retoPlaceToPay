<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            'auth',
        ]);
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
    public function add(Product $product, Request $request)
    {
        if($product->stock - $request->input('quantity') < 0 ) {
            return('cantidad no encontrada');
        }
        else {
            \Cart::session(auth()->id())->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => request('quantity'),
                'attributes' => array(),
                'associatedModel' => Product::class
            ));

            $product->stock = $product->stock - $request->input('quantity');
            $product->save();

            return redirect()->route('products/indexClient')
                ->with('status', 'Tu producto ha sido agregado');
        }
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id)
    {
        \Cart::session(auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => request('quantity'),
            ),
        ));
        return back();
    }

    /**
     * Delete the specific cart product
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($productId)
    {

        \Cart::session(auth()->id())->remove($productId);

        return back()->with('status', 'Tu producto ha sido eliminado');
    }


}
