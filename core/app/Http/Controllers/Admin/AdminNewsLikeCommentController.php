<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use app\Http\Middleware\general_user;
use App\Models\AdminNewsComment;
use App\Models\AdminNewsLike;

class AdminNewsLikeCommentController extends Controller
{

    // ---------------------------News details Like----------------------
    public function newsLike(Request $request)
    {
        if (!Auth::guard('general')->user()) {
            return response()->json([
                'message' => 'You are not Authorize',
                'data' => null,
                'status' => 0,
            ]);
        };
        $totalLike = AdminNewsLike::where('news_id',$request->news_id)->where('like','=','true')->count();
        if($totalLike > 0){
            return response()->json([
                'message' => 'You are already like in news',
                'data' => null,
                'status' => 0,
            ]);
        }
        try {
            $newsDetails = new AdminNewsLike();
            $newsDetails->news_id = $request->news_id;
            $newsDetails->user_id = Auth::guard('general')->user()->id;
            $newsDetails->like = $request->like;
            $newsDetails->save();
            $newsDetails->load('user');
            $totalLike = AdminNewsLike::where('news_id',$request->news_id)->where('like','=','true')->count();
            return response()->json([
                'success' => 'Data create successfully',
                'data' => $totalLike,
                'status' => 1,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errorMessage' => $newsDetails->errors()->all(),
                'data' => $newsDetails
            ]);
            // dd($e->getMessage());
        }
    }

    // ---------------------------News details comment----------------------
    public function newsComment(Request $request)
    {
        if (!Auth::guard('general')->user()) {
            return response()->json([
                'message' => 'You are not Authorize',
                'data' => null,
                'status' => 0,
            ]);
        };
        try {
            $newsDetails = new AdminNewsComment();
            $newsDetails->news_id = $request->news_id;
            $newsDetails->user_id = Auth::guard('general')->user()->id;
            $newsDetails->comment = $request->comment;
            $newsDetails->save();
            $newsDetails->load('user');
            return response()->json([
                'success' => 'Data create successfully',
                'data' => $newsDetails,
                'status' => 1,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errorMessage' => $newsDetails->errors()->all(),
                'data' => $newsDetails
            ]);
            // dd($e->getMessage());
        }
    }

    
}
