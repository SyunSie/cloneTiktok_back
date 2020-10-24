<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user','App\Http\Controllers\UserController@createAccount');
Route::put('/user',function(Request $request){
    return 'test api';
});
Route::get('/auth','App\Http\Controllers\LoginController@GetUserInfo');
Route::post('/auth', 'App\Http\Controllers\LoginController@Login');
Route::delete('/auth', 'App\Http\Controllers\LoginController@Logout');


///test api
// Route::post('/post','App\Http\Controllers\GCSController@UploadObject');
Route::post('/post',
    function (Request $req){
        $user = Auth::user();
        // return ['msg' => ['file'=>$req['file'], 'text' =>$req->text]];
        $ret = App\Http\Controllers\PostsController::CreatePost($user , $req['text'] ,$req['file']);
        return $ret;
    }
);
ROUTE::delete('/post/{bucketname}/{blobname}',
    function(Request $req,$bucketname,$blobname){

        return App\Http\Controllers\GCSController::DeleteObject($bucketname,$blobname);
    }
);

ROUTE::get('/user/{userid}/posts' , 
    function (Request $req,$userid ){
        
        $reader = Auth::user();
        $userid = intval($userid);
        

        return App\Http\Controllers\PostsController::GetUserPosts($req,$userid,$reader);
    }
);
ROUTE::get('/posts',
    function(Request $req){
        $reader = Auth::user();

        return App\Http\Controllers\PostsController::GetPosts($req, $reader);
    }
);

ROUTE::post('/like/{targetId}',function(Request $req , $targetID){
    $postid = intval($targetID);
    $user = Auth::user();
    return App\Http\Controllers\UserController::setUserLikesToPost($user , $targetID , TRUE);
    
});
ROUTE::delete('/like/{targetId}',function(Request $req, $targetID){
    $postid = intval($targetID);
    $user = Auth::user();
    return App\Http\Controllers\UserController::setUserLikesToPost($user , $targetID , FALSE);

});