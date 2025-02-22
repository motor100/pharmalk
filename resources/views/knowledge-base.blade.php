@section('title', 'База знаний')

@extends('layouts.main')

@section('content')

<div class="knowledge-base-page">

  <div class="page-title-wrapper">
    <div class="page-title">База знаний</div>
    @include('logout-form')
  </div>

  <p>Описание базы знаний</p>
  <p><a href="#">Ссылка на базу знаний</a></p>

</div>

<script>
  const menuItem = 5;
</script>

@endsection