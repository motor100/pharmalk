@section('title', 'Купоны')

@extends('layouts.main')

@section('content')

<div class="coupons-page">

  <div class="page-title-wrapper">
    <div class="page-title">Купоны</div>
    @include('logout-form')
  </div>

  <a href="{{ route('coupon-create') }}" class="coupon-create-btn primary-btn">{{ $coupon ? 'Обновить купон' : 'Добавить купон' }}</a>

  @if($coupon)
    <div class="coupon-description">
      <p>Купон</p>
      <p><strong>{{ $coupon->post_title }}</strong></p>
      <p>Скидка</p>
      <p><strong>{{ $coupon->coupon_amount }}%</strong></p>
      <p>Описание</p>
      <p><strong>{{ $coupon->post_excerpt }}</strong></p>
      <p>Использовано/Лимит</p>
      <p><strong>{{ isset($coupon->usage_count) ? $coupon->usage_count : 0 }}/{{ $coupon->usage_limit == 0 ? '-' : $coupon->usage_limit }}</strong></p>
      <p>Срок действия</p>
      <p><strong>{{ DateTime::createFromFormat('Y-m-d', $coupon->expiry_date)->format('d.m.Y')  }}</strong></p>

      {{-- $coupon->discount_type --}}
    </div>
  @endif

</div>

<script>
  const menuItem = 3;
</script>

@endsection