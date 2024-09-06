<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Request;

class CategoryApi extends Controller
{
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        if ($request->validated()) {
            return response()->json([
                "status" => "success",
                "message" => "Category has been created"
            ]);
        }
        return response()->json([
            "status" => "success",
            "message" => "Category has been created"
        ]);
    }
}
