<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

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
            'name'        => 'required',
            'alias'       => 'regex:/^[a-z0-9\-]+/|unique:article_categories',
            'image'       => 'string',
            'description' => 'string',
            'parent_id'   => 'numeric',
            'order'       => 'numeric',
            'status'      => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $category = Category::create($request->all());

        return response()->json($category);
    }
}
