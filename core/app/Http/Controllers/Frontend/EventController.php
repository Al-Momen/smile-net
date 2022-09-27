<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Generals;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

class EventController extends Controller
{

    public function events()
    {
        $general_events = Event::where('user_id', Auth::guard('general')->id())->get();
        return view('frontend.deshboard.pages.event', compact('general_events'));
    }
    public function storeEvents(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'required',
        ]);
        try {
            $event = new Event();
            $event->user_id = Auth::guard('general')->user()->id;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->image = Generals::upload('events/', 'png', $request->image);
            $event->save();
            
            return redirect()->back()->with('success', "Events create Successfully");
            // return response()->json($event);
        } catch (QueryException $e) {
            return response()->json([
                'errorMessage' => $event->errors()->all(),
                'data' => $event
            ]);
        }
    }
    public function destroy($id)
    {
        $event = Event::find($id);
        Generals::unlink($event->image);
        $event->delete();
        return redirect()->back()->with('success', "Event delete Successfully");;
    }

    
    // private function uploadImage($file, $title)
    // {
    //     $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
    //     $file_name = $timestamp . '-' . $title . '.' . $file->getClientOriginalExtension();
    //     $pathToUpload = storage_path() . '\app\public\events/';  // image  upload application save korbo
    //     if (!is_dir($pathToUpload)) {
    //         mkdir($pathToUpload, 0755, true);
    //     }
    //     Image::make($file->getPathname())->resize(800, 400)->save($pathToUpload . $file_name);
    //     return $file_name;
    // }
    // private function unlink($file)
    // {
    //     $pathToUpload = storage_path() . '\app\public\events/';
    //     if ($file != '' && file_exists($pathToUpload . $file)) {
    //         @unlink($pathToUpload . $file);
    //     }
    // }
}
