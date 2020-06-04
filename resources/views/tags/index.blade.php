@extends('layouts.app')
@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="clearfix">
        <a href="{{route('tags.create')}}" class="btn btn-success float-right  " style="margin-bottom: 10px"> add Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header"> All Tags</div>
        <div class="card-body">
        @if($tags->count()>0)
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
                @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td><a href="{{route('tags.edit',$tag)}}" class="btn btn-warning"> Edit </a> </td>
                    <td>
                        <form action="{{ route('tags.destroy', $tag)}}" method="post">
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
            <h1>No Tags Yet.</h1>
        @endif
        </div>
    </div>
@endsection
