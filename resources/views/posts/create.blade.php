@extends('layouts.app')

@section('content')
    <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group"  >
        <label for="exampleFormControlInput1">Title</label>
        <input type="text"name="title" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Description</label>
            <input type="text" name="description" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlTextarea1">Post creator</label>
        <select class="form-control" name="user_id">
            <option value="">Select user</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        </div>
        <input type="file" name="image" id="fileToUpload">
        <div class="form-group">
            <x-button type="submit" class="btn btn-primary">create</x-button>
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
        Select image to upload:

    </form>

@endsection
