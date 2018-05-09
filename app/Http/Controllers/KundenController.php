<?php

namespace App\Http\Controllers;

use App\Kunde;
use MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

      $kunde->save();

      // Media
      if(!is_null($request['kunden_logo'])) {

          $media = MediaUploader::fromSource($request->file('kunden_logo'))
          ->toDirectory('/uploads')
          ->upload();

          $kunde->attachMedia($media, ['kunden_logo']);
      }


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


      $kunde->save();

      if(!is_null($request['kunden_logo'])) {

          $media = MediaUploader::fromSource($request->file('kunden_logo'))
          ->toDirectory('/uploads')
          ->upload();

          $kunde->syncMedia($media, ['kunden_logo']);
      }

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
