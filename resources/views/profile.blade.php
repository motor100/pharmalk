@section('title', 'Мой профиль')

@extends('layouts.main')

@section('content')

<div class="profile-page">

  <div class="page-title-wrapper">
    <div class="page-title">Главная</div>
    @include('logout-form')
  </div>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      @include('profile.partials.update-profile-information-form')

      @include('profile.partials.update-password-form')

      @include('profile.partials.delete-user-form')
    </div>
  </div>
</div>

<script>
  const menuItem = 1;
</script>

@endsection