@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class=" card-header"> edit Category </div>
    <div class="card-body">
        <form action="{{route('categories.update',$category->id)}}" method="post">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="category"> #id  </label>
                <input type="text" class="form-group form-control"  readonly  placeholder="add your category" name="id" value="{{$category->id}}">
            </div>
            <div class="form-group">
                <label for="category"> category name </label>
                <input type="text" class="form-group form-control"   placeholder="add your category" name="name" value="{{$category->name}}">
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-success" value="Edit">
            </div>
        </form>
    </div>
    </div>
@endsection
