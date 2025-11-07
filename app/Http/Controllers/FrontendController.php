<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    // Show all items (from categories table)
    public function index()
    {
        $items = Category::orderBy('created_at', 'desc')->get();
        return view('frontend.items', compact('items'));
    }

    // Search items by name (from categories table)
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            $items = Category::orderBy('created_at', 'desc')->get();
        } else {
            $items = Category::where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_kh', 'like', '%' . $query . '%')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('frontend.items', compact('items'));
    }
}
