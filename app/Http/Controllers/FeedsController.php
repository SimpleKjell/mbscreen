<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $kampagnes = Kampagne::all();
      $feeds = Feed::orderBy('id', 'desc')->get();
      return view('feeds.index')->with('feeds', $feeds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'feed_url' => 'required',
      ]);

      // Create Kamapgne
      $feed = new Feed;
      $feed->feed_url = $request->input('feed_url');
      $anzPosts = $request->input('anz_posts');
      $feed->anz_posts = (empty($anzPosts)) ? 10 : $anzPosts;
      $feed->save();

      return redirect('/admin/feeds')->with('success', 'Kampagne erstellt.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = Feed::find($id);

        return view('feeds.edit')->with('feed', $feed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'feed_url' => 'required',
        'anz_posts' => 'required',
      ]);

      $feed = Feed::find($id);
      $feed->anz_posts = $request->input('anz_posts');
      $feed->feed_url = $request->input('feed_url');
      $feed->save();

      return redirect('/admin/feeds')->with('success', 'Update erfolgreich.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $feed = Feed::find($id);
      $feed->delete();

      return redirect('/admin/feeds')->with('success', 'Feed erfolgreich gelöscht.');
    }
}
