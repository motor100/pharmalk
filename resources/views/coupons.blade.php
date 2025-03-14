@section('title', 'Купоны')

@extends('layouts.main')

@section('content')

<div class="coupons-page">

  <div class="page-title-wrapper">
    <div class="page-title">Купоны</div>
    @include('logout-form')
  </div>

  <a href="/coupons/create" class="coupon-create-btn primary-btn">Добавить купон</a>

  <table class="table">
    <thead>
      <tr>
        <th>Код</th>
        <th>Тип купона</th>
        <th>Величина</th>
        <th>Описание</th>
        <th>Использовано/Лимит</th>
        <th>Срок действия</th>
      </tr>
    </thead>
    <tbody>
      @foreach($coupons as $coupon)
      <tr>
        <td>{{ $coupon->post_title }}</td>
        <td>{{ $coupon->discount_type }}</td>
        <td>{{ $coupon->coupon_amount }}</td>
        <td>{{ $coupon->post_excerpt }}</td>
        <td>{{ isset($coupon->usage_count) ? $coupon->usage_count : 0 }}/{{ $coupon->usage_limit == 0 ? '-' : $coupon->usage_limit }}</td>
        <td>{{ DateTime::createFromFormat('Y-m-d', $coupon->expiry_date)->format('d.m.Y')  }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <style>
    .table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 5px;
      border: 1px solid #000;
      text-align: left;
    }
    .coupon-create-btn {
      margin: 0 0 30px 0;
    }
  </style>

</div>

<script>
  const menuItem = 3;
</script>

@endsection