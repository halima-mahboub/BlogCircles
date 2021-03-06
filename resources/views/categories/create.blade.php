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
        <div class=" card-header"> {{(isset($category))?"Update Category":"Add new Category"}} </div>
        <div class="card-body">
            <form action="{{isset($category)?route('categories.update',$category):route('categories.store')}}" method="Post">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="category"> category name </label>
                    <input type="text" class="form-group form-control"  
                    @if(isset($category)) value="{{$category->name}}"@endif placeholder="add your category" name="name">
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-success" value='{{(isset($category))?"Update":"Add"}}'>
                </div>
            </form>
        </div>
    </div>
@endsection
