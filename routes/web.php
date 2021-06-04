<?php
use \App\Permission;
use \App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/logout','Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


Route::get('/test', function () {
if(Gate::allows('Create',Post::class)){

    return "Hi";
}else{
    return "No";
}

});



Route::get('/zhc',function(){


$access=Auth::user()->role->HasAccess();
echo $access;

});






Route::group(['middleware'=>'Admin'],function(){

    Route::get('/admin',function(){
        return view('admin.index');
    });

    Route::get('/admin1',['middleware'=>'Create',function(){
        return view('admin1.index');
    }]);

    Route::resource('/admin/users','AdminUsersController',['names'=>[
        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit'

    ]]);


    Route::resource('/admin/posts','AdminPostsController',['names'=>[

        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit'


    ]]);

    Route::resource('/admin/categories','AdminCategoriesController',['names'=>[

        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit'

    ]]);

    Route::resource('/admin/media','AdminMediasController',['names'=>[

        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit'

    ]]);



    Route::resource('/admin/permissions','UserPermissionsController',['names'=>[

        'index'=>'admin.permissions.index',
        'create'=>'admin.permissions.create',
        'store'=>'admin.permissions.store',
        'edit'=>'admin.permissions.edit'

    ]]);


    // Route::resource('/admin/comments','PostsCommentsController');
   // Route::resource('/admin/comment/replies','CommentRepliesController');
    //Route::get('/admin/media/upload',['as'=>'admin.media.upload','uses'=>'AdminMediasController@store']);


});

