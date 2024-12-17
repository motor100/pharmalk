@extends('dashboard.layout')

@section('title', 'Пользователь')

@section('dashboardcontent')

<div class="dashboard-content">

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form mb-5" action="{{ route('users-update') }}" method="post">
    <div class="form-group mb-3">
      <label for="name" class="form-label">Имя</label>
      <input type="text" class="form-control" name="name" id="name" minlength="3" maxlength="20" required value="{{ $user->name }}">
    </div>
    <div class="form-group mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" minlength="3" maxlength="40" required value="{{ $user->email }}">
    </div>
    <div class="form-group mb-3">
      <label for="role_id" class="form-label">Роль</label>
      <select name="role_id" id="role_id" class="form-select d-block">
        @foreach($roles as $role)
          <option value="{{ $role->id }}" {{ $role->id == $user->roles[0]->id ? "selected" : "" }}>{{ $role->name_cyr }}</option>
        @endforeach
      </select>
    </div>
    <input type="hidden" name="id" value="{{ $user->id }}">

    @csrf
    <button type="submit" class="btn btn-primary">Обновить</button>
  </form>

  <form class="form" action="{{ route('users-password') }}" method="post">  
    <div class="form-group mb-3">
      <label for="password">Пароль</label>
      <input type="text" class="form-control" name="password" id="password" minlength="8" maxlength="20" autocomplete="off">
    </div>
    <div class="form-group mb-3">
      <label for="password_confirmation">Подтверждение пароля</label>
      <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" minlength="8" maxlength="20" autocomplete="off">
    </div>
    <input type="hidden" name="id" value="{{ $user->id }}">

    @csrf
    <button type="submit" class="btn btn-primary">Обновить</button>
  </form>

</div>

<script>
  const menuItem = 8;
</script>

@endsection