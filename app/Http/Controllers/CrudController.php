<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Crud::orderBy('id','desc')->where('user_id', Auth::id());
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('long_description', 'like', "%{$search}%");
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'image' => 'nullable|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $filename, 'public');

                if ($path) {
                    $data['image'] = Storage::url($path);
                }
            }
            $data['slug'] = Str::slug($data['title']);
            $data['user_id'] = Auth::id();
            $item = Crud::create($data);
            DB::commit();
            return response()->json(['success' => true, 'data' => $item], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $item = Crud::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $item = Crud::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found or unauthorized'], 404);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'image' => 'nullable|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $filename, 'public');
                if ($path) {
                    $data['image'] = Storage::url($path);
                }
            }
            if (isset($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }
            $item->update($data);
            DB::commit();
            return response()->json(['success' => true, 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $item = Crud::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found or unauthorized'], 404);
        }
        DB::beginTransaction();
        try {
            if ($item->image) {
                $this->deleteImage($item->image);
            }
            $item->delete();
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function deleteImage(string $imageUrl): void
    {
        if (empty($imageUrl)) return;
        $path = str_replace('/storage/', '', parse_url($imageUrl, PHP_URL_PATH));
        if (empty($path)) return;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

}
