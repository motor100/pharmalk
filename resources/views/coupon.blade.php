@section('title', 'Купоны')

@extends('layouts.main')

@section('content')

<div class="coupon-page">

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
      <p>Сумма заказов</p>
      <p><strong><span id="orders-summ">0</span>р</strong></p>

      {{-- $coupon->discount_type --}}
    </div>

    <script>
      fetch('/ajax/orders-summ-calc?coupon={{ $coupon->post_title }}', {
        method: 'GET',
        cache: 'no-cache',
      })
      .then((response) => response.text())
      .then((text) => {
        const ordersSumm = document.getElementById('orders-summ');
        ordersSumm.innerText = text;
      })
      .catch((error) => {
        console.log(error);
      })
    </script>
  @endif

</div>

<script>
  const menuItem = 2;
</script>

@endsection