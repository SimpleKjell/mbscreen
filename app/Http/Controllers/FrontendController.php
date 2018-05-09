<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialInstance;
use App\Social;
use App;
use Twitter;
use App\Kampagne;
use DateTime;
use Vinkla\Instagram\Instagram;
use Trello\Client;
use Trello;

class FrontendController extends Controller
{

    public function showSocialStream(Request $request)
    {



      $posts = [];

      /*
      * Facebook
      */
      $facebookConfig = Social::where('social', 'Facebook')->first();
      if($facebookConfig) {

        $facebookPages = SocialInstance::where('social_id', $facebookConfig->id)->get();

        foreach ($facebookPages as $facebookPage) {


          /*
          * Nur die internen Socials anzeigen
          */
          if($facebookPage->use_wall != 'val') {
            continue;
          }

          $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');


          try {
              $res = $fb->get('/' . $facebookPage->page_id . '/posts?limit='.$facebookPage->anz_posts.'&fields=message,id,picture,full_picture,created_time', $facebookConfig->key);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              dd($e->getMessage());
          }



          $body = $res->getDecodedBody();



          if(is_array($body)) {
            foreach ($body['data'] as $data) {

              /*
              * Erstellt
              */
              $created = 0;
              if(isset($data['created_time'])) {
                $created = strtotime($data['created_time']);;
              }


              $posts[] = [
                'portal' => 'facebook',
                'message' => (isset($data['message'])) ? substr($data['message'], 0, 85) . '...' : '',
                'post_id' => $data['id'],
                'picture' => (isset($data['full_picture'])) ? $data['full_picture'] : '',
                'created' => $created
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

          /*
          * Nur die internen Socials anzeigen
          */
          if($page->use_wall != 'val') {
            continue;
          }


          $res = Twitter::getUserTimeline(['screen_name' => $page->title, 'count' => $page->anz_posts, 'format' => 'array', 'exclude_replies' => true, 'tweet_mode' => 'extended']);

          if($res) {

            foreach ($res as $data) {

              $created = 0;
              if(isset($data['created_at'])) {
                $created = strtotime($data['created_at']);
              }
              /*
              * Picture of Tweet
              */
              $picture = '';
              if(isset($data['entities']['media'])) {
                if(is_array($data['entities']['media'])) {
                  if(isset($data['entities']['media'][0])) {
                    if(isset($data['entities']['media'][0]['media_url'])) {
                      $picture = $data['entities']['media'][0]['media_url'];
                    }
                  }
                } else {
                  if(isset($data['entities']['media']['media_url'])) {
                    $picture = $data['entities']['media']['media_url'];
                  }
                }

              }

              $posts[] = [
                'portal' => 'twitter',
                'message' => $data['full_text'],
                'post_id' => $data['id'],
                'picture' => $picture,
                'created' => $created,
                'belongs_to' => $page->title
              ];

            }
          }
        }
      }

      /*
      * Instagram
      */
      $isntaConfig = Social::where('social', 'Instagram')->first();
      if($isntaConfig) {

        // 1771883507.4f0be6a.ccec6206effb4d6785088cec5218ffb6
        // MB Secret - es müssen alle User als Sandbox User eingetragen werden.
        // 1771883507.1677ed0.29e446a8da944504b11136eecb84d5fb alt


        $instagram = new Instagram('1771883507.4f0be6a.ccec6206effb4d6785088cec5218ffb6');

        $instaPages = SocialInstance::where('social_id', $isntaConfig->id)->get();

        foreach ($instaPages as $page) {

          /*
          * Nur die internen Socials anzeigen
          */
          if($page->use_wall != 'val') {
            continue;
          }

          if(!empty($page->page_id)) {
            $recentFeed = $instagram->get($page->page_id);

            mb_internal_encoding("UTF-8");
            foreach ($recentFeed as $instaPost) {
              $created = (isset($instaPost->created_time)) ? $instaPost->created_time : 0;

              $posts[] = [
                'portal' => 'instagram',
                'message' => mb_substr($instaPost->caption->text, 0, 85) . '...',
                'post_id' => 'id',
                'picture' => $instaPost->images->standard_resolution->url,
                'created' => $created
              ];

            }
          }


        }

      }





      usort($posts, function ($item1, $item2) {
        return $item2['created'] <=> $item1['created'];
      });

      $ajax = $request->ajax();
      $data = [
        'posts' => $posts,
        'ajax' => $ajax
      ];



      return view('frontend.mediabrothers')->with($data);

    }

    /*
    *  Social News
    */
    public function showSocialNews()
    {
      /*
      * Trello Board
      */
      $client = new Client();
      $client->authenticate('827f16eedf45fe96e0a50fd465f6709a', 'ad5232815c9def3347199597dbb7915091dafcbe41367c3890609f543de61e7e', Client::AUTH_URL_CLIENT_ID);

      $board = Trello::manager()->getBoard('mDYLXl9E');
      $boardName = $board->getName();

      $data = [
        'boardName' => $boardName,
      ];

      $lists = $board->getLists();
      foreach ($lists as $list) {
        $listName = $list->getName();
        $listArray = ['name' => $listName, 'cards' => []];

        $cards = $list->getCards();
        foreach ($cards as $card) {

          $pic = '';
          if($card->getAttachmentCoverId()) {
            try {
              $pic = $client->api('card')->attachments()->show($card->getId(), $card->getAttachmentCoverId());
              $pic = $pic['url'];
            } catch (\Exception $e) {

            }

          }
          $cardName = $card->getName();
          $listArray['cards'][] = [
            'name' => $cardName,
            'picture' => $pic
          ];
        }
        $data['lists'][] = $listArray;
      }

      return view('frontend.socialnews')->with($data);

    }

    public function showKampagnen(Request $request)
    {
      $kampagnen = Kampagne::all();

      $ajax = $request->ajax();

      return view('frontend.kampagnen')->with(['kampagnen' => $kampagnen, 'ajax' => $ajax] );
    }

    public function showLive()
    {

      $posts = [];

      /*
      * Facebook
      */
      $facebookConfig = Social::where('social', 'Facebook')->first();
      if($facebookConfig) {

        $facebookPages = SocialInstance::where('social_id', $facebookConfig->id)->get();

        foreach ($facebookPages as $facebookPage) {


          /*
          * Nur die internen Socials anzeigen
          */
          if($facebookPage->use_wall == 'val') {
            continue;
          }

          $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');


          try {
              $res = $fb->get('/' . $facebookPage->page_id . '/posts?limit='.$facebookPage->anz_posts.'&fields=message,id,picture,full_picture,created_time', $facebookConfig->key);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              dd($e->getMessage());
          }



          $body = $res->getDecodedBody();



          if(is_array($body)) {
            foreach ($body['data'] as $data) {

              /*
              * Erstellt
              */
              $created = 0;
              if(isset($data['created_time'])) {
                $created = strtotime($data['created_time']);;
              }


              $posts[] = [
                'portal' => 'facebook',
                'message' => (isset($data['message'])) ? substr($data['message'], 0, 85) . '...' : '',
                'post_id' => $data['id'],
                'picture' => (isset($data['full_picture'])) ? $data['full_picture'] : '',
                'created' => $created,
                'belongs_to' => $facebookPage->title
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

          /*
          * Nur die internen Socials anzeigen
          */
          if($page->use_wall == 'val') {
            continue;
          }


          $res = Twitter::getUserTimeline(['screen_name' => $page->title, 'count' => $page->anz_posts, 'format' => 'array', 'exclude_replies' => true, 'tweet_mode' => 'extended']);

          if($res) {

            foreach ($res as $data) {

              $created = 0;
              if(isset($data['created_at'])) {
                $created = strtotime($data['created_at']);
              }
              /*
              * Picture of Tweet
              */
              $picture = '';
              if(isset($data['entities']['media'])) {
                if(is_array($data['entities']['media'])) {
                  if(isset($data['entities']['media'][0])) {
                    if(isset($data['entities']['media'][0]['media_url'])) {
                      $picture = $data['entities']['media'][0]['media_url'];
                    }
                  }
                } else {
                  if(isset($data['entities']['media']['media_url'])) {
                    $picture = $data['entities']['media']['media_url'];
                  }
                }

              }

              $posts[] = [
                'portal' => 'twitter',
                'message' => $data['full_text'],
                'post_id' => $data['id'],
                'picture' => $picture,
                'created' => $created,
                'belongs_to' => $data['user']['name']
              ];

            }
          }
        }
      }

      /*
      * Instagram
      */
      $isntaConfig = Social::where('social', 'Instagram')->first();
      if($isntaConfig) {

        // 1771883507.4f0be6a.ccec6206effb4d6785088cec5218ffb6
        // MB Secret - es müssen alle User als Sandbox User eingetragen werden.
        // 1771883507.1677ed0.29e446a8da944504b11136eecb84d5fb alt


        $instagram = new Instagram('1771883507.4f0be6a.ccec6206effb4d6785088cec5218ffb6');

        $instaPages = SocialInstance::where('social_id', $isntaConfig->id)->get();

        foreach ($instaPages as $page) {

          /*
          * Nur die internen Socials anzeigen
          */
          if($page->use_wall == 'val') {
            continue;
          }

          if(!empty($page->page_id)) {
            $recentFeed = $instagram->get($page->page_id);

            mb_internal_encoding("UTF-8");
            foreach ($recentFeed as $instaPost) {
              $created = (isset($instaPost->created_time)) ? $instaPost->created_time : 0;

              $posts[] = [
                'portal' => 'instagram',
                'message' => mb_substr($instaPost->caption->text, 0, 85) . '...',
                'post_id' => 'id',
                'picture' => $instaPost->images->standard_resolution->url,
                'created' => $created,
                'belongs_to' => $page->title
              ];

            }
          }


        }

      }

      usort($posts, function ($item1, $item2) {
        return $item2['created'] <=> $item1['created'];
      });

      $data = [
        'posts' => $posts
      ];

      return view('frontend.aktuell')->with($data);

    }

}
