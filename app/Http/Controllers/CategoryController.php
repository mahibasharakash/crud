<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $query = Category::orderBy('id','desc')->where('user_id', Auth::id());
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'data' => $items->items(),
            'pagination' => [
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
                'last_page' => $items->lastPage(),
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $item = Category::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);
        return response()->json(['message' => 'Item created successfully', 'data' => $item], 201);
    }

    public function show($id): JsonResponse
    {
        $item = Category::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json(['data' => $item]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $item = Category::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['message' => 'Not found or unauthorized'], 404);
        }
        $updateData = $request->only(['title']);
        $item->update($updateData);
        return response()->json(['message' => 'Item updated successfully', 'data' => $item]);
    }

    public function destroy($id): JsonResponse
    {
        $item = Category::where('id', $id)->where('user_id', Auth::id())->first();
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }

}
