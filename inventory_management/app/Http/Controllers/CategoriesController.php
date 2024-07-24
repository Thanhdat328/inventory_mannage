<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
  protected function authenticated()
  {
    if(Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'staff')
    {
      return redirect()->route('category.index');
    }
  }

  // add categories
  public function create()
  {
    return view('category.add');
  }

  //
  public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|max:255|min:3',
        ]);

        Category::create(['name' => $request->name]);
        return redirect()->route('category')->with('success', 'Category has been created');
    } catch (Exception $e) {
        return redirect()->route('category')->with('error', $e->getMessage());
    }
}

  public function index()
  {
    if(Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'staff')
    {
      $categories = Category::paginate(5);
      return view('category.index', compact('categories'));
    }else {
      return redirect()->route('home')->with('status', 'You are not allowed to view this page');
    }
    //$category = DB::table('category')->paginate(2);
   
  }

  ////////////////////////////////////////////////////////////// update category
  public function edit($id)
{
    try {
        $category = Category::find($id);
        
        if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'staff') {
            return view('category.edit', compact('category'));
        } else {
            return redirect()->route('home')->with('error', 'You are not allowed to edit this category');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error: '.$e->getMessage());
    }
}


  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|min:3|max:255',
    ]);
    $category = Category::find($id);
    if($category->name == $request->name){
      return redirect()->back()->with('error', 'No changes made to the category');
    }
    $category->update($request->all());
    return redirect()->route('category')->with('success', 'Post updated successfully.');
  }

  // delete a category
  public function destroy($id)
  { 
    try{
      $category = Category::find($id);
      if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'staff') {
        $category->delete();
        return redirect()->route('category')->with('success', 'Category deleted successfully');
      } else {
        return redirect()->route('home')->with('status', 'You are not allowed to delete this category');  
      }
    } catch (\Exception $e) {
      return redirect()->back()->with('status', 'error: '.$e->getMessage());
    }
  }

  // view category
  public function show($id)
  {
    $category = Category::find($id);
    return view('category.show', compact('category'));
  }
}