<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminLiveTvComment;
use App\Http\Controllers\Controller;
use App\Models\AdminLiveTvLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminLiveTvLikeCommentController extends Controller
{
    // ---------------------------Live Tv details Like----------------------
    public function liveTvLike(Request $request)
    {
        // Auth check
        if (!Auth::guard('general')->user()) {
            return response()->json([
                'message' => 'You are not Authorize',
                'data' => null,
                'status' => 0,
            ]);
        };

        // Already like check
        $LikeCheck = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('like', '=', 'true')->count();
        if ($LikeCheck > 0) {
            return response()->json([
                'message' => 'You are already liked',
                'data' => null,
                'status' => 0,
            ]);
        }

        // Already Dislike check
        $findDislike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('dislike','true')->first();

        // if Dislike check then count
        $findDislikeCount = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('dislike','true')->count();
        try {
            if ($findDislikeCount > 0 ) {
                $liveTvDetails = AdminLiveTvLike::where('id',$findDislike->id)->first();
                $liveTvDetails->live_tv_id = $request->live_tv_id;
                $liveTvDetails->user_id = Auth::guard('general')->user()->id;
                $liveTvDetails->like = $request->like;
                $liveTvDetails->dislike = null;
                $liveTvDetails->update();
                $liveTvDetails->load('user');
                $totalLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('like', '=', 'true')->count();
                $totalDisLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('dislike', '=', 'true')->count();
                return response()->json([
                    'success' => 'Data create successfully',
                    'data' => [$totalLike,$totalDisLike],
                    'status' => 1,
                ]);
            }
            else {
                $liveTvDetails = new AdminLiveTvLike();
                $liveTvDetails->live_tv_id = $request->live_tv_id;
                $liveTvDetails->user_id = Auth::guard('general')->user()->id;
                $liveTvDetails->like = $request->like;
                $liveTvDetails->save();
                $liveTvDetails->load('user');
                $totalLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('like', '=', 'true')->count();
                return response()->json([
                    'success' => 'Data create successfully',
                    'data' => $totalLike,
                    'status' => 1,
                ]);
            }
        } catch (QueryException $e) {
            $liveTvDetails = new AdminLiveTvLike();
            return response()->json([
                'errorMessage' => $liveTvDetails->errors()->all(),
                'data' => $liveTvDetails
            ]);
            // dd($e->getMessage());
        }
    }


    public function liveTvDisLike(Request $request)
    {
        // Auth check
        if (!Auth::guard('general')->user()) {
            return response()->json([
                'message' => 'You are not Authorize',
                'data' => null,
                'status' => 0,
            ]);
        };

        // Already Dislike check
        $totalDisLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('dislike', '=', 'true')->count();
        if ($totalDisLike > 0) {
            return response()->json([
                'message' => 'You are already Disliked',
                'data' => null,
                'status' => 0,
            ]);
        }

        // Already like check
        $findLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('like','true')->first();

        // if like check then count
        $findLikeCount = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('like','true')->count();
        try {
            if ($findLikeCount > 0 ) {
                $liveTvDetails = AdminLiveTvLike::where('id',$findLike->id)->first();
                $liveTvDetails->live_tv_id = $request->live_tv_id;
                $liveTvDetails->user_id = Auth::guard('general')->user()->id;
                $liveTvDetails->like = null;
                $liveTvDetails->dislike = $request->like;
                $liveTvDetails->update();
                $liveTvDetails->load('user');
                $totalLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('like', '=', 'true')->count();
                $totalDisLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('dislike', '=', 'true')->count();
                return response()->json([
                    'success' => 'Data create successfully',
                    'data' => [$totalLike,$totalDisLike],
                    'status' => 1,
                ]);
            }
            else {
                $liveTvDetails = new AdminLiveTvLike();
                $liveTvDetails->live_tv_id = $request->live_tv_id;
                $liveTvDetails->user_id = Auth::guard('general')->user()->id;
                $liveTvDetails->dislike = $request->like;
                $liveTvDetails->save();
                $liveTvDetails->load('user');
                $totalDisLike = AdminLiveTvLike::where('live_tv_id', $request->live_tv_id)->where('like', '=', 'true')->count();
                return response()->json([
                    'success' => 'Data create successfully',
                    'data' => $totalDisLike,
                    'status' => 1,
                ]);
            }
        } catch (QueryException $e) {
            $liveTvDetails = new AdminLiveTvLike();
            return response()->json([
                'errorMessage' => $liveTvDetails->errors()->all(),
                'data' => $liveTvDetails
            ]);
            // dd($e->getMessage());
        }
    }





    // ---------------------------Live Tv details comment----------------------
    public function liveTvComment(Request $request)
    {
        if (!Auth::guard('general')->user()) {
            return response()->json([
                'message' => 'You are not Authorize',
                'data' => null,
                'status' => 0,
            ]);
        };
        try {
            $liveTvDetails = new AdminLiveTvComment();
            $liveTvDetails->live_tv_id = $request->live_tv_id;
            $liveTvDetails->user_id = Auth::guard('general')->user()->id;
            $liveTvDetails->comment = $request->comment;
            $liveTvDetails->save();
            $liveTvDetails->load('user');
            return response()->json([
                'success' => 'Data create successfully',
                'data' => $liveTvDetails,
                'status' => 1,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errorMessage' => $liveTvDetails->errors()->all(),
                'data' => $liveTvDetails
            ]);
            // dd($e->getMessage());
        }
    }
}
