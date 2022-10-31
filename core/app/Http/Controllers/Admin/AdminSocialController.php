<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\AdminSocialLink;
use App\Http\Controllers\Controller;

class AdminSocialController extends Controller
{
    public function index()
    {
        $socialLinks = AdminSocialLink::paginate(8);
        return view('admin.social-links.index', compact('socialLinks'));
    }


    public function editSocial($id)
    {
        $socialLink = AdminSocialLink::where('id', $id)->first();
        return view('admin.social-links.edit_social_link', compact('socialLink'));
    }

    public function updateSocial(Request $request, $id)
    {
        $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'fb_link' => 'required',
            'twitter_link' => 'required',
            'instragram_link' => 'required',
            'linkedin_link' => 'required',
        ]);
        $socialLink =  AdminSocialLink::where('id', $id)->first();
        $socialLink->address = $request->address;
        $socialLink->email = $request->email;
        $socialLink->phone = $request->phone;
        $socialLink->fb_link = $request->fb_link;
        $socialLink->twitter_link = $request->twitter_link;
        $socialLink->instragram_link = $request->instragram_link;
        $socialLink->linkedin_link = $request->linkedin_link;
        $socialLink->update();
        $notify[] = ['success', 'Social Links Update Successfully'];
        return redirect()->route('admin.social.index')->withNotify($notify);
    }
}
