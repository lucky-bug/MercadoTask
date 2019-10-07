<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['index', 'search', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        return response()->json(Product::where('name', 'like', "%{$request->get('q')}%")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());
        $product->user()->associate(Auth::user());
        $product->save();

        return redirect(route('products.show', $product->id));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     *
     * @return Response
     */
    public function show(Product $product)
    {
        return view('products.show', ['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product  $product
     *
     * @return Response
     */
    public function edit(Product $product)
    {
        if ($product->user_id !== null && $product->user_id !== Auth::id()) {
            abort('403');
        }

        return view('products.edit', ['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Product  $product
     *
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== null && $product->user_id !== Auth::id()) {
            abort('403');
        }

        $product->fill($request->all());
        $product->user()->associate(Auth::user());
        $product->save();

        return redirect(route('products.show', $product->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        if ($product->user_id !== null && $product->user_id !== Auth::id()) {
            abort('403');
        }

        $product->delete();

        return redirect(route('products.index'));
    }
}
