<?php

namespace App\Http\Controllers;

use App;
use App\Social;
use App\Kunde;
use Illuminate\Http\Request;
use App\SocialInstance;
use Vinkla\Instagram\Instagram;
use Illuminate\Support\Facades\Input;
use Session;


class SocialInstancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id Social ID
     * @return \Illuminate\Http\Response
     * @TODO unbedingt alle Admin Pages in einer Datenbank speichern - und nur bei einem Updatecall die API erneut aufrufen
     */
    public function create($id)
    {


      $facebookL = '';
      $social = Social::find($id);
      $accesToken = '';
      $pages = [];
      if($social) {

        if($social->social == 'Facebook') {



          // $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
          $fb = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);

          $accesToken = session('fb_user_access_token');

          if(!empty($accesToken)) {

            try {
                $response = $fb->get('/me/accounts?fields=data', $accesToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }

            $pageIds = $response->getDecodedBody();
            // var_dump($pageIds);
            // die();
            // exit();
            // var_dump($social->key);

            foreach ($pageIds['data'] as $key => $pageId) {
              $pageId = $pageId['id'];

              try {
                  $res = $fb->get('/' . $pageId, $accesToken);
              } catch (Facebook\Exceptions\FacebookSDKException $e) {
                  dd($e->getMessage());
              }

              $node = $res->getGraphPage();

              $pages[$node->getId()] = $node->getName();
            }

            Session::forget('redirect_social_instance_id');
            Session::forget('fb_user_access_token');
          } else {

            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "/";
            $facebookL = $fb->getLoginUrl(['manage_pages']);
            Session::put('redirect_social_instance_id', $id);
          }

          // $key = 'EAAdYqD61P9EBAEXhFp2VJ9imfyxIdc8cwz0W5ZAOL9bgughMkmfZCTpsEVNHFOiTZCRsfKSdo9oeVLmMs1XHfC7NBd7C2JAmeDfIT3jPB1sZCWm9fKNHUAl7ZARo4BPjEsP0rRzfe3L7lRZAsONH2Ut3qtDMIpLs0MZBWysZCdhKyQZDZD';
          // $token_key = 'EAAdYqD61P9EBADdsd5E8TSQJGW0s4XOZBdzOOhd0Wb5ZBgvjR9Rf5ZBAsXgaSheHzS6CmuTuYjghW8bXD32p0oa2hKCZBtDh8Bb3Mde9O8l4wAjD64SDsivDjhi68nemZCFZAXLiODIxzOUS6Y41VXwMIknStiFPif1PwnHsZA3TAZDZD';



        } else if($social->social == 'Twitter') {



        } else {



        }
      }


      $kunden = Kunde::orderBy('id', 'desc')->get();

      $kundenSelect = [];
      if($kunden) {
        foreach ($kunden as $kunde) {
          $kundenSelect[$kunde->id] = $kunde->title;
        }
      }

      $data = [
        'pages' => $pages,
        'social' => $social,
        'kunden' => $kundenSelect,
        'facebook_l' => $facebookL,
        'token' => $accesToken,
      ];

      return view('socials.instances.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {

      // Neue Instance
      $socialInstance = new SocialInstance;
      // Social der Instance
      $social = Social::find($id);

      $accessToken = $request->input('token');

      $pageId = 0;
      // Facebook API Call
      if($social->social == 'Facebook') {

        // Nur wenn es eine page ID gibt
        $this->validate($request, [
          'page_id' => 'required'
        ]);
        $pageId = $request->input('page_id');

        // SmmyK SDK
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

        // FB Call
        try {
            $res = $fb->get('/' . $pageId . '?fields=id,name,picture,about,attire,bio,location,parking,hours,emails,website', $accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Erstelle Node
        $node = $res->getGraphPage();

        // Bildinfos aus Node
        $socialInstance->picture = $node->getPicture();

        // Name der Instance
        // Zum Namen wird jetzt auch der AccessToken gespeichert:
        $arr = [
          'name' => $node->getName(),
          'token' => $accessToken
        ];
        $name = json_encode($arr);

      } else if($social->social == 'Twitter') {

        // Nur, wenn ein Name eingegeben wurde
        $this->validate($request, [
          'title' => 'required'
        ]);

        // Name der Instance
        // Zum Namen wird jetzt auch der AccessToken gespeichert:
        $arr = [
          'name' => $request->input('title'),
          'token' => $accessToken
        ];
        $name = json_encode($arr);

      } else {
        $pageId = $request->input('page_id');

        // Name der Instance
        // Zum Namen wird jetzt auch der AccessToken gespeichert:
        $arr = [
          'name' => $request->input('title'),
          'token' => $accessToken
        ];
        $name = json_encode($arr);

      }

      $socialInstance->title = $name;

      $socialInstance->social_id = $id;
      $socialInstance->anz_posts = $request->input('anz_posts');
      $socialInstance->page_id = $pageId;
      $socialInstance->kunden_id = $request->input('kunden_id');


      $socialInstance->save();

      return redirect('/admin/socials/' . $id )->with('success', 'Page wurde erfolgreich hinzugefügt.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $instance = SocialInstance::find($id);
      return view('socials.instances.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $sId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sId, $id)
    {
        $socialInstance = SocialInstance::find($id);

        $kunden = Kunde::orderBy('id', 'desc')->get();

        $kundenSelect = [];
        if($kunden) {
          foreach ($kunden as $kunde) {
            $kundenSelect[$kunde->id] = $kunde->title;
          }
        }


        $data = [
          'socialInstance' => $socialInstance,
          'sId' => $sId,
          'kunden' => $kundenSelect
        ];


        return view('socials.instances.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sId, $id)
    {
      $socialInstance = SocialInstance::find($id);
      $socialInstance->anz_posts = $request->input('anz_posts');

      if(!is_null(Input::get('use_wall'))) {
        $socialInstance->use_wall = Input::get('use_wall');
      } else {
        $socialInstance->use_wall = '';
      }

      $arr = [
        'name' => $request->input('title'),
        'token' => $request->input('token')
      ];

      $socialInstance->title = json_encode($arr);


      $socialInstance->kunden_id = $request->input('kunden_id');
      $socialInstance->save();

      return redirect('/admin/socials/' . $sId )->with('success', 'Update erfolgreich.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $sId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sID, $id)
    {
      $instance = SocialInstance::find($id);
      $instance->delete();

      return redirect('/admin/socials/' . $sID)->with('success', 'Page erfolgreich gelöscht.');
    }
}
