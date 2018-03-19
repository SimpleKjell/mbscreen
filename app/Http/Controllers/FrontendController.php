<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialInstance;
use App\Social;
use App;
use Twitter;

class FrontendController extends Controller
{

    public function showSocialStream()
    {

      $posts = [];

      /*
      * Facebook
      */
      $facebookConfig = Social::where('social', 'Facebook')->first();
      if($facebookConfig) {

        $facebookPages = SocialInstance::where('social_id', $facebookConfig->id)->get();

        foreach ($facebookPages as $facebookPage) {

          $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

          // FB Call
          try {
              $res = $fb->get('/' . $facebookPage->page_id . '/posts?limit=8&fields=message,id,picture,full_picture', $facebookConfig->key);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              dd($e->getMessage());
          }



          $body = $res->getDecodedBody();

          if(is_array($body)) {
            foreach ($body['data'] as $data) {
              $posts[] = [
                'portal' => 'facebook',
                'message' => (isset($data['message'])) ? substr($data['message'], 0, 85) . '...' : '',
                'post_id' => $data['id'],
                'picture' => (isset($data['full_picture'])) ? $data['full_picture'] : '/storage/images/default_facebook.png',
              ];
            }
          }
        }
      }

      /*
      * Twitter
      */
      $twitterConfig = Social::where('social', 'Twitter')->first();
      if($twitterConfig) {

        $twitterPages = SocialInstance::where('social_id', $twitterConfig->id)->get();

        foreach ($twitterPages as $page) {

          $res = Twitter::getUserTimeline(['screen_name' => $page->title, 'count' => 2, 'format' => 'array']);

          if($res) {

            foreach ($res as $data) {
              $posts[] = [
                'portal' => 'twitter',
                'message' => $data['text'],
                'post_id' => $data['id'],
                'picture' => (isset($data['full_picture'])) ? $data['full_picture'] : '/storage/images/default_twitter.png',
              ];
            }


          }
          // var_dump($res[0]);
          // exit;
        }

      }




      shuffle($posts);
      $posts = array_chunk($posts, 4);

      $data = [
        'posts' => $posts
      ];

      return view('frontend.mediabrothers')->with($data);

    }

    public function showSocialNews()
    {

      return view('frontend.socialnews');

    }
}
