<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('user_id', auth()->user()->id)
                        ->where('account_book_id', $request->account_book_id)->get();

        return response()->json([
            'message' => 'List of categories',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'account_book_id' => 'required|exists:account_books,id',
        ]);
        
        $category = Category::create([
            'user_id' => $request->user()->id,
            'account_book_id' => $validated['account_book_id'],
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        if (!$category) {
            return response()->json([
                'message' => 'Failed to create category'
            ], 500);
        }

        return response()->json([
            'message' => 'Category created'
        ], 201);
    }
}
