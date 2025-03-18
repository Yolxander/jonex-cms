<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Get all products with their category and formats.
     */
    public function index(): JsonResponse
    {
        $products = Product::with(['translations','category', 'formats'])->where('live', 1)->get();

        return response()->json([
            'status' => 'success',
            'data' => $products,
        ]);
    }
}
