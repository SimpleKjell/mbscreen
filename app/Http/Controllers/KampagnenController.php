<?php

namespace App\Http\Controllers;

use App\Kampagne;
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
      return view('kampagnen.create');
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
          'desc' => 'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')) {

          // Get filename with the extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          // Get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          // Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          // Filename to store
          $fileNameToStore = $filename . '_'. time() . '.' . $extension;
          // Upload Image
          $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
          $fileNameToStore = 'noimage.jpg';
        }

        // Create Kamapgne
        $kampagne = new Kampagne;
        $kampagne->title = $request->input('title');
        $kampagne->desc = $request->input('desc');
        $kampagne->cover_image = $fileNameToStore;
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

        return view('kampagnen.edit')->with('kampagne', $kampagne);
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
        'desc' => 'required',
      ]);

      // Handle File Upload
      if($request->hasFile('cover_image')) {

        // Get filename with the extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_'. time() . '.' . $extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

      }

      // Update Kamapgne
      $kampagne = Kampagne::find($id);
      $kampagne->title = $request->input('title');
      $kampagne->desc = $request->input('desc');
      if($request->hasFile('cover_image')) {
          $kampagne->cover_image = $fileNameToStore;
      }

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

        if($kampagne->cover_image != 'noimage.jpg') {
          // Delete Image
          Storage::delete('public/cover_images/' . $kampagne->cover_image);
        }
        $kampagne->delete();

        return redirect('/admin/kampagnen')->with('success', 'Kampagne gelöscht.');
    }
}

// NptxDy9MMHcHfG9T
