<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $query = Crud::orderBy('id','desc')->where('user_id', Auth::id());
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('long_description', 'like', "%{$search}%")
                ;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            Storage::disk('public')->put($filename, file_get_contents($file));
            $imagePath = $filename;
        }

        $item = Crud::create([
            'image' => $imagePath,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Item created successfully', 'data' => $item], 201);
    }

    public function show($id): JsonResponse
    {
        $item = Crud::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json(['data' => $item]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);
        $item = Crud::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['message' => 'Not found or unauthorized'], 404);
        }
        $updateData = $request->only(['title', 'short_description', 'long_description']);
        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            Storage::disk('public')->put($filename, file_get_contents($file));
            $updateData['image'] = $filename;
        }
        $updateData['slug'] = Str::slug($request->title);
        $item->update($updateData);
        return response()->json(['message' => 'Item updated successfully', 'data' => $item]);
    }

    public function destroy($id): JsonResponse
    {
        $item = Crud::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['message' => 'Not found or unauthorized'], 404);
        }
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }

}
