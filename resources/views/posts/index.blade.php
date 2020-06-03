@extends('layouts.app')
@section('title','All Posts')
@section('content')
<div class="clearfix">
<a href="{{route('posts.create')}}"  class="btn float-right btn-success" style="margin-bottom:10px" > Add Post</a>
</div>
<div class="card card-default">
<div class="card-header"> All Posts</div>
    @if(session()->has('success'))
                        <div class="alert alert-success">
                        {{session()->get('success')}}
                        </div>

    @endif
    @if($posts->count()>0)
        <table class="card-body">

            <table class="table" >
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titel</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                            <img src="{{asset('storage/'.$post->image)}}" alt="" width='100px' heigth='50px'>
                                
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                <form action="{{route('posts.destroy',$post)}}" class="float-right ml-2" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        {{($post->trashed())?"Delete":"Trashed"}}
                                    </button>
                                </form>
                                @if(!$post->trashed())
                                <a href="{{route('posts.edit',$post)}}" class="btn btn-info btn-sm float-right ml-2" >Edit</a>
                                @else
                                <a href="{{route('trashed.restore',$post)}}" class="btn btn-info btn-sm float-right ml-2" >Restore</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        </table>
    @else
        <div class="card-body">
            <h1 class='text-center'>
                No Posts Yet.
            </h1>
        </div>
    @endif
    {{ $posts->links() }}


</div>
@endsection