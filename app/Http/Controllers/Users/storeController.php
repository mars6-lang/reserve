<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use App\Models\productList;
use App\Models\Users\productcategory;
use App\Models\Users\products;
use Illuminate\Http\Request;
use Auth;


class storeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storedetails = productList::Where('sellerid',Auth::user()->id);

        $prodcat = productList::Where('sellerid',Auth::user()->id);

        $allprod = products::where('sellerid',Auth::user()->id->get);

        return view('users.viewProds.index')->with('prodcat',$prodcat)->with('storedetails',$storedetails);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
