@extends('layouts.app')

@section('content')
<form action="/auth/facebook/register" method="post">
  {{csrf_field()}}

  <div class="card">
    <div class="card-block">
      <img src="{{$user->avatar}}" alt="" class="img-thumbnail">
    </div>
    <div class="card-block">
      <div class="form-group">
        <lavel for="name" class="form-control-label">
          Nombre
        </lavel>
        <input type="text" name="name" value="{{$user->name}}" readonly>
      </div>
      <div class="form-group">
        <lavel for="email" class="form-control-label">
          Email
        </lavel>
        <input type="text" name="email" value="{{$user->email}}" readonly>
      </div>

      <div class="form-group">
        <lavel for="username" class="form-control-label">
          Nombre de usuario
        </lavel>
        <input type="text" name="username" value="{{old('username')}}">
      </div>
    </div>

    <div class="card-footer">
      <button class="btn btn-primary" type="submit">Registrarse</button>
    </div>

  </div>
</form>
@endsection