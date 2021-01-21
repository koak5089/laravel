<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductContrlloer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::latest()->paginate(5);
  
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product=Product::insert([
            'name' => $request->name,
            'detail' => $request->detail
        ]);
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);

        // Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success','Product created successfully.');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        //
        // dd($id);
        $product=$product::where('id',$id)->first();//where('id'컬럼명,'>'비교식,$id 벨류값)  where('id'컬럼명,$id 벨류값)  first 1개만 가져온다 여러개 get
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd($id);
        $product=Product::where('id',$id)->first();
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //*******request는 eidt에서 받아온거고 product는 데이터 베이스이다
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
                
         $product->where('id',$request->id)->update([
             'name'=>$request->name,
             'detail'=>$request->detail
             ]);
        // $product=$product::where('id',$request->id)->update([
        //     'name' => $request->name,
        //     'detail' => $request->detail
        // ]);
        // $affected = DB::table('users')
        //       ->where('id', 1)
        //       ->update(['votes' => 1]);


        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        //
        // dd($product->all());
        $product=$product::where('id',$id)->delete();
        //$product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
