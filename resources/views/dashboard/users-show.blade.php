@extends('dashboard.layout')

@section('title', 'Пользователь')

@section('dashboardcontent')

<div class="dashboard-content">

  <p>Имя: {{ $user->name }}</p>
  <p>Email: {{ $user->email }}</p>
  <p>Роль: {{ $user->role->name_cyr }}</p>
  <p>Зарегистрирован: {{ $user->created_at->format('d.m.Y H:i') }}</p>
  @if($user->last_login_at)
    <p>Последний вход: {{ $user->last_login_at->format('d.m.Y H:i') }}</p>
  @endif
  @if($user->last_login_at)
    <p>IP: {{ $user->last_login_ip }}</p>
  @endif

</div>

<script>
  const menuItem = 8;
</script>

@endsection