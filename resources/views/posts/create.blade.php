@extends('layouts.app')

@section('content')
    <form method="post" action="{{route('posts.store')}}" >
        @csrf
        <div class="form-group"  >
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Description</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlTextarea1">Post creator</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <x-button type="submit" class="btn btn-primary">create</x-button>
        </div>
    </form>

@endsection
