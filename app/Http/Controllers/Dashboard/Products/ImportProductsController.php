<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class ImportProductsController extends Controller
{

    public function create()
    {
        return view('dashboard.Products.import');
    }

    public function store(Request $request)
    {
        $jobs = new ImportProducts($request->post('count'));

        $jobs->onQueue('import');

        dispatch($jobs);

        return redirect()->route('dashboard.products.index')->with('success', 'Products imported is in progress...');
    }

}
