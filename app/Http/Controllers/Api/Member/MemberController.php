<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::where('user_id', $request->user()->id)
                ->where('account_book_id', $request->account_book_id)->get();
                
        return response()->json([
                'message' => 'Members retrieved successfully',
                'data' => $members
            ],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_book_id' => 'required|exists:account_books,id',
        ]);

        $member = Member::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'account_book_id' => $request->account_book_id,
        ]);

        return response()->json([
            'message' => 'Member created successfully',
        ], 201);
    }
}
