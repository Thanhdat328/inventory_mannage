<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        
        $product = Product::all();
        $category = Category::all();

        return view('product.index', compact('product'),compact('category'));
    }

    //add product
    public function create()
    {
         $category = Category::all();
         return view('product.add',['category' => $category]);

    }
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255',
            'quantity'=>'required|numeric',


          ]);
          $products = new Product();
          $products->category_id=$request->input('category');
          $products->user_id = Auth::user()->id;
          $products->name = $request->name;
          $products->quantity = $request->quantity;
          $products->save();

          return redirect()->route('product')->with('success', 'Thêm sản phẩm thành công');

    }
    //edit product

    public function edit($id)
    {

        $product = Product::find($id);

        $category = Category::all();

      return view('product.edit', ['category' => $category, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required|max:255',
        'quantity'=>'required|numeric',

      ]);

      $products = Product::find($id);
      $products->category_id=$request->input('category');
      $products->user_id = Auth::user()->id;
      $products->name = $request->name;
      $products->quantity = $request->quantity;
      if( $products->quantity>0){
        $products->status = 'Y';
      }
      else{
        $products->status = 'N';
      }
      $products->save();

      return redirect()->route('product')->with('success', 'Thêm sản phẩm thành công');

    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product')
          ->with('success', 'Post deleted successfully');
    }
}
