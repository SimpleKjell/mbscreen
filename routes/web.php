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

Route::get('/', function () {
    return view('kampagnen');
});
Route::get('/kampagnen', function () {
    return view('kampagnen');
});
Route::get('/mediabrothers', function () {
    return view('mediabrothers');
});
Route::get('/aktuell', function () {
    return view('aktuell');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');


Route::resource('admin/kampagnen', 'KampagnenController')->middleware('auth');

Route::resource('admin/socials', 'SocialController')->middleware('auth');


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
