<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminLiveTvLike;
use App\Models\AdminSmileTvLike;
use App\Models\AdminSmileTvComment;
use App\Http\Controllers\Controller;
use App\Models\AdminSmileTv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminSmileTvLikeCommentController extends Controller
{
    // -----------------Smile Tv details page------------------
    public function smileTvdetails($id)
    {
        $smileTvDetails = AdminSmileTv::findOrFail($id);
        $smileTvComments = AdminSmileTvComment::with('user')->where('smile_tv_id', $id)->get();
        $totalLike = AdminSmileTvLike::with('user')->where('smile_tv_id', $id)->where('like', '=', 'true')->count();
        $totalDisLike = AdminSmileTvLike::with('user')->where('smile_tv_id', $id)->where('dislike', '=', 'true')->count();
        return view('frontend.pages.smile-tv-details', compact('smileTvDetails', 'smileTvComments', 'totalLike', 'totalDisLike'));
    }

    // ---------------------------Smile Tv details Like----------------------
    public function smileTvLike(Request $request)
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
        $LikeCheck = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('like', '=', 'true')->count();
        if ($LikeCheck > 0) {
            return response()->json([
                'message' => 'You are already liked',
                'data' => null,
                'status' => 0,
            ]);
        }

        // Already Dislike check
        $findDislike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('dislike', 'true')->first();

        // if Dislike check then count
        $findDislikeCount = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('dislike', 'true')->count();
        try {
            if ($findDislikeCount > 0) {
                $smileTvDetails = AdminSmileTvLike::where('id', $findDislike->id)->first();
                $smileTvDetails->smile_tv_id = $request->smile_tv_id;
                $smileTvDetails->user_id = Auth::guard('general')->user()->id;
                $smileTvDetails->like = $request->like;
                $smileTvDetails->dislike = null;
                $smileTvDetails->update();
                $smileTvDetails->load('user');
                $totalLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('like', '=', 'true')->count();
                $totalDisLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('dislike', '=', 'true')->count();
                return response()->json([
                    'message' => 'Data create successfully',
                    'data' => [
                        'totalLike' => $totalLike,
                        'totalDisLike'=> $totalDisLike
                    ],
                    'status' => 1,
                ]);
            } else {
                $smileTvDetails = new AdminSmileTvLike();
                $smileTvDetails->smile_tv_id = $request->smile_tv_id;
                $smileTvDetails->user_id = Auth::guard('general')->user()->id;
                $smileTvDetails->like = $request->like;
                $smileTvDetails->save();
                $smileTvDetails->load('user');
                $totalLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('like', '=', 'true')->count();
                return response()->json([
                    'message' => 'Data create successfully',
                    'data' => [
                        'totalLike' => $totalLike,
                    ],
                    'status' => 1,
                ]);
            }
        } catch (QueryException $e) {
            $smileTvDetails = new AdminLiveTvLike();
            return response()->json([
                'message' => $e->getMessage(),
                'data' => $smileTvDetails
            ]);
            // dd($e->getMessage());
        }
    }


    public function smileTvDisLike(Request $request)
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
        $totalDisLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('dislike', '=', 'true')->count();
        if ($totalDisLike > 0) {
            return response()->json([
                'message' => 'You are already Disliked',
                'data' => null,
                'status' => 0,
            ]);
        }

        // Already like check
        $findLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('like', 'true')->first();

        // if like check then count
        $findLikeCount = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('user_id', Auth::guard('general')->user()->id)->where('like', 'true')->count();
        try {
            if ($findLikeCount > 0) {
                $smileTvDetails = AdminSmileTvLike::where('id', $findLike->id)->first();
                $smileTvDetails->smile_tv_id = $request->smile_tv_id;
                $smileTvDetails->user_id = Auth::guard('general')->user()->id;
                $smileTvDetails->like = null;
                $smileTvDetails->dislike = $request->like;
                $smileTvDetails->update();
                $smileTvDetails->load('user');
                $totalLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('like', '=', 'true')->count();
                $totalDisLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('dislike', '=', 'true')->count();
                return response()->json([
                    'message' => 'Data create successfully',
                    'data' => [
                        'totalLike' => $totalLike,
                        'totalDisLike'=> $totalDisLike
                    ],
                    'status' => 1,
                ]);
            } else {
                $smileTvDetails = new AdminSmileTvLike();
                $smileTvDetails->smile_tv_id = $request->smile_tv_id;
                $smileTvDetails->user_id = Auth::guard('general')->user()->id;
                $smileTvDetails->dislike = $request->like;
                $smileTvDetails->save();
                $smileTvDetails->load('user');
                $totalDisLike = AdminSmileTvLike::where('smile_tv_id', $request->smile_tv_id)->where('like', '=', 'true')->count();
                return response()->json([
                    'message' => 'Data create successfully',
                    'data' => ['totalDisLike'=> $totalDisLike],
                    'status' => 1,
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => null
            ]);
            // dd($e->getMessage());
        }
    }



    // ---------------------------Smile Tv details comment----------------------
    public function smileTvComment(Request $request)
    {
        if (!Auth::guard('general')->user()) {
            return response()->json([
                'message' => 'You are not Authorize',
                'data' => null,
                'status' => 0,
            ]);
        };
        try {
            $smileTvDetails = new AdminSmileTvComment();
            $smileTvDetails->smile_tv_id = $request->smile_tv_id;
            $smileTvDetails->user_id = Auth::guard('general')->user()->id;
            $smileTvDetails->comment = $request->comment;
            $smileTvDetails->save();
            $smileTvDetails->load('user');
            return response()->json([
                'success' => 'Data create successfully',
                'data' => $smileTvDetails,
                'status' => 1,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errorMessage' => $smileTvDetails->errors()->all(),
                'data' => $smileTvDetails
            ]);
            // dd($e->getMessage());
        }
    }
}
