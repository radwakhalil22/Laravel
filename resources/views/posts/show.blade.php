@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">post creator</h5>
            <p class="card-text">{{$post->user->name}}</p>
            <h5 class="card-title">email</h5>
            <p class="card-text">{{$post->user->email}}</p>
        </div>
    </div>

    <!-- comment -->
    <form method="POST" action="{{route('comment.addcomment', [$post->id])}}">
        @csrf
        <div class="card mt-5">
            <div class="card-header">
                Comment
            </div>
            <div class="card-body ">
            <input type="text" class="form-control" name="body">
            </form>
            </div>
            <button class="btn btn-dark">Add comment</button>
            @if(isset($post->comments))
            @foreach($post->comments as $com)
            <div class="card-body">
                <h5 class="card-title">post creator</h5>
                <h5 class="card-title">created at</h5>
                <p class="card-text">{{$com->created_at}}</p>
                <h5 class="card-title">created at</h5>
                <p class="card-text">{{$com->body}}</p>
                <form method="POST"  action="{{route('comment.deleteComment', [$post->id, $com->id])}}">
                    @method('delete')
                    @csrf
                    <button class="btn btn-dark">Delete</button>
                </form>
            </div>
            @endforeach

            @else

            <p class="mt-5 text-center"> No comment found</p>
            @endif
        </div>

@endsection
