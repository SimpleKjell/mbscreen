<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.kampagnen');
// });
// Route::get('/kampagnen', function () {
//     return view('frontend.kampagnen');
// });



Route::get('/mediabrothers', 'FrontendController@showSocialStream');
Route::get('/social-news', 'FrontendController@showSocialNews');
Route::get('/', 'FrontendController@showKampagnen');



Route::get('/aktuell', function () {
    return view('frontend.aktuell');
});
Route::get('/welcome', function () {
    return view('frontend.welcome');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');

Route::resource('admin/kunden', 'KundenController')->middleware('auth');

Route::resource('admin/kampagnen', 'KampagnenController', [
  'names' => [
      'index' => 'kampagnen'
  ]])->middleware('auth');

Route::resource('admin/socials', 'SocialController')->middleware('auth');

Route::resource('admin/socials.i', 'SocialInstancesController')->middleware('auth');

Route::resource('admin/feeds', 'FeedsController')->middleware('auth');


/*
* Facebook
*/

// Endpoint that is redirected to after an authentication attempt
Route::get('/admin/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    // try {
    //     $response = $fb->get('/me/accounts?fields=data');
    // } catch (Facebook\Exceptions\FacebookSDKException $e) {
    //     dd($e->getMessage());
    // }
    // var_dump($token);
    // var_dump($response);
    // EAAdYqD61P9EBALjcOL4CzWDcqaSXJDZAMHjRMHSJljZCcZCIdhQBbnkBcUebgoENTT1DnIzkwi7diug4UZCtQrdpFgE407oizZBKVflXRvR2HGB73Q2MuAk5p6EPdabPb9Oz2yYksn98twbocFQlRRPO4ZBsZCZA0ykZD
    // EAAdYqD61P9EBAAIHpcWGu1iGcvtfWljJiSIRVEycNMYWqoasU5H1ib0myEF9QHlmt45hoTNjKeXECMRxA3gtAeIJViZAQXLdAZB7mKQYLL9fHvHkjsc5y6ZCq20nYiRlZAQCnTwAEMtoswEDi7I1d9ginJKIjhIZD

    // Array Ausgabe
    // var_dump($response->getDecodedBody());
    // $pageIds = $response->getDecodedBody();
    //
    // $testID = $pageIds['data'][1]['id'];
    // // var_dump();
    //
    // try {
    //     $res = $fb->get('/' . $testID . '/feed');
    // } catch (Facebook\Exceptions\FacebookSDKException $e) {
    //     dd($e->getMessage());
    // }
    //
    // // var_dump($res->getGraphPage());
    // var_dump($res->getDecodedBody());


    // var_dump($response->getGraphEdge());

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    // $facebook_user = $response->getGraphUser();

    // Create the user if it does not exist or update the existing entry.
    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
    // $facebook_edge = $response->getGraphEdge();
    // var_dump($facebook_edge->items);
    // $user = App\User::createOrUpdateGraphNode($facebook_user);
    //
    // // Log the user into Laravel
    // Auth::login($user);
    //

    // var_dump('sweot');
    return redirect()->action('SocialController@create');
    // return redirect()->action('KampagnenController@index');



});


use Trello\Client;

Route::get('/userTimeline', function()
{
  // $test = Twitter::getUserTimeline(['screen_name' => 'MediaBrothers', 'count' => 10, 'format' => 'array']);

  // var_dump($test->entities);
  // 976074723531673600
  // return Twitter::getUserTimeline(['screen_name' => 'MiauuMiauu', 'count' => 2, 'format' => 'array','tweet_mode' => 'extended', 'exclude_replies' => true]);
  // return Twitter::getTweet('976071831890399232', ['format' => 'array', 'tweet_mode' => 'extended']);


	// return;

  // $instagram = new Instagram('6950340697.1677ed0.15b25467b93641b69fb7a93d6212cb9e');
  // $test = $instagram->get();
  // var_dump($test);

  // $card = Trello::getDefaultBoardId();
  // var_dump($card);

  $client = new Client();
  $client->authenticate('d5a25eb37b0ad428c54b117283a319c6', '7e746bb766b845769015a7d7a45513bec3656e19692958168dfe182cbcf8792a', Client::AUTH_URL_CLIENT_ID);

  $board = Trello::manager()->getBoard('58aed927e680a8be5093f3b3');
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





});
