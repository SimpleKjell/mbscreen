<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;
use App;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // $kampagnes = Kampagne::all();
      $socials = Social::orderBy('id', 'desc')->get();
      return view('socials.index')->with('socials', $socials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $facebookL = '';
      $accesToken = session('fb_user_access_token');


      $facebook = Social::whereSocial('Facebook')->first();
      if(!$accesToken) {
        if(!$facebook) {
          $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
          $facebookL = $fb->getLoginUrl(['manage_pages']);
        }
      }


      $data = [
        'facebook_l' => $facebookL,
        'access_token' => $accesToken
      ];

      return view('socials.create')->with($data);
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
        'key' => 'required',
        'social' => 'required',
        'auth' => 'nullable',
        'key' => 'nullable',
        'pub' => 'nullable'
      ]);

      // Create Social
      $social = new Social;
      $social->social = $request->input('social');
      $social->key = $request->input('key');
      $social->save();

      if($social->social == 'Facebook') {
        $request->session()->forget('fb_user_access_token');
      }

      return redirect('/admin/socials')->with('success', 'Socialeintrag erstellt.');

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
        // echo ' heh';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
