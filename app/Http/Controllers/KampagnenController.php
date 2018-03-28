<?php

namespace App\Http\Controllers;

use App\Kampagne;
use App\Kunde;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KampagnenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $kampagnes = Kampagne::all();
      $kampagnes = Kampagne::orderBy('id', 'desc')->get();
      return view('kampagnen.index')->with('kampagnes', $kampagnes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $kunden = Kunde::orderBy('id', 'desc')->get();

      $kundenSelect = [];
      if($kunden) {
        foreach ($kunden as $kunde) {
          $kundenSelect[$kunde->id] = $kunde->title;
        }
      }

      $data = [
        'kunden' => $kundenSelect
      ];

      return view('kampagnen.create')->with($data);
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
          // 'desc' => 'required',
          // 'cover_image' => 'image|nullable|max:1999'
        ]);




        // Create Kamapgne
        $kampagne = new Kampagne;

        $kampagne->title = $request->input('title');

        // Media
        if(!is_null($request['image_main'])) {

          $kampagne
            ->addMediaFromRequest('image_main')
            ->toMediaCollection('main');

            // var_dump('ja');
            // exit();
        }
        if(!is_null($request['image_side'])) {
          $kampagne
            ->addMediaFromRequest('image_side')
            ->toMediaCollection('side');
        }
        if(!is_null($request['image_side_2'])) {
          $kampagne
            ->addMediaFromRequest('image_side_2')
            ->toMediaCollection('side_2');
        }
        if(!is_null($request['image_square'])) {
          $kampagne
            ->addMediaFromRequest('image_square')
            ->toMediaCollection('square');
        }

        $kampagne->text_1 = $request->input('text_1');
        $kampagne->text_2 = $request->input('text_2');
        $kampagne->text_3 = $request->input('text_3');
        $kampagne->kunden_id = $request->input('kunden_id');

        $kampagne->web_kpi_nutzer = $request->input('web_kpi_nutzer');
        $kampagne->web_kpi_aufrufe = $request->input('web_kpi_aufrufe');
        $kampagne->fb_kpi_reichweite = $request->input('fb_kpi_reichweite');
        $kampagne->fb_kpi_impressionen = $request->input('fb_kpi_impressionen');
        $kampagne->fb_kpi_likes = $request->input('fb_kpi_likes');
        $kampagne->fb_kpi_kommentare = $request->input('fb_kpi_kommentare');
        $kampagne->fb_kpi_teilungen = $request->input('fb_kpi_teilungen');
        $kampagne->fb_kpi_vid_views = $request->input('fb_kpi_vid_views');
        $kampagne->insta_kpi_reichweite = $request->input('insta_kpi_reichweite');
        $kampagne->insta_kpi_likes = $request->input('insta_kpi_likes');
        $kampagne->insta_kpi_kommentare = $request->input('insta_kpi_kommentare');
        $kampagne->insta_kpi_teilungen = $request->input('insta_kpi_teilungen');
        $kampagne->insta_kpi_vid_views = $request->input('insta_kpi_vid_views');


        $kampagne->save();

        return redirect('/admin/kampagnen')->with('success', 'Kampagne erstellt.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $kampagne = Kampagne::find($id);
      return view('kampagnen.show')->with('kampagne', $kampagne);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kampagne = Kampagne::find($id);
        $kunden = Kunde::orderBy('id', 'desc')->get();

        $kundenSelect = [];
        if($kunden) {
          foreach ($kunden as $kunde) {
            $kundenSelect[$kunde->id] = $kunde->title;
          }
        }

        $data = [
          'kunden' => $kundenSelect,
          'kampagne' => $kampagne
        ];

        return view('kampagnen.edit')->with($data);
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

      // Update Kamapgne
      $kampagne = Kampagne::find($id);
      $kampagne->title = $request->input('title');

      // Media
      if(!is_null($request['image_main'])) {

        // Lösche Media
        $mainMedia = $kampagne->getFirstMedia('main');
        if(!is_null($mainMedia)) {
          $mainMedia->delete();
        }

        $kampagne
          ->addMediaFromRequest('image_main')
          ->toMediaCollection('main');
      }
      if(!is_null($request['image_side'])) {

        // Lösche Media
        $media = $kampagne->getFirstMedia('side');
        if(!is_null($media)) {
          $media->delete();
        }

        $kampagne
          ->addMediaFromRequest('image_side')
          ->toMediaCollection('side');
      }
      if(!is_null($request['image_side_2'])) {

        // Lösche Media
        $media = $kampagne->getFirstMedia('side_2');
        if(!is_null($media)) {
          $media->delete();
        }
        $kampagne
          ->addMediaFromRequest('image_side_2')
          ->toMediaCollection('side_2');
      }
      if(!is_null($request['image_square'])) {

        // Lösche Media
        $media = $kampagne->getFirstMedia('square');
        if(!is_null($media)) {
          $media->delete();
        }
        $kampagne
          ->addMediaFromRequest('image_square')
          ->toMediaCollection('square');
      }

      $kampagne->text_1 = $request->input('text_1');
      $kampagne->text_2 = $request->input('text_2');
      $kampagne->text_3 = $request->input('text_3');
      $kampagne->kunden_id = $request->input('kunden_id');

      $kampagne->web_kpi_nutzer = $request->input('web_kpi_nutzer');
      $kampagne->web_kpi_aufrufe = $request->input('web_kpi_aufrufe');
      $kampagne->fb_kpi_reichweite = $request->input('fb_kpi_reichweite');
      $kampagne->fb_kpi_impressionen = $request->input('fb_kpi_impressionen');
      $kampagne->fb_kpi_likes = $request->input('fb_kpi_likes');
      $kampagne->fb_kpi_kommentare = $request->input('fb_kpi_kommentare');
      $kampagne->fb_kpi_teilungen = $request->input('fb_kpi_teilungen');
      $kampagne->fb_kpi_vid_views = $request->input('fb_kpi_vid_views');
      $kampagne->insta_kpi_reichweite = $request->input('insta_kpi_reichweite');
      $kampagne->insta_kpi_likes = $request->input('insta_kpi_likes');
      $kampagne->insta_kpi_kommentare = $request->input('insta_kpi_kommentare');
      $kampagne->insta_kpi_teilungen = $request->input('insta_kpi_teilungen');
      $kampagne->insta_kpi_vid_views = $request->input('insta_kpi_vid_views');

      $kampagne->save();

      return redirect('/admin/kampagnen')->with('success', 'Kampagne bearbeitet.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kampagne = Kampagne::find($id);
        $kampagne->delete();

        return redirect('/admin/kampagnen')->with('success', 'Kampagne gelöscht.');
    }
}

// NptxDy9MMHcHfG9T
