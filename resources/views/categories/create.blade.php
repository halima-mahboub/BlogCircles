@extends('layouts.app')

@section('content')


<div class="card card-default">
<div class="card-header"> Add New Category </div>
   <div class="card-body">
    <form action="#">
     @csrf
     <div class="form-group">
     <label for="category">Category Name:</label>
     <input type="text" class="form-control" placeholder="Add New Category">
   </div>
   <div class="form-group">
     <a href="#" class="btn btn-success">Add</a>
   </div>



</div>


@endsection