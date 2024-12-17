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

  <form class="form" action="{{ route('users-store') }}" method="post">
    <div class="form-group mb-3">
      <label for="name" class="form-label">Имя</label>
      <input type="text" class="form-control" name="name" id="name" minlength="3" maxlength="20" required value="{{ old('name') }}">
    </div>
    <div class="form-group mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" minlength="3" maxlength="40" required value="{{ old('email') }}">
    </div>
    <div class="form-group mb-3">
      <label for="role_id" class="form-label">Роль</label>
      <select name="role_id" id="role_id" class="form-select d-block">
        @foreach($roles as $role)
          <option value="{{ $role->id }}">{{ $role->name_cyr }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group mb-3">
      <label for="password" class="form-label">Пароль</label>
      <input type="text" class="form-control" name="password" id="password" minlength="8" maxlength="20" required autocomplete="off">
    </div>
    <div class="form-group mb-5">
      <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
      <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" minlength="8" maxlength="20" required autocomplete="off">
    </div>

    @csrf
    <button type="submit" class="btn btn-primary">Добавить</button>
  </form>

</div>

<script>
  const menuItem = 8;
</script>

@endsection