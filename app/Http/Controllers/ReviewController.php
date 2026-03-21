<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $product_id)
    {

        $request->validate([
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        return back()->with('success','Review added!');
    }

    public function delete($review_id)
    {
        $review = Review::findOrFail($review_id);
        $product_id = $review->product_id;
        $review->delete();

        return redirect()->route('products.show', $product_id)->with('success', 'Review deleted.');
    }
}