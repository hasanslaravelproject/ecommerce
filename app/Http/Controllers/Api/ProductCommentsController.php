<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;

class ProductCommentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $comments = $product
            ->comments()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $comment = $product->comments()->create($validated);

        return new CommentResource($comment);
    }
}
