@extends('files.master')

@section('page')
  <div class="col-lg-6 mx-auto">
    @if(Session::get('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
    </div>
    @endif
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Action</th>
      </tr>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->password }}</td>
          <td>
            <button class="btn btn-primary"><a href="{{ url('user/'.$user->id) }}" class="text-white">Edit</a></button>
            <buttom class="btn btn-danger"><a href="{{ url('delete-user/'.$user->id) }}" class="text-white">Delete</a></buttom>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@endsection