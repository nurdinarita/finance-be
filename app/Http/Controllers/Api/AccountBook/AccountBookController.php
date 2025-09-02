<?php

namespace App\Http\Controllers\Api\AccountBook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccountBook;

class AccountBookController extends Controller
{
    public function index() {
        $accountBooks = AccountBook::where('user_id', auth()->user()->id)->get();

        return response()->json([
            'message' => 'Account Books retrieved successfully',
            'data' => $accountBooks
        ], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'is_default' => 'boolean',
        ]);

        $user = auth()->user();
        // cek apakah user sudah punya buku
        // $alreadyHasBook = $user->accountBooks()->exists();

        $accountBook = AccountBook::create([
            'user_id' => auth()->user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            // 'is_default' => !$alreadyHasBook, // jika belum punya buku, set sebagai default
        ]);

        return response()->json([
            'message' => 'Account Book created successfully',
        ], 201);
    }
}
