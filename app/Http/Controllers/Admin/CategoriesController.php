<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::when($request->name, function($query, $value) {
                $query->where(function($query) use ($value) {
                    $query->where('name', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%");
                });
            })
            ->when($request->parent_id, function($query, $value) {
                $query->where('parent_id', '=', $value);
            })
            ->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->get();

        $names = [];
        $data = [];
        foreach ($categories as $category) {
            if (in_array($category->name, $names)) {
                continue;
            }
            $data[] = $category;
            $names[] = $category->name;
        }

        /*$query = Category::query();
        if ($request->name) {
            $query->where(function($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->name}%")
                    ->orWhere('description', 'LIKE', "%{$request->name}%");
            });
        }
        if ($request->parent_id) {
            $query->where('parent_id', '=', $request->parent_id);
        }
        $categories = $query->get();*/


        $parents = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', [
            'categories' => $categories,
            'parents' => $parents,
        ]);
    }

    public function create()
    {
        $parents = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.create', [
            'parents' => $parents,
            'title' => 'Add Category',
            'category' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name; // $request->get('name')
        $category->slug = Str::slug($request->name);
        $category->description = $request->input('description');
        $category->parent_id = $request->post('parent_id');
        $category->status = $request->post('status');
        $category->save();

        session()->put('status', 'Category added (from status!)');

        session()->flash('success', 'Category added!');
        return redirect( route('admin.categories.index') );
    }

    public function show($id)
    {
        return __METHOD__;
        
        return view('admin.categories.show', [
            'category' => Category::findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        //$category = Category::where('id', '=', $id)->first();
        $category = Category::findOrFail($id);

        $parents = Category::where('id', '<>', $id)
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.categories.edit', [
            'id' => $id,
            'category' => $category,
            'parents' => $parents,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            abort(404);
        }

        $category->name = $request->name; // $request->get('name')
        $category->slug = Str::slug($request->name);
        $category->description = $request->input('description');
        $category->parent_id = $request->post('parent_id');
        $category->status = $request->post('status');
        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated');
    }

    public function destroy($id)
    {
        // Method 1
        //$category = Category::find($id);
        //$category->delete();

        // Method 2
        //Category::where('id', '=', $id)->delete();

        // Method 3
        Category::destroy($id);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted');

    }
}
