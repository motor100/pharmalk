@section('title', 'Главная')

@extends('layouts.main')

@section('content')

<div class="home-page">
  
  <div class="page-title-wrapper">
    <div class="page-title">Главная</div>
    @include('logout-form')
  </div>

</div>

<script>
  const menuItem = 0;
</script>

@endsection