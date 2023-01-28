<?php

namespace App\Http\Controllers\Admin;

use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use App\Models\AdminTopMovies;
use App\Models\AdminNewItemMovies;
use App\Http\Controllers\Controller;
use App\Models\AdminCommingSoonMovies;
use Illuminate\Support\Facades\Auth;

class AdminMoviesController extends Controller
{

    // ------------------------admin New Items Movies------------------------
    public function newItemSeason()
    {
        
        $ticketTypes = TicketType::get();
         $newItemMovies = AdminNewItemMovies::with('ticketType')->orderBy('id','desc')->paginate(15);
        return view('admin.movies.new_item_movies',compact('newItemMovies','ticketTypes'));
    }
    public function storeNewItemSeason(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4000',
            'mp4' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
        ]);
        $newItemMovies = new AdminNewItemMovies();
        $newItemMovies->name = $request->name;
        $newItemMovies->category = $request->category;
        $newItemMovies->admin_id = Auth::user()->id;
        $newItemMovies->ticket_type_id = $request->ticket_type_id;
        $newItemMovies->description = $request->description;
        $newItemMovies->image = Generals::upload('new-item-movies/photo/', 'png', $request->image);
        $newItemMovies->mp4 = Generals::fileUpload('new-item-movies/movies/', $request->mp4);
        $newItemMovies->slug = url('/'). "/core/storage/app/public/new-item-movies/movies/". $newItemMovies->mp4;
        $newItemMovies->save();
        $notify[] = ['success', 'New Item Movies create Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function editNewItemSeason($id)
    {
        $newItemMovies = AdminNewItemMovies::with('ticketType')->where('id', $id)->first();
        $ticketTypes = TicketType::get();
        return view('admin.movies.edit_new_item_movies', compact('newItemMovies','ticketTypes'));
    }
    public function editStatusNewItemSeason(Request $request, $id)
    {
        $newItemMovies = AdminNewItemMovies::where('id', $id)->first();
        if ($request->status == 'on') {
            $newItemMovies-> status = 1;
            $newItemMovies->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $newItemMovies->status = 0;
            $newItemMovies->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function updateNewItemSeason(Request $request,$id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,wepd,svg|max:4000',
            'mp4' => 'mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
        ]);
        $newItemMovies = AdminNewItemMovies::where('id', $id)->first();
        $oldNewItemMoviesImage= $newItemMovies->image;
        $oldNewItemMoviesMp4= $newItemMovies->mp4;
        $newItemMovies->name = $request->name;
        $newItemMovies->category = $request->category;
        $newItemMovies->admin_id = Auth::user()->id;
        $newItemMovies->ticket_type_id = $request->ticket_type_id;
        $newItemMovies->description = $request->description;

        if($request->hasFile('image')){
            $newItemMovies->image = Generals::update('new-item-movies/photo/', $oldNewItemMoviesImage,'png', $request->image);
            $newItemMovies->update();
        }
        if($request->hasFile('mp4')){
            $newItemMovies->mp4 = Generals::FileUpdate('new-item-movies/movies/', $oldNewItemMoviesMp4, $request->mp4);
            $newItemMovies->update();
        }
        $newItemMovies->slug = url('/'). "/core/storage/app/public/new-item-movies/movies/". $newItemMovies->mp4;
        $newItemMovies->update();
        $notify[] = ['success', 'New Item Movies Update Successfully'];
        return redirect()->route('admin.home.newItemSeason')->withNotify($notify);
    }
    public function destroy($id)
    {
        $newItemMovies = AdminNewItemMovies::find($id);
        Generals::unlink('new-item-movies/photo/',$newItemMovies->image);
        Generals::fileUnlink('new-item-movies/movies/',$newItemMovies->mp4);
        $newItemMovies->delete();
        $notify[] = ['success', 'New Item Movies delete Successfully'];
        return redirect()->back()->withNotify($notify); 
    }




    // ------------------------admin top Movies------------------------
    public function topMovies()
    {
        $ticketTypes = TicketType::get();
        $topMovies = AdminTopMovies::with('ticketType')->orderBy('id','desc')->paginate(15);
        return view('admin.movies.top_movies',compact('topMovies','ticketTypes'));
    }
    public function storeTopMovies(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4000',
            'mp4' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
        ]);
        $topMovies = new AdminTopMovies();
        $topMovies->name = $request->name;
        $topMovies->category = $request->category;
        $topMovies->admin_id = Auth::user()->id;
        $topMovies->ticket_type_id = $request->ticket_type_id;
        $topMovies->description = $request->description;
        $topMovies->image = Generals::upload('top-movies/photo/', 'png', $request->image);
        $topMovies->mp4 = Generals::fileUpload('top-movies/movies/',$request->mp4);
        $topMovies->slug = url('/'). "/core/storage/app/public/top-movies/movies/". $topMovies->mp4;
        $topMovies->save();
        $notify[] = ['success', 'Top Movies create Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function editTopMovies($id)
    {
        $topMovies = AdminTopMovies::with('ticketType')->where('id', $id)->first();
        $ticketTypes = TicketType::get();
        return view('admin.movies.edit_top_movies', compact('topMovies','ticketTypes'));
    }
    public function editStatusTopMovies(Request $request, $id)
    {
        $topMovies = AdminTopMovies::where('id', $id)->first();
        if ($request->status == 'on') {
            $topMovies-> status = 1;
            $topMovies->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $topMovies->status = 0;
            $topMovies->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function updateTopMovies(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:4000',
            'mp4' => 'mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
        ]);
        $topMovies = AdminTopMovies::where('id', $id)->first();
        $oldTopMoviesImage= $topMovies->image;
        $oldTopMoviesMp4= $topMovies->mp4;
        $topMovies->name = $request->name;
        $topMovies->category = $request->category;
        $topMovies->admin_id = Auth::user()->id;
        $topMovies->ticket_type_id = $request->ticket_type_id;
        $topMovies->description = $request->description;
        if($request->hasFile('image')){

            $topMovies->image = Generals::update('top-movies/photo/', $oldTopMoviesImage,'png', $request->image);
        }
        if($request->hasFile('mp4')){
 
            $topMovies->mp4 = Generals::fileUpdate('top-movies/movies/', $oldTopMoviesMp4, $request->mp4);
        }
        $topMovies->slug = url('/'). "/core/storage/app/public/top-movies/movies/". $topMovies->mp4;
        $topMovies->update();
        $notify[] = ['success', 'Top Movies Update Successfully'];
        return redirect()->route('admin.home.top.movies')->withNotify($notify);
    }
    public function destroyTopMovies($id)
    {
        $topMovies = AdminTopMovies::find($id);
        Generals::unlink('top-movies/photo/',$topMovies->image);
        Generals::fileUnlink('top-movies/movies/',$topMovies->mp4);
        $topMovies->delete();
        $notify[] = ['success', 'Top Movies delete Successfully'];
        return redirect()->back()->withNotify($notify); 
    }
     // ------------------------admin Comming Soon Movies------------------------
     public function commingSoonMovies()
     {
         $ticketTypes = TicketType::get();
         $commingSoonMovies = AdminCommingSoonMovies::with('ticketType')->orderBy('id','desc')->paginate(15);
         return view('admin.movies.coming_soon_movies',compact('commingSoonMovies','ticketTypes'));
     }
     public function storeCommingSoonMovies(Request $request)
     {
         $request->validate([
             'name' => 'required|min:2|max:255',
             'ticket_type_id' => 'required',
             'description' => 'required',
             'year' => 'required|numeric',
             'category' => 'required',
             'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4000',
             'mp4' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
         ]);
         $commingSoonMovies = new AdminCommingSoonMovies();
         $commingSoonMovies->name = $request->name;
         $commingSoonMovies->category = $request->category;
         $commingSoonMovies->year = $request->year;
         $commingSoonMovies->admin_id = Auth::user()->id;
         $commingSoonMovies->ticket_type_id = $request->ticket_type_id;
         $commingSoonMovies->description = $request->description;
         $commingSoonMovies->image = Generals::upload('comming-soon-movies/photo/', 'png', $request->image);
         $commingSoonMovies->mp4 = Generals::FileUpload('comming-soon-movies/movies/', $request->mp4);
         $commingSoonMovies->slug = url('/'). "/core/storage/app/public/comming-soon-movies/movies/". $commingSoonMovies->mp4;
         $commingSoonMovies->save();
         $notify[] = ['success', 'Top Movies create Successfully'];
         return redirect()->back()->withNotify($notify);
     }
 
     public function editCommingSoonMovies($id)
     {
         $commingSoonMovies = AdminCommingSoonMovies::with('ticketType')->where('id', $id)->first();
         $ticketTypes = TicketType::get();
         return view('admin.movies.edit_coming_soon_movies', compact('commingSoonMovies','ticketTypes'));
     }
     public function editStatusCommingSoonMovies(Request $request, $id)
     {
         $commingSoonMovies = AdminCommingSoonMovies::where('id', $id)->first();
         if ($request->status == 'on') {
             $commingSoonMovies-> status = 1;
             $commingSoonMovies->update();
             $notify[] = ['success', 'Admin Status is Active'];
             return redirect()->back()->withNotify($notify);
         } else {
             $commingSoonMovies->status = 0;
             $commingSoonMovies->update();
             $notify[] = ['success', 'Admin Status is Inactive'];
             return redirect()->back()->withNotify($notify);
         }
     }
     
     public function updateCommingSoonMovies(Request $request,$id)
     {
         $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'description' => 'required',
            'year' => 'required|numeric',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:4000',
            'mp4' => 'mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
         ]);
         $commingSoonMovies = AdminCommingSoonMovies::where('id', $id)->first();
         $oldcommingSoonMoviesImage= $commingSoonMovies->image;
         $oldcommingSoonMoviesMp4= $commingSoonMovies->mp4;
         $commingSoonMovies->name = $request->name;
         $commingSoonMovies->category = $request->category;
         $commingSoonMovies->year = $request->year;
         $commingSoonMovies->admin_id = Auth::user()->id;
         $commingSoonMovies->ticket_type_id = $request->ticket_type_id;
         $commingSoonMovies->description = $request->description;
         if($request->hasFile('image')){

             $commingSoonMovies->image = Generals::update('comming-soon-movies/photo/', $oldcommingSoonMoviesImage,'png', $request->image);
         }
         if($request->hasFile('mp4')){

             $commingSoonMovies->mp4 = Generals::FileUpdate('comming-soon-movies/movies/', $oldcommingSoonMoviesMp4, $request->mp4);
         }

         $commingSoonMovies->slug = url('/'). "/core/storage/app/public/comming-soon-movies/movies/". $commingSoonMovies->mp4;
         $commingSoonMovies->update();
         $notify[] = ['success', 'Comming soon Movies Update Successfully'];
         return redirect()->route('admin.home.comming.soon.movies')->withNotify($notify);
     }
     public function destroyCommingSoonMovies($id)
     {
         $commingSoonMovies = AdminCommingSoonMovies::find($id);
         Generals::unlink('comming-soon-movies/photo/',$commingSoonMovies->image);
         Generals::fileUnlink('comming-soon-movies/movies/',$commingSoonMovies->mp4);
         $commingSoonMovies->delete();
         $notify[] = ['success', 'Comming soon Movies delete Successfully'];
         return redirect()->back()->withNotify($notify); 
     }


    
}
