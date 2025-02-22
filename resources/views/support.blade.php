@section('title', 'Поддержка')

@extends('layouts.main')

@section('content')

<div class="support-page">

  <div class="page-title-wrapper">
    <div class="page-title">Поддержка</div>
    @include('logout-form')
  </div>

  <p>Поддержка</p>
  <p>Описание поддержки</p>
  <p>Телефон: +7 (495) 927-4-928</p>
  <p>Whatsapp: +7 (495) 927-4-928</p>
  <p>Почта: info@naturapharma.ru</p>

</div>

<script>
  const menuItem = 6;
</script>

@endsection