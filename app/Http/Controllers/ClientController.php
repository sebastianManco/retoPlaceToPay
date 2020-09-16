<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;

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
     * @return \Illuminate\View\View
     */
    public function index(Request $request):\Illuminate\View\View
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
        $products = $query
            ->stock()
            ->active()
            ->paginate(3, ['id','name']);

        return view('clients.index', compact('products'));
    }
}
