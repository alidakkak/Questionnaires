<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePollRequest;
use App\Http\Resources\PollResource;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $poll = Poll::all();

        return PollResource::collection($poll);
    }

    public function questionWithAnswer()
    {
        $poll = Poll::all();

        return PollResource::collection($poll);
    }

    public function store(StorePollRequest $request)
    {
        try {
            $poll = Poll::create($request->all());

            return response()->json([
                'message' => 'Created SuccessFully',
                'data' => PollResource::make($poll),
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
        $poll = Poll::find($Id);
        if (! $poll) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return PollResource::make($poll);
    }

    public function delete($Id)
    {
        try {
            $poll = Poll::find($Id);
            if (! $poll) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $poll->delete();

            return response()->json([
                'message' => 'Deleted SuccessFully',
                'data' => PollResource::make($poll),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
