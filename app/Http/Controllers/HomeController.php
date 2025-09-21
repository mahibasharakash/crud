<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Crud;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $query = Crud::with(['getInformation','getCategory']);
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('long_description', 'like', "%{$search}%");
            });
        }
        if ($request->has('time') && !empty($request->time)) {
            switch ($request->time) {
                case 'today':
                    $query->whereDate('created_at', now());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('getCategory', function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->category}%");
            });
        }
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $data = $items->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'short_description' => $item->short_description,
                'long_description' => $item->long_description,
                'slug' => $item->slug,
                'image' => $item->image,
                'human_created_at' => $item->human_created_at,
                'views' => $item->views,
                'user' => $item->getInformation ? [
                    'id' => $item->getInformation->id,
                    'name' => $item->getInformation->name,
                    'email' => $item->getInformation->email,
                    'image' => $item->getInformation->image,
                ] : null,
                'category' => $item->getCategory ? [
                    'id' => $item->getCategory->id,
                    'title' => $item->getCategory->title,
                ] : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });
        return response()->json([
            'data' => $data,
            'pagination' => [
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
                'last_page' => $items->lastPage(),
            ]
        ]);
    }

    public function show($slug): JsonResponse
    {
        $item = Crud::with(['getInformation','getCategory'])->where('slug', $slug)->first();
        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $item->increment('views');
        return response()->json(['data' => $item]);
    }

    public function allCategory(Request $request): JsonResponse
    {
        $items = Category::select('id', 'title')->whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')->from('categories')->groupBy('title');
        })->orderBy('id', 'asc')->get();
        return response()->json( [ 'data' => $items ] );
    }

}
