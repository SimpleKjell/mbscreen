<?php

namespace App\Http\Controllers;

use App;
use App\Social;
use Illuminate\Http\Request;
use App\SocialInstance;
use Vinkla\Instagram\Instagram;
use Illuminate\Support\Facades\Input;

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

      $social = Social::find($id);


      $pages = [];
      if($social) {

        if($social->social == 'Facebook') {

          $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
          try {
              $response = $fb->get('/me/accounts?fields=data', $social->key);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              dd($e->getMessage());
          }

          $pageIds = $response->getDecodedBody();
          // var_dump($social->key);

          foreach ($pageIds['data'] as $key => $pageId) {
            $pageId = $pageId['id'];

            try {
                $res = $fb->get('/' . $pageId, $social->key);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }

            $node = $res->getGraphPage();

            $pages[$node->getId()] = $node->getName();
          }

        } else if($social->social == 'Twitter') {



        }
      }

      $data = [
        'pages' => $pages,
        'social' => $social
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
            $res = $fb->get('/' . $pageId . '?fields=id,name,picture,about,attire,bio,location,parking,hours,emails,website', $social->key);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Erstelle Node
        $node = $res->getGraphPage();

        // Bildinfos aus Node
        $socialInstance->picture = $node->getPicture();

        // Name der Instance
        $name = $node->getName();

      } else if($social->social == 'Twitter') {

        // Nur, wenn ein Name eingegeben wurde
        $this->validate($request, [
          'title' => 'required'
        ]);

        // Name der Instance
        $name = $request->input('title');

      }

      $socialInstance->title = $name;

      $socialInstance->social_id = $id;
      $socialInstance->anz_posts = $request->input('anz_posts');
      $socialInstance->page_id = $pageId;


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

        $data = [
          'socialInstance' => $socialInstance,
          'sId' => $sId
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
