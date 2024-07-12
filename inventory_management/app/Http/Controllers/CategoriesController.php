<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
  protected function authenticated()
  {
    if(Auth::user()->role_as == 'admin')
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
    $request->validate([
      'name' => 'required|max:255',
    ]);
    Category::create($request->all());
    return redirect()->route('category')->with('success', 'category has been created');
  }

  public function index()
  {
    //$category = DB::table('category')->paginate(2);
    $categories = Category::paginate(5);
    return view('category.index', compact('categories'));
  }

  ////////////////////////////////////////////////////////////// update category
  public function edit($id)
  {
    try{
      $category = Category::find($id);
      if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'staff') {
        return view('category.edit', compact('category'));
      } else {
        return redirect()->route('home')->with('You are not allowed to edit this category');
      }
    } catch (\Exception $e) {
      return redirect()->route('home')->with('status', 'error: '.$e->getMessage());
    }
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|max:255',
    ]);
    $category = Category::find($id);
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
        return redirect()->route('category')->with('success', 'Post deleted successfully');
      } else {
        return redirect()->route('home')->with('status', 'You are not allowed to delete this category');  
      }
    } catch (\Exception $e) {
      return redirect()->route('home')->with('status', 'error: '.$e->getMessage());
    }
  }

  // view category
  public function show($id)
  {
    $category = Category::find($id);
    return view('category.show', compact('category'));
  }
}