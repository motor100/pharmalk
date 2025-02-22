@section('title', 'Купоны')

@extends('layouts.main')

@section('content')

<div class="coupons-page">

  <div class="page-title-wrapper">
    <div class="page-title">Купоны</div>
    @include('logout-form')
  </div>

</div>

<script>
  const menuItem = 3;
</script>

@endsection