<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//
///*
//|--------------------------------------------------------------------------
//| RAW Queries
//|--------------------------------------------------------------------------
//*/
//// Route::get('/read', function () {
////     $results = DB::select('select * from posts where id=?',[1]);
//
////     return $posts;
//// });
//
//Route::get('/insertPost', function () {
//    $results = DB::insert(
//        'insert into posts(title, content, user_id)
//                           values(?,?,?)',
//        [
//            "Mijailović osuo paljbu po Zvezdi",
//            "Za Obradovića su ljudi",
//            "1"
//        ]
//    );
//
//    return $results;
//});
//
///*
//|--------------------------------------------------------------------------
//| Eloquent ORM
//|--------------------------------------------------------------------------
//*/
//// Route::get('/read', function () {
////     $posts = Post::find(5);
//
////     return $posts;
//// });
///*
//|--------------------------------------------------------------------------
//|
//|--------------------------------------------------------------------------
//*/
//// Route::get('/findwhere', function () {
//
////     $posts = Post::where('id', 6)
////         ->orderBy('id', 'desc')
////         ->take(1)
////         ->get();
//
////     return $posts;
//// });
//Route::get('/insertbasic', function () {
//
//    $post = new Post;
//
//    $post->title = 'Some title 2...';
//    $post->content = 'Some content 2...';
//    $post->user_id = '1';
//
//    $post->save();
//});
//
////? Moze da posluzi kao azuriranje
//Route::get('/insertbasic2', function () {
//
//    $post = Post::find(8);
//
//    $post->title = 'Some title 2222...';
//    $post->content = 'Some content 2222...';
//
//    $post->save();
//});
//
//Route::get('/create', function () {
//
//    Post::create([
//        'title' => 'the create method',
//        'content' => 'WOW I\'am learning Laravel',
//        'user_id' => '1',
//    ]);
//});
//
////? Update
//Route::get('/update', function () {
//
//    Post::where('id', 9)->where('user_id', 1)->update([
//        'title' => 'the update method',
//        'content' => 'WOW I\'am learning Laravel',
//    ]);
//});
//
//
//Route::get('/delete', function () {
//
//    $post = Post::find(8);
//    $post->delete();
//});
//
//Route::get('/delete2', function () {
//
//    Post::destroy(7);
//});
//
//Route::get('/delete3', function () {
//
//    Post::destroy([5, 10]);
//});
//
//Route::get('/delete4', function () {
//
//    Post::where('id', 9)->delete();
//});
//
//// Soft delete
////? U Post modelu smo podesili da svako brisanje pod delete() f-jom bude soft delete
//Route::get('/softdelete', function () {
//
//    Post::find(1)->delete();
//});
//
////? Daj mi sve postove ukljucujuci i izbrisane
//Route::get('/findsoftdelete', function () {
//
//    $res = Post::withTrashed()->get();
//
//    return $res;
//});
//
////? Daj mi post id=1 bez obzira je li izbrisan
//Route::get('/findsoftdelete2', function () {
//
//    $res = Post::withTrashed()->where('id', 1)->get();
//
//    return $res;
//});
//
////? Daj mi sve izbrisane postove
//Route::get('/readsoftdelete', function () {
//
//    $res = Post::onlyTrashed()->get();
//    return $res;
//});
//
//
//Route::get('/restoreall', function () {
//
//    $res = Post::onlyTrashed()->restore();
//
//    return $res;
//});
//
//Route::get('/restoresingle', function () {
//
//    $res = Post::where('id', 1)->restore();
//
//    return $res;
//});
//
//Route::get('/forcedelete', function () {
//
//    $res = Post::onlyTrashed()->forceDelete();
//
//    return $res;
//});
//
///*
//|--------------------------------------------------------------------------
//| ELOQUENT Relationships
//|--------------------------------------------------------------------------
//*/
//
//Route::get('/user/{id}', function ($id) {
//
//    $roles = User::findOrFail($id);
//
//    return $roles;
//});
//
////? Single post of user id=?, that column is user_id in posts
//// Route::get('/user/{id}/post', function ($id) {
//
////     return User::findOrFail($id)->post;
//// });
//
//
//// //? Many posts of user id=?
//// Route::get('/user/{id}/posts', function ($id) {
//
////     return User::findOrFail($id)->posts;
//// });
//
//
//// Route::get('/post/{id}/user', function ($id) {
//
////     return Post::findOrFail($id)->author;
//// });
//
//
//Route::get('/user/{id}/roles', function ($id) {
//
//    return $roles = User::findOrFail($id)->roles;
//
////    foreach ($roles as $role) {
////        return $role->name;
////    }
//});
//
//
////? Ovdje smo pristupili onoj pivot tabeli role_user u formatu user_id i role_id
//Route::get('/user/{id}/pivot', function ($id) {
//
//    $user = User::findOrFail($id);
//
//    foreach ($user->roles as $role) {
//        return $role->pivot->role_id;
//    }
//});
//
////? Ovdje smo takodje pristupili onoj pivot tabeli role_user koja nam je iznijela sve podatke
////? Daj mi sve korisnike sa rolom id=?
//Route::get('/role/{id}/users', function ($id) {
//
//    return Role::findOrFail($id)->users; //()->orderBy('id', 'desc');
//});
//
//
//Route::get('/user/{id}/country', function ($id) {
//
//    return User::findOrFail($id)->country;
//});
//
//
//Route::get('/country/{id}/users', function ($id) {
//
//    return Country::findOrFail($id)->users;
//});
//
//
//Route::get('/country/{id}/posts', function ($id) {
//
//    return Country::findOrFail($id)->posts;
//});
//
//
////* Polymorphic Relations
///**
// * Svrha ovog tipa funkcija je da se mogu izbjeci strani kljucevi poput user_id na post i sl.
// * U ovom slucaju imageable_id(imageable) mora da ima isti id kao id od korisnika
// * Pod uslovom da je to imageable_type jednak njegovom modelu, u ovom slucaj App\User
// */
//Route::get('/user/{id}/photos', function ($id) {
//
//    return User::findOrFail($id)->photos;
//});
//
//// daj mi sliku za zeljenog(id) korisnika
//Route::get('/user/{id}/photo', function ($id) {
//
//    return User::findOrFail($id)->photo;
//});
//
////? Post moze da ima vise slika; imageable_id-a ima vise pod istim brojem,
////? pa ce se i u skladu sa tim i prikazivati vise slika
//Route::get('/post/{id}/photos', function ($id) {
//
//    return Post::findOrFail($id)->photos;
//});
//
////? Daj mi vlasnika slike (post, user...)
//Route::get('/photo/{id}/post', function ($id) {
//
//    return Photo::findOrFail($id)->imageable;
//});
//
//
//Route::get('/tag/{id}/posts', function ($id) {
//
//    return Tag::findOrFail($id)->posts;
//});
//
//Route::get('/post/{id}/tags', function ($id) {
//
//    return Post::findOrFail($id)->tags;
//});
//
//
//Route::get('/address/{id}/users', function ($id) {
//
//    return Address::findOrFail($id)->users;
//});
//
//
//Route::get('/user/{id}/address', function ($id) {
//
//    return User::findOrFail($id)->address;
//});
//
//
//Route::get('/user/{id}/attach/role', function ($id) {
//
//    $user = User::find($id);
//
//    $user->roles()->attach([6, 5]);
//});
//
//Route::get('/user/{id}/sync/role', function ($id) {
//
//    $user = User::find($id);
//
//    $user->roles()->sync([1, 3]);
//});
//
//
//// Staff. Kreiramo sliku useru id=?
Route::get('/user/{id}/createphoto', function ($id) {

    $user = User::find($id);

    $user->photos()->update(['path' => 'default.jpg']);
});
//
//
Route::get('/user/{id}/getphoto', function ($id) {

    $userPhotos = User::findOrFail($id)->photos;

    foreach ($userPhotos as $photo) {
        echo $photo->path;
    }
});

