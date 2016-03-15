<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Create resource action
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:article_categories',
            'alias'       => 'regex:/^[a-z0-9\-]+/',
            'image'       => 'string',
            'description' => 'string',
            'parent_id'   => 'numeric',
            'order'       => 'numeric',
            'status'      => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(arrayView('errors/validation', [
                'errors' => $validator->errors()
            ]), 400);
        }

        $category = Category::create($request->all());

        return response()->json(arrayView('category/read', [
            'category' => $category
        ]), 201);
    }
}
