<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'posted_by' => 'Ahmed',
                'created_at' =>'2022-08-01 10:00:00'
            ],
            [
                'id' => 2,
                'title' => 'PHP',
                'posted_by' => 'Mohamed',
                'created_at' =>'2022-08-01 10:00:00'
            ],
            [
                'id' => 3,
                'title' => 'JAVASCRIPT',
                'posted_by' => 'Aly',
                'created_at' =>'2022-08-01 10:00:00'
            ]
        ];
        return view('posts.index', ['posts' => $allPosts ]);

    }

    public function show($id){
        // dd($id);
        $post = [
            'id' => 3,
            'title' => 'JAVASCRIPT',
            'posted_by' => 'Aly',
            'created_at' =>'2022-08-01 10:00:00',
            'description' => 'lorem'
        ];

        return view('posts.show', ['post'=> $post]);
    }

    public function store(Request $request){
            return redirect()->route('posts.index');
    }

    public function create(){
        return view('posts.create');
    }

    public function edit($id){
        return view('posts.edit');
    }
}