Route::get('/user/{id}/getsinglephoto', function ($id) {

    return User::findOrFail($id)->photo->path;

});
//
//
//Route::get('/staff/{id}/updatephoto', function ($id) {
//
//    $staff = Staff::find($id);
//    $staff->photos()->update(['path' => 'update_new.jpg']);
//    $staff->save();
//});
//
//
//Route::get('/staff/{id}/deletephotos', function ($id) {
//
//    $staff = Staff::find($id);
//    $staff->photos()->delete();
//});
//
//// Brisanje samo jedne slike jednog staffa(id=1)
//Route::get('/staff/{id}/photo/{photo_id}/deletephoto', function ($id, $photo_id) {
//
//    $staff = Staff::findOrFail($id);
//
//    $staff->photos()
//        ->whereId($photo_id)
//        ->delete();
//});
//
//// Dodjeljujemo staffu id=1 sliku id=3
//// ili: Dodjeljujemo slici id=3 vlasnika(citaj: staffa) id=1
//Route::get('/staff/{staff_id}/assign/photo/{photo_id}', function ($staff_id, $photo_id) {
//
//    $staff = Staff::find($staff_id);
//    $photo = Photo::find($photo_id);
//
//    $staff->photos()->save($photo);
//});
//
//
//// Comments by the post
//Route::get('/post/{id}/comments', function ($id) {
//
//    return Post::findOrFail($id)->comments;
//});
//
//// Comments by the video
//Route::get('/video/{id}/comments', function ($id) {
//
//    return Video::findOrFail($id)->comments;
//});
//
//
//// Tags by the video
//Route::get('/video/{id}/tags', function ($id) {
//
//    return Video::findOrFail($id)->tags;
//});
//
//// Videos by the tag
//Route::get('/tag/{id}/videos', function ($id) {
//
//    return Tag::findOrFail($id)->videos;
//});
//
//
//// Create post(with tag), video
//Route::get('/create/post/i/video/tag/{id}', function ($id) {
//
//    $post = Post::create(['title' => 'My second post', 'content' => 'My second content', 'user_id' => 2]);
//
//    $tag1 = Tag::find($id);
//    $post->tags()->save($tag1);
//
//
//    $video = Video::create(['name' => 'My first video']);
//    $tag2 = Tag::find(3);
//
//    $video->tags()->save($tag2);
//});
//
//Route::get('/updateposttag/{id}', function ($id) {
//
//    $post = Post::findOrFail($id);
//
//    $post->tags()->whereName('updated sport')->update(['name' => 'sport']);
//});
//
//// Pridodavanje taga za post
//Route::get('/post/{id}/assign/tag/{tag_id}', function ($id, $tag_id) {
//
//    $post = Post::findOrFail($id);
//    $tag = Tag::findOrFail($tag_id);
//
//    // $post->tags()->save($tag); //moze i ovaj da radi
//    $post->tags()->attach($tag);
//
//    // $post->tags()->sync($tag);
//});
//
//// Odredjivanje tagova za post
//Route::get('/post/{id}/assign/tag/{tag_id}', function ($id, $tag_id) {
//
//    $post = Post::findOrFail($id);
//    $tag = Tag::findOrFail($tag_id);
//
//    $post->tags()->sync($tag);
//});
//
//
///*
//|--------------------------------------------------------------
//|//todo CRUD Application
//|--------------------------------------------------------------
//*/
//
//Route::get('/users', function () {
//    $users = User::all();
//
//    foreach ($users as $user) {
//        echo $user;
//    }
//});
//
//Route::group(['middleware' => 'guest'], function () {
//
//    Route::resource('/posts', 'PostsController');
//    Route::patch('/posts/{id}/restore', 'PostsController@restore')->name('posts.restore');
//
//
//    /*
//|--------------------------------------------------------------
//|//todo CARBON datetime types
//|--------------------------------------------------------------
//*/
//    Route::get('/dates', function () {
//
//        $date = new DateTime('+1 week');
//
//        echo $date->format('d-m-Y');
//
//        echo '<br/>';
//
//        echo Carbon::now()->addDays(10)->diffForHumans();
//
//        echo '<br/>';
//
//        echo Carbon::now()->subMonths(5)->diffForHumans();
//
//        echo '<br/>';
//
//        echo Carbon::now()->yesterday()->diffForHumans();
//
//        echo '<br/>';
//
//        echo Carbon::now()->yesterday();
//    });
//
//
//    /*
//|--------------------------------------------------------------
//|//todo Accessors
//|--------------------------------------------------------------
//*/
//
//    Route::get('/getname', function () {
//
//        $user = User::find(1);
//
//        echo $user->setNameAttribute($user->name);
//    });
//
//
//    Route::get('/setname', function () {
//
//        $user = User::find(2);
//
//        $user->name = 'William';
//        $user->save();
//    });
//
//
//    // middleware za bezbjednost
//});
//
//

