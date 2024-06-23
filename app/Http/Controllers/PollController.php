<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Http\Resources\PollResource;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class PollController extends Controller
{
    public function index()
    {
        $poll = Poll::orderBy('created_at' , 'desc')->get();
        return PollResource::collection($poll);
    }

    public function store(StorePollRequest $request)
    {
        try {
            $poll = Poll::create($request->only(['title']));
            return PollResource::make($poll);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdatePollRequest $request , $pollID){
        try {
            $poll = Poll::where('id' , $pollID)->first();
            if (!$poll) {
                return response()->json([
                    'message' => 'poll not found in the system',
                ], 404);
            }
            $poll->update($request->only(['title']));
            return PollResource::make($poll);
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

    public function delete($pollID)
    {
        try {
            $poll = Poll::where('id' , $pollID)->first();
            if (!$poll) {
                return response()->json([
                    'message' => 'poll not found in the system',
                ], 404);
            }
            $poll->delete();
            return PollResource::make($poll);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
