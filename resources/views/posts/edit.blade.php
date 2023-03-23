@extends('layouts.app')

@section('title') Edit Post @endsection

@section('content')
<form method="post" action="{{route('posts.update', $post)}}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="form-group"  >
      <label for="exampleFormControlInput1">Title</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="title" value="{{$post['title']}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Description</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="description" value="{{$post['description']}}">
      </div>


    <div class="form-group">
      <label for="exampleFormControlTextarea1">Post creator</label>
            <select class="form-control" name="user_id">
            <option value="{{$post->user->id}}">Select user</option>
            <option value="{{$post->user->id}}">{{$post->user->name}}</option>
            </select>
    </div>
    <div class="form-group">
            <input type="file" name="image" id="fileToUpload">
            <x-button type="submit" class="btn btn-primary">Edit</x-button>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>

                @endforeach
            </ul>
            </div>
        @endif


  </form>


@endsection