//
//
//// Route::group(['middleware' => ['auth', 'user']], function () {
////     //
////     //
//// });
//
////? User
//Route::group([
//    'prefix' => 'user',
//    'as' => 'user.',
//    'namespace' => 'User',
//    'middleware' => ['auth']
//], function () {
//    Route::get('/', 'HomeController@index')->name('home');
//});
//
////? Moze da pristupi samo prijavljeni administrator
////! Ovo cu iskoristiti opet u odjeljku PROJEKAT CMS
////Route::group(['middleware' => ['auth', 'admin']
////], function () {
////
////    Route::get('/admin', 'Admin\HomeController@index')->name('admin');
////});
//
////? Je li admin
//Route::get('/isadmin', function () {
//
//    $user = User::findOrFail(16);
//    return $user->isAdmin; //? isAdmin je funkcija
//
//})->name('isadmin');
//
//
//? Dozvola po ulozi(Permissions by role)
//Route::get('/roles/{id}/permissions', function ($id) {
//    $roles = \App\Role::find($id);
//    foreach ($roles->permissions as $role_permission) {
//        return $role_permission;
//    }
//});
//// * MEJL
//Route::get('/sendmail', function () {
//
//    Mail::to('sinisa.becic@outlook.com')->send(new WelcomeMail());
//    return new WelcomeMail();
//});


