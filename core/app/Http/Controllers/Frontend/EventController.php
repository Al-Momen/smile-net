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
        $data['general_events'] = Event::where('user_id', Auth::guard('general')->id())->get();
        $data['general_count'] = Event::where('user_id', Auth::guard('general')->id())->count();
        return view('frontend.deshboard.pages.event',$data);
    }
    public function storeEvents(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'total_sit' => 'required',
            'category' => 'required',
        ]);
        try {
            $event = new Event();
            $event->user_id = Auth::guard('general')->user()->id;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->total_sit = $request->total_sit;
            $event->category_id = $request->category;
            $event->image = Generals::update('events/', 'png', $request->image);
            $event->save();
            // return redirect()->back()->with('success', "Events create Successfully");
            return response()->json([
                'status'=> 'success',
                "message"=>"Event is Created Successfully"
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'errorMessage' => $event->errors()->all(),
                'data' => $event
            ]);
            // dd($e->getMessage());
        }
    }
    public function editEvents($id)
    {
        $event = Event::find($id);
        
        return view('frontend.deshboard.pages.edit_event', compact('event'));
    }

    public function updateEvents(Request $request, $id)
    {   
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'total_sit' => 'required',
            'category' => 'required',
        ]);
        try {
            $event = Event::where('id',$id)->first();
            $oldImage= $event->image;     
            $event->user_id = Auth::guard('general')->user()->id;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->total_sit = $request->total_sit;
            $event->category_id = $request->category;
            $event->image = Generals::update('events/', $oldImage,'png', $request->image);
            $event->update();
             return redirect()->route("user.events")->with('success', "Events update Successfully");
            // return response()->json([
            //     'status'=> 'success',
            //     "message"=>"event is successfully"
            // ]);
        } catch (QueryException $e) {
            // return response()->json([
            //     'errorMessage' => $event->errors()->all(),
            //     'data' => $event
            // ]);
            dd($e->getMessage());
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