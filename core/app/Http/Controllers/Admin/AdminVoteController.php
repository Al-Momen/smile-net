<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminVote;
use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use App\Models\AdminVoteImage;
use App\Models\UserVote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
 
class AdminVoteController extends Controller
{
    public function index()
    {
        $categories = AdminCategory::all();
        $adminVotes = AdminVote::with(['category', "ticket",'adminVoteImages'])->paginate(10);
        $tickets = TicketType::all();
        return view('admin.vote.index', compact('categories','adminVotes', 'tickets'));
    }
    public function storeVote(Request $request)
    {
        dd($request->all());
        $request->validate([
            'vote_name' => 'required|min:2|max:255',
            'vote_image' => 'required|image|mimes:jpeg,png,jpg',
            'names' => 'required',
            'names.*' => 'required|min:2|max:255',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg',
            'category' => 'required',
            'ticket' => 'required',
        ]);

        $vote = new AdminVote();
        $vote->category_id = $request->category;
        $vote->ticket_id = $request->ticket;
        $vote->vote_name = $request->vote_name;
        $vote->vote_image =Generals::upload('votes/', 'png', $request->vote_image);
        $vote->save();
        $images= $request->images;
        $names= $request->names;
        if($images){
            foreach ($images as $index => $image) {
                $voteImage = new AdminVoteImage();
                $voteImage->admin_vote_id = $vote->id;
                $voteImage->name = $names[$index];
                $voteImage->image = $this->uploadOne('votes/', $names[$index],'png', $image);
                $voteImage->save();
            } 
        }
        $notify[] = ['success', 'Votes create Successfully'];
        return redirect()->back()->withNotify($notify);

    }
    public function editVote($id)
    {
        $adminVote = AdminVote::with(['category', "ticket"])->findOrFail($id); // relation from events table->then plans table-> then ticket_type get data
        $categories = AdminCategory::all();
        $ticketType = TicketType::all();
        return view('admin.vote.edit-vote', compact('adminVote', 'categories', 'ticketType'));
    }
    public function updateVote(Request $request, $id)
    {
        $request->validate([
            'vote_name' => 'required|min:2|max:255',
            'vote_image' => 'required|image|mimes:jpeg,png,jpg',
            'name_one' => 'required|min:2|max:255',
            'image_one' => 'required|image|mimes:jpeg,png,jpg',
            'name_two' => 'required|min:2|max:255',
            'image_two' => 'required|image|mimes:jpeg,png,jpg',
            'category' => 'required',
            'ticket' => 'required',
        ]);
        //    dd( $request->all());
        try {
            $vote = AdminVote::findOrFail($id);
            $oldImage = $vote->vote_image;
            $oldImageOne = $vote->image_one;
            $oldImagetwo = $vote->image_two;
            $vote->category_id = $request->category;
            $vote->ticket_id = $request->ticket;
            $vote->vote_name = $request->vote_name;
            $vote->name_one = $request->name_one;
            $vote->name_two = $request->name_two;
            $vote->vote_image = Generals::update('votes/', $oldImage, 'png', $request->vote_image);
            $vote->image_one= $this->updateOne('votes/', $oldImageOne, $request->name_one, 'png', $request->image_one);
            $vote->image_two = $this->updateTwo('votes/', $oldImagetwo, $request->name_two, 'png', $request->image_two);
            $vote->update();
            $notify[] = ['success', 'Vote Update Successfully'];
            return redirect()->route('admin.vote.index')->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editStatusVote(Request $request, $id)
   {
      $vote = AdminVote::where('id', $id)->first();
      if ($request->status == 'on') {
         $vote->status = 1;
         $vote->update();
         $notify[] = ['success', 'Vote is Active'];
         return redirect()->back()->withNotify($notify);
      } else {
         $vote->status = 0;
         $vote->update();
         $notify[] = ['success', 'Vote is Inactive'];
         return redirect()->back()->withNotify($notify);
      }
   }
    public function destroy($id)
    {
        $vote = AdminVote::with('adminVoteImages')->find($id);
        foreach ($vote->adminVoteImages as $item) {
            Generals::unlink('votes/', $item->image);
            $item->delete();
        }
        Generals::unlink('votes/', $vote->vote_image);
        $vote->delete();
        $notify[] = ['success', 'Vote Delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function allVote()
    {
         $votes = UserVote::with('adminVoteImage','user')->orderBy('id','desc')->paginate(10);
        
        return view('admin.vote.all_vote',compact('votes'));
    }

    public function voteView()
    {
         $votes = UserVote::with('adminVoteImage','user')->orderBy('id','desc')->first();
        
        return view('admin.vote.view_vote',compact('votes'));
    }
      //Image upload One
      private function uploadOne(string $dir, string $name, string $format, $image = null)
      {
          if ($image != null) {
              $imageName = \Carbon\Carbon::now()->toDateString() . "-".$name. time() . "." . $format;
              if (!Storage::disk('public')->exists($dir)) {
                  Storage::disk('public')->makeDirectory($dir);
              }
              Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
              // dd(file_get_contents($image));
              // dd($imageName);
              return $imageName;
          } else {
              $imageName = 'def.png';
          }
          return $imageName;
      }
      //Image upload Two
      private function uploadTwo(string $dir, string $name, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = \Carbon\Carbon::now()->toDateString() . "-" .$name. time() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
            //  dd(file_get_contents($image));
            // dd($imageName);
            return $imageName;
        } else {
            $imageName = 'def.png';
        }
        return $imageName;
    }

      // Image update One
      private function updateOne(string $dir, $old_image_one, $name, string $format, $image = null)
      {
          if ($image == null) {
              return $old_image_one;
          }
          if (Storage::disk('public')->exists($dir . $old_image_one)) {
              Storage::disk('public')->delete($dir . $old_image_one);
          }
          $imageName = $this->uploadOne($dir, $name, $format, $image);
          return $imageName;
      }

      // Image updateTwo
      private function updateTwo(string $dir, $old_image_two, $name, string $format, $image = null)
      {
          if ($image == null) {
              return $old_image_two;
          }
          if (Storage::disk('public')->exists($dir . $old_image_two)) {
              Storage::disk('public')->delete($dir . $old_image_two);
          }
          $imageName = $this->uploadtwo($dir, $name, $format, $image);
          return $imageName;
      }
}
