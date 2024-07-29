<?php

namespace App\Http\Controllers;

use App\Helpers\Collection\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function push(): JsonResponse
    {
        try {
            $collection = new Collection([1, 2, 3, 4]);
            $collection->push(5, 6, 7);
            return response()->json($collection->all(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function filter(): JsonResponse
    {
        try {
            $collection = new Collection([1, 2, 3, 4, 5, 6, 7]);
            $filter = $collection->filter(function ($item) {
                return $item > 3;
            })->values();
            return response()->json($filter, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function map(): JsonResponse
    {
        try {
            $collection = new Collection([1, 2, 3, 4, 5, 6, 7]);
            $map = $collection->map(function ($item) {
                return $item * 3;
            })->values();
            return response()->json($map, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function merge(): JsonResponse
    {
        try {
            $collection1 = new Collection([1, 2, 3, 4, 5, 6, 7]);
            $collection2 = new Collection([8, 9, 10, 11, 12, 13, 14]);
            $merge = $collection1->merge($collection2);
            return response()->json($merge->values(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function first(): JsonResponse
    {
        try {
            $collection = new Collection([1, 2, 3, 4, 5, 6, 7]);
            return response()->json($collection->first(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function each(): JsonResponse
    {
        try {
            $collection1 = new Collection([1, 2, 3, 4, 5, 6, 7]);
            $collection2 = new Collection();
            $collection1->each(function ($item) use ($collection2) {
                if ($item % 2 == 0) {
                    $collection2->push($item);
                }
            });
            return response()->json($collection2->all(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function foreach(): JsonResponse
    {
        try {
            $collection = new Collection([1, 2, 3, 4, 5, 6, 7]);
            foreach ($collection as $item) {
                $collection->push($item);
            }
            return response()->json($collection->all(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $collection = new Collection([1, 2, 3, 4, 5]);

            $collection->push(6, 7);

            $filtered = $collection->filter(function ($item) {
                return $item > 2;
            });

            $mapped = $filtered->map(function ($item) {
                return $item * 2;
            });

            $merged = $mapped->merge([16, 18, 20]);


            foreach ($merged as $item) {
                $collection->push($item);
            }

//            $merged->each(function ($item) use ($collection) {
//                $collection->push($item);
//            });

            return response()->json($collection->all(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
