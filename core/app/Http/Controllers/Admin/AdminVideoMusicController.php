<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminVideoMusic;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminVideoMusicController extends Controller
{
    public function index()
    {
         $allVideoMusic = AdminVideoMusic::paginate(10);
        
        return view('admin.video-music.music', compact('allVideoMusic'));
    }
    public function storeMusic(Request $request)
    {
            
        $request->validate([
            'title' => 'required|min:2|max:255',
            'artist' => 'required',
            'singer_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'mp4' => 'required',
        ]);
        try {
            $videoMusic = new AdminVideoMusic();
            $videoMusic->user_id = Auth::user()->id;
            $videoMusic->title = $request->title;
            $videoMusic->artist = $request->artist;
            $videoMusic->singer_name = $request->singer_name;
            $videoMusic->status = $request->status;
            $videoMusic->image = Generals::upload('music/photo/', 'png', $request->image);
            $videoMusic->mp4 = Generals::fileUpload('music/video/', $request->mp4);
            $videoMusic->save();
            $notify[] = ['success', 'Music create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editMusic($id)
    {
        $videoMusic = AdminVideoMusic::where('id', $id)->first();
        return view('admin.video-music.edit_music', compact('videoMusic'));
    }

    public function editStatusMusic(Request $request, $id)
    {
        $videoMusic = AdminVideoMusic::where('id', $id)->first();
        if ($request->status == 'on') {
            $videoMusic->status = 1;
            $videoMusic->update();
            $notify[] = ['success', 'Music is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $videoMusic->status = 0;
            $videoMusic->update();
            $notify[] = ['success', 'Music is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updateMusic(Request $request, $id)
    {
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'artist' => 'required',
            'singer_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            

        ]);
        try {
            $videoMusic = AdminVideoMusic::where('id', $id)->first();
            $oldImage = $videoMusic->image;
            $oldFile = $videoMusic->mp4;
            $videoMusic->user_id = Auth::user()->id;
            $videoMusic->title = $request->title;
            $videoMusic->artist = $request->artist;
            $videoMusic->singer_name = $request->singer_name;
            $videoMusic->image = Generals::update('music/photo/', $oldImage, 'png', $request->image);
            $videoMusic->mp4 = Generals::FileUpdate('music/video/', $oldFile, $request->mp4);
            $videoMusic->update();
            $notify[] = ['success', 'Music update Successfully'];
            return redirect()->route('admin.video.music.index')->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $videoMusic = AdminVideoMusic::find($id);
       
        Generals::unlink("music/photo/", $videoMusic->image);
        Generals::fileUnlink("music/video/", $videoMusic->mp4);
        $videoMusic->delete();
        $notify[] = ['success', 'Music delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
