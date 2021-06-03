<?php
use \App\Permission;
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

Route::get('/zhc',function(){


      $permissions=Auth::user()->role->permission();

    $tryss=Auth::user()->role->tryss();

    if($tryss==='["1","2","3","4","5"]') {
        echo "Administrator";
    }else
        if($tryss==='["1","2","3","4"]') {
        echo "Dashboard,Create,Read,Update";
    }else
        if($tryss==='["1","2","3","5"]') {
        echo "Dashboard,Create,Read,Update";
    }else
        if($tryss==='["1","2","4","5"]') {
        echo "Dashboard,Create,Read,Update";
    }else
        if($tryss==='["1","3","4","5"]') {
        echo "Dashboard,Create,Read,Update";
    }else
        if($tryss==='["2","3","4","5"]') {
        echo "Dashboard,Create,Read,Update";
    }else
        if($tryss==='["1","2","3"]') {
        echo "Dashboard,Create,Read";
    }else
        if($tryss==='["1","3","4"]') {
        echo "Dashboard,Create,Read";
    }else
        if($tryss==='["2","3","4"]') {
        echo "Dashboard,Create,Read";
    }else
        if($tryss==='["1","3","5"]') {
        echo "Dashboard,Create,Read";
    }else if($tryss==='["2","3","5"]') {
        echo "Dashboard,Create,Read";
    }else if($tryss==='["1","2","4"]') {
        echo "Dashboard,Create,Read";
    }else if($tryss==='["1","2","5"]') {
        echo "Dashboard,Create,Read";
    }else if($tryss==='["2","4","5"]') {
        echo "Dashboard,Create,Read";
    }else if($tryss==='["1","4","5"]') {
        echo "Dashboard,Create,Read";
    }else
        if($tryss==='["3","4","5"]') {
        echo "Dashboard,Create,Read";
    }
    else if($tryss==='["1","2"]') {
        echo "Dashboard,Create";
    }else if($tryss==='["1","3"]') {
        echo "Dashboard,Read";
    }else if($tryss==='["1","4"]') {
        echo "Dashboard,Update";
    }else if($tryss==='["1","5"]') {
        echo "Dashboard,Delete";
    }else if($tryss==='["2","3"]') {
        echo "Create,Read";
    }else if($tryss==='["2","4"]') {
        echo "Create,Update";
    }else if($tryss==='["2","5"]') {
        echo "Create,Delete";
    }

    else if($tryss==='["3","4"]') {
        echo "Read,Update";
    } else if($tryss==='["3","5"]') {
        echo "Read,Delete";
    }else if($tryss==='["4","5"]') {
        echo "Update,Delete";
    }



    else if($tryss==='["1"]') {
        echo "Dashboard";
    }else if($tryss==='["2"]') {
        echo "Create";
    }else if($tryss==='["3"]') {
        echo "Read";
    }else if($tryss==='["4"]') {
        echo "Update";
    }else if($tryss==='["5"]') {
        echo "Delete";
    }


    $isAdministrator=Auth::user()->role->isAdministrator($permissions);

    $isUser=Auth::user()->role->isUser($permissions);
    //echo $isUser;

   // echo $isAdministrator;


    //return $permissions;
});


Route::group(['middleware'=>'Admin'],function(){

    Route::get('/admin',function(){
        return view('admin.index');
    });

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