// * PROJEKAT CMS
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//? Admin
Route::group([
//    'prefix' => 'admin',
//    'as' => 'admin.',
    'namespace' => 'Admin', // da ne pisemo Admin\HomeController u action:
    'middleware' => ['auth', 'role:admin'],
], function () {

    Route::get('/admin', 'HomeController')->name('admin');
    //? Users
    Route::resource('/admin/users', 'UsersController')
        ->name('index', 'users')
        ->name('store', 'users.store')
        ->name('update', 'users.update')
        ->name('destroy', 'user.delete');

    Route::delete('/users/{id}/remove', 'UsersController@remove');
    Route::put('/users/{id}/restore', 'UsersController@restore');
    Route::get('/admin/users/{user}/profile', 'UsersController@profile')->name('user.profile.show');


    //? Posts
    Route::resource('/posts', 'PostsController')
        ->name('index', 'posts.index')
        ->name('store', 'posts.store')
        ->name('edit', 'posts.edit')
        ->name('update', 'posts.update')
        ->name('destroy', 'posts.destroy');
    Route::delete('/posts/{id}/remove', 'PostsController@remove');
    Route::put('/posts/{id}/restore', 'PostsController@restore');

    //? Roles
    Route::resource('/admin/roles', 'RolesController')
        ->name('index', 'roles')
        ->name('store', 'roles.store')
        ->name('update', 'roles.update')
        ->name('destroy', 'roles.delete');
    Route::delete('/admin/roles/{id}/remove', 'RolesController@remove');
    Route::put('/admin/roles/{id}/restore', 'RolesController@restore');


    //? Permissions
    Route::resource('/admin/permissions', 'PermissionsController')
        ->name('index', 'permissions')
        ->name('store', 'permissions.store')
        ->name('edit', 'permissions.edit')
        ->name('update', 'permissions.update')
        ->name('destroy', 'permissions.delete');
    Route::delete('/admin/permissions/{id}/remove', 'PermissionsController@remove');
    Route::put('/admin/permissions/{id}/restore', 'PermissionsController@restore');

    //? Tags
    Route::resource('/admin/tags', 'TagsController')
        ->name('index', 'tags')
        ->name('store', 'tags.store')
        ->name('edit', 'tags.edit')
        ->name('update', 'tags.update')
        ->name('destroy', 'tags.delete');
    Route::delete('/admin/tags/{id}/remove', 'TagsController@remove');
    Route::put('/admin/tags/{id}/restore', 'TagsController@restore');
});
