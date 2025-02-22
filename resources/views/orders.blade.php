@section('title', 'История заказов')

@extends('layouts.main')

@section('content')

<div class="orders-page">

  <div class="page-title-wrapper">
    <div class="page-title">История заказов</div>
    @include('logout-form')
  </div>

</div>

<script>
  const menuItem = 2;
</script>

@endsection