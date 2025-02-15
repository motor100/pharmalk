@section('title', 'Личный кабинет')

@extends('layouts.main')

@section('content')

<p>Главная</p>

<form class="form" action="{{ route('logout') }}" method="POST">
  @csrf
  <button class="logout-btn">Выйти</button>
</form>

<script>
  const menuItem = 0;
</script>

@endsection