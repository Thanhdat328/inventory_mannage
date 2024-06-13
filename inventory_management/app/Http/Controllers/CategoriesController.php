<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

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
      $category = Category::all();
      return view('category.index', compact('category'));
    }
////////////////////////////////////////////////////////////////
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
      $post->update($request->all());
      return redirect()->route('category.index')
        ->with('success', 'Post updated successfully.');
    }


}
