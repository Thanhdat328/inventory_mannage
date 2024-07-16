<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

  

    public function index()
    {
        $product = Product::where('user_id', Auth::user()->id)->latest()->get();
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
            'category' => 'required'

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
        try{
          $category = Category::all();
          $request_user = Auth::user();
          $product = Product::find($id);
          if ($request_user->role_as == 'admin' || $request_user->id == $product->user_id) {
            return view('product.edit', ['category' => $category, 'product' => $product]);
          } else {
            return redirect()->route('home')->with('status', 'Unauthorized access.');
          }
        } catch (Exception $e) {
          return redirect()->route('home')->with('status', $e->getMessage());
          //return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required|max:255',
        'quantity'=>'required|numeric',

      ]);
      
      $products = Product::find($id);
      $products->category_id=$request->input('category');
      $products->user_id = $request->input('user_id');
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
