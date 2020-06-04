@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="clearfix">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right  " style="margin-bottom: 10px"> add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header"> All Categories</div>
        <div class="card-body">
        @if($categories->count()>0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Action</th>
                    <th>Action </th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning"> Edit </a> </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
       @else
            <h1>No Categorys Yet.</h1>
        @endif
        </div>
    </div>
@endsection
