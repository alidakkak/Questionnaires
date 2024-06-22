<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $Option = Option::all();

        return OptionResource::collection($Option);
    }

    public function store(StoreOptionRequest $request)
    {
        try {
            $Option = Option::create($request->all());

            return response()->json([
                'message' => 'Created SuccessFully',
                'data' => OptionResource::make($Option),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($Id)
    {
        $Option = Option::find($Id);
        if (! $Option) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return OptionResource::make($Option);
    }

    public function delete($Id)
    {
        try {
            $Option = Option::find($Id);
            if (! $Option) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $Option->delete();

            return response()->json([
                'message' => 'Deleted SuccessFully',
                'data' => OptionResource::make($Option),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
