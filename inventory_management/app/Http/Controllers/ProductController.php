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
        $products = Product::where('user_id', Auth::user()->id)->where('damaged' , 'N')->latest()->paginate(5);
        $category = Category::all();

        $product_damageds = Product::where('user_id', Auth::user()->id)->where('damaged' , 'Y')->latest()->paginate(5);

        return view('product.index', ['products' => $products, 'category' => $category, 'product_damageds' => $product_damageds]);
    }

    //add product
    public function create()
    {
         $category = Category::all();
         return view('product.add',['category' => $category]);

    }
    public function store(Request $request)
    {
      try {
        $request->validate([
            'name' => 'required|max:255',
            'quantity' => 'required|numeric',
            'category' => 'required'
        ]);

        $product = new Product();
        $product->category_id = $request->input('category');
        $product->user_id = Auth::user()->id;
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->save();

        return redirect()->route('product')->with('success', 'Product created successfully');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'There was an error adding the product: ' . $e->getMessage()]);
    }

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
        'quantity' => 'required|numeric',
        'category' => 'required|exists:categories,id',
    ]);
    
    $product = Product::find($id);
    
   
    if ($product->name == $request->name && $product->quantity == $request->quantity && $product->category_id == $request->category) {
        return redirect()->back()->withErrors(['error' => 'No changes made to the product.']);
    }


    $product->category_id = $request->input('category');
    $product->user_id = $request->input('user_id');
    $product->name = $request->name;
    $product->quantity = $request->quantity;
    

    $product->status = $product->quantity > 0 ? 'Y' : 'N';
    
    $product->save();

    return redirect()->route('product')->with('success', 'Product updated successfully.');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product')
          ->with('success', 'Post deleted successfully');
    }
}
