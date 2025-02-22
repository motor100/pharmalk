@section('title', 'Уведомления')

@extends('layouts.main')

@section('content')

<div class="notifications-page">

  <div class="page-title-wrapper">
    <div class="page-title">Уведомления</div>
    @include('logout-form')
  </div>

</div>

<script>
  const menuItem = 4;
</script>

@endsection