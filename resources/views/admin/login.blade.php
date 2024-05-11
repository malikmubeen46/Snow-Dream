@extends('files.master')

@section('page')
<form action="" method="post">
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
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Login</button>
  </div>
</form>
@endsection