<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Get all categories with their products.
     */
    public function index(): JsonResponse
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('live', 1);
        }])->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories,
        ]);
    }
}
