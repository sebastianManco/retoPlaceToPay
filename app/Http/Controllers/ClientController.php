<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use Illuminate\View\View;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**

     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $request->user()->authorizeRoles('user');
        $category = $request->get('type');
        $search= $request->get('search');

        $products = (new Product)->searchProducts($category, $search );

        return view('clients.index', compact('products'));
    }
}
