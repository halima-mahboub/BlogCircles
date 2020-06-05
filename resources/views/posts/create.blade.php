@extends('layouts.app')
@section('title','Post|'.'Create New Post')

@section('content')
   
    <div class="card card-default">
                    <div class="card-header ">
                        <h1>{{(isset($post))?"Update Post":"Add a new Post"}}</h1>
                    </div>
                    <div class="card-body">
                    <form action="{{(isset($post))?route('posts.update',$post):route('posts.store')}}" 
                            method="POST" enctype='multipart/form-data' > 
                      @csrf 
                        @if((isset($post)))
                            @method('PUT')
                        @endif
                    
                   
                        <div class="form-group">
                            <label for="title">Post title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" 
                            value="{{(isset($post))?$post->title: ''}} "
                            placeholder="Add a new post">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            placeholder="Add a description"
                             name="description" rows="3">{{(isset($post))?$post->description: ''}} </textarea>
                        </div>
                        <div class="form-group">
                            <input id="x" type="hidden" name="content"value="{{(isset($post))?$post->content: ''}}">
                            <trix-editor input="x"></trix-editor>
    
                        </div>
                        <div class="form-group">
                        <label for="selectCategory">Category</label>
                        <select name="categoryId" id="selectCategory" class="form-control @error('category') is-invalid @enderror">
                            <option >Add Category</option>
                            @foreach($categories as $category)
                                <option  value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    @if($tags->count()>0)
                        <div class="form-group">
                        <label for="selectTag">Tags</label>
                        <select name="tagId[]" id="selectTag" multiple class="form-control @error('tag') is-invalid @enderror">
                           @foreach($tags as $tag)
                                <option  value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    @endif
                        @if(isset($post))
                            <div class="form-group">
                            <img src="{{asset('storage/'.$post->image)}}" alt="" width='100%' >
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="image">Post image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                        </div>
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
@enderror

                        <div class="form-group text-center ">
                            <button type="submit" class="btn btn-success" width="50%">
                              {{(isset($post))?"Update":"Add"}}
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            
@endsection
@section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
@endsection
@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
@endsection
