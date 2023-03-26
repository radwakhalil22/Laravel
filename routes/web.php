<?php

use App\Http\Controllers\AllPostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Http;
use  Laravel\Socialite\Two\AbstractProvider\stateless;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>['auth']], function(){

    Route::get('/posts',[PostsController::class,'index'])->name('posts.index');

    Route::get('posts/create', [PostsController::class, 'create'])->name('posts.create');

    Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');

    Route::group(['middleware'=>['XSS']], function(){

        Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

        Route::put('/posts/{post}/edit',[PostsController::class, 'update'])->name('posts.update');

    });

    Route::get('/posts/{post}/edit',[PostsController::class,'edit'])->name('posts.edit');


    Route::delete('/posts/{id}', [PostsController::class, 'delete'])->name('posts.delete');

    Route::get('/posts/restore/{id}', [PostsController::class, 'restore'])->name('posts.restore');

    Route::post('/posts/{id}',[CommentController::class,'addcomment'])->name('comment.addcomment');

    Route::delete('/posts/{id}/{cID}',[CommentController::class, 'deleteComment'])->name('comment.deleteComment');

    Route::get('/deleteOld',[PostsController::class, 'deleteOldPost'])->name('posts.deleteOldPost');
});


// Route::resource('posts', PostsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();
    // dd($githubUser);

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
        'password' => encrypt('gitpwd059'),
    ]);
    Auth::login($user);
    return redirect()->route('posts.index');

    // dd($user);

    // $user->token
});

Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
});


Route::get('/login/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    // dd($googleUser);

    $user = User::updateOrCreate([

        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
        'password' => encrypt('googpwd059'),
    ]);

    Auth::login($user);
    return redirect()->route('posts.index');
});


// Http::get('https://api.github.com.issues',[
//     'Authorization' => 'Bearer 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 '
// ]);

