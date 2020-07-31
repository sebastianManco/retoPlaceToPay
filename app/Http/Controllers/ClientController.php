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
    }

    /**
     * @param string $search
     * @param string $type
     * @param string $query
     * @param Product $products
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request):\Illuminate\View\View
    { 
        $search= $request->get('search');
        $type = $request->get('type');
        switch($type){
            case 'name':
                $products = Product::with(
                    ['image'=> function($query){
                            $query->select('id','name','product_id');
                        },
                        'category'=>function($query){
                            $query->select('id','name');
                        }
                    ])
                    ->name($search)
                    ->paginate(3, ['id','name']);
            break;
            default:
            $products = Product::with(
                ['image'=> function($query){
                        $query->select('id','name','product_id');
                    },
                    'category'=>function($query){
                        $query->select('id','name');
                    }
                ])
                ->category($search)
                ->paginate(3, ['id','name']);
            break;
        }
        return view('clients.index', compact('products'));
    } 
}
