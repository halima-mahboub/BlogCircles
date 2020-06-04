@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card card-header">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class=" card-header"> {{(isset($tag))?"Update Tag":"Add new Tag"}} </div>
        <div class="card-body">
            <form action="{{isset($tag)?route('tags.update',$tag):route('tags.store')}}" method="Post">
                @csrf
                @if(isset($tag))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="tag"> tag name </label>
                    <input type="text" class="form-group form-control"   @if(isset($tag)) value="{{$tag->name}}"@endif placeholder="add your tag " name="name">
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-success" value='{{(isset($tag))?"Update":"Add"}}'>
                </div>
            </form>
        </div>
    </div>
@endsection
