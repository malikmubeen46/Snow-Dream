@extends('files.master')

@section('page')
<form action="" method="post" enctype="multipart/form-data">
  @csrf
  <div class="col-lg-6 mx-auto">
    @if(Session::get('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
    </div>
    @endif
    @if(Session::get('error'))
    <div class="alert alert-danger">
      {{ Session::get('error') }}
    </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <h2>Update Profile</h2>
    <div class="form-group">
      <label for="exampleInputName">Name</label>
      <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" id="exampleInputName" placeholder="Enter name" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" value="" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="file" name="file" class="form-control" id="file">
    </div>
    <div class="col-12 mb-3">
      <img src="{{ asset('uploads/'.auth()->user()->image) }}" alt="image" width="150px" height="150px">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection