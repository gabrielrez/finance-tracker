<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function store()
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Category::create(request()->all());
        $category->user_id = user()->id;
        $category->save();

        return redirect()->route('transactions.create');
    }
}
