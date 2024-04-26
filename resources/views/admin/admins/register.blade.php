@extends('layouts.admin')

@section('title', 'Admin:register')

@section('content')
<form method="POST" action="{{ route('admin.register.submit') }}">
  @csrf
  <div>
      <label for="name">Name:</label>
      <input type="text" name="name" required>
  </div>
  <div>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
  </div>
  <div>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
  </div>
  <div>
      <label for="password_confirmation">Confirm Password:</label>
      <input type="password" name="password_confirmation" required>
  </div>
  <div>
      <button type="submit">Register</button>
  </div>
</form>
@endsection