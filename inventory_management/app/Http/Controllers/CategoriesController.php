<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{


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
          return redirect()->route('category');

    }
    public function index()
    {
        //$category = DB::table('category')->paginate(2);
      $category = Category::paginate(2);
      return view('category.index', compact('category'));

    }
////////////////////////////////////////////////////////////// update category
    public function edit($id)
    {
      $category = Category::find($id);
      return view('category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required|max:255',

      ]);
      $category = Category::find($id);
      $category->update($request->all());
      return redirect()->route('category')
        ->with('success', 'Post updated successfully.');
    }

    // delete a category
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category')
          ->with('success', 'Post deleted successfully');
    }
    // view category
    public function show($id)
    {
      $category = Category::find($id);
      return view('category.show', compact('category'));
    }


}
