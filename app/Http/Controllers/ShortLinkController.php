<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;
use App\Models\DomainName;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
        $domains = DomainName::all();
   
        return view('shortenLink', compact('shortLinks','domains'));
    }

    public function addDomain(Request $request)
    {
        $request->validate([
            'domain_name' => 'required|url'
         ]);

         $input['domain_name'] = $request->domain_name;

         DomainName::create($input);

         return redirect('generate-shorten-link')
             ->with('success', 'Domain Created Successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);
   
        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
   
        ShortLink::create($input);
  
        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
    }

    public function customDomain(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'domain' => 'required|numeric'
         ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
        $input['domain_id'] = $request->domain;

        ShortLink::create($input);

        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();
   
        return redirect($find->link);
    }

}
