@extends('files.master')

@section('page')
<form action="" method="post">
  @csrf
  <div class="col-lg-6 mx-auto">
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
      <label for="exampleInputName">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
</div>
</form>
@endsection