<?php

namespace App\Http\Controllers;

use App\Kunde;
use Illuminate\Http\Request;

class KundenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kunden = Kunde::orderBy('id', 'desc')->get();
      return view('kunden.index')->with('kunden', $kunden);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('kunden.create');
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
        'title' => 'required',
      ]);

      // Create Kamapgne
      $kunde = new Kunde;
      $kunde->title = $request->input('title');
      $kunde->web_kpi_nutzer = $request->input('web_kpi_nutzer');
      $kunde->web_kpi_aufrufe = $request->input('web_kpi_aufrufe');
      $kunde->fb_kpi_reichweite = $request->input('fb_kpi_reichweite');
      $kunde->fb_kpi_impressionen = $request->input('fb_kpi_impressionen');
      $kunde->fb_kpi_likes = $request->input('fb_kpi_likes');
      $kunde->fb_kpi_kommentare = $request->input('fb_kpi_kommentare');
      $kunde->fb_kpi_teilungen = $request->input('fb_kpi_teilungen');
      $kunde->fb_kpi_vid_views = $request->input('fb_kpi_vid_views');
      $kunde->insta_kpi_reichweite = $request->input('insta_kpi_reichweite');
      $kunde->insta_kpi_likes = $request->input('insta_kpi_likes');
      $kunde->insta_kpi_kommentare = $request->input('insta_kpi_kommentare');
      $kunde->insta_kpi_teilungen = $request->input('insta_kpi_teilungen');
      $kunde->insta_kpi_vid_views = $request->input('insta_kpi_vid_views');

      $kunde->save();

      return redirect('/admin/kunden')->with('success', 'Kunde erstellt.');
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
      $kunde = Kunde::find($id);
      return view('kunden.edit')->with('kunde', $kunde);
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
        'title' => 'required',
      ]);

      // Create Kamapgne
      $kunde = Kunde::find($id);
      $kunde->title = $request->input('title');
      $kunde->web_kpi_nutzer = $request->input('web_kpi_nutzer');
      $kunde->web_kpi_aufrufe = $request->input('web_kpi_aufrufe');
      $kunde->fb_kpi_reichweite = $request->input('fb_kpi_reichweite');
      $kunde->fb_kpi_impressionen = $request->input('fb_kpi_impressionen');
      $kunde->fb_kpi_likes = $request->input('fb_kpi_likes');
      $kunde->fb_kpi_kommentare = $request->input('fb_kpi_kommentare');
      $kunde->fb_kpi_teilungen = $request->input('fb_kpi_teilungen');
      $kunde->fb_kpi_vid_views = $request->input('fb_kpi_vid_views');
      $kunde->insta_kpi_reichweite = $request->input('insta_kpi_reichweite');
      $kunde->insta_kpi_likes = $request->input('insta_kpi_likes');
      $kunde->insta_kpi_kommentare = $request->input('insta_kpi_kommentare');
      $kunde->insta_kpi_teilungen = $request->input('insta_kpi_teilungen');
      $kunde->insta_kpi_vid_views = $request->input('insta_kpi_vid_views');

      $kunde->save();

      return redirect('/admin/kunden')->with('success', 'Kunde erfolgreich bearbeitet.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kunde = Kunde::find($id);
      $kunde->delete();

      return redirect('/admin/kunden')->with('success', 'Kunde gelöscht.');
    }
}
