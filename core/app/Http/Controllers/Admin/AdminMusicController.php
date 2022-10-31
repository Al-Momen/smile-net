<?php

namespace App\Http\Controllers\Admin;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminMusicController extends Controller
{
    public function index()
    {
        $allMusic = Music::paginate(10);
        return view('admin.music.music', compact('allMusic'));
    }
    public function storeMusic(Request $request)
    {
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'artist' => 'required',
            'singer_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'mp3' => 'required',
            'date' => 'required',
        ]);
        try {
            $music = new Music();
            $music->user_id = Auth::user()->id;
            $music->title = $request->title;
            $music->artist = $request->artist;
            $music->singer_name = $request->singer_name;
            $music->date = $request->date;
            $music->status = $request->status;
            $music->image = Generals::upload('music/photo/', 'png', $request->image);
            $music->mp3 = Generals::fileUpload('music/', $request->mp3);
            $music->save();
            $notify[] = ['success', 'Music create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editMusic($id)
    {
         $music = Music::where('id', $id)->first();
        return view('admin.music.edit_music', compact('music'));
    }

    public function editStatusMusic(Request $request, $id)
    {
        $music = Music::where('id', $id)->first();
        if ($request->status == 'on') {
            $music->status = 1;
            $music->update();
            $notify[] = ['success', 'Music is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $music->status = 0;
            $music->update();
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'mp3' => 'required',
            'date' => 'required',
        ]);
        try {
            $music = Music::where('id', $id)->first();
            $oldImage = $music->song_image;
            $oldFile = $music->song_file;
            $music->user_id = Auth::user()->id;
            $music->title = $request->title;
            $music->artist = $request->artist;
            $music->singer_name = $request->singer_name;
            $music->date = $request->date;
            $music->status = $request->status;
            $music->image = Generals::update('music/photo/', $oldImage, 'png', $request->image);
            $music->mp3 = Generals::FileUpdate('music/', $oldFile, $request->mp3);
            $music->update();
            $notify[] = ['success', 'Music update Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $music = Music::find($id);
        Generals::unlink("music/photo/", $music->song_image);
        Generals::fileUnlink("music/", $music->song_file);
        $music->delete();
        $notify[] = ['success', 'Music delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
