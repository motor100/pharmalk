@section('title', 'Добавить купон')

@extends('layouts.main')

@section('style')
  <link rel="stylesheet" href="{{ asset('/adminpanel/css/air-datepicker.css') }}">
@endsection

@section('content')

<div class="coupon-page">

  <div class="page-title-wrapper">
    <div class="page-title">{{ $coupon ? 'Обновить купон' : 'Добавить купон' }}</div>
    @include('logout-form')
  </div>

  <form class="form" action="{{ route('coupon-store') }}" method="post">
    <div class="form-group">
      <label for="description" class="form-label">Описание</label>
      <textarea name="description" id="description" class="form-control textarea">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
      <label for="amount" class="form-label">Величина</label>
      <input type="number" name="amount" id="amount" class="form-control input-number" required min="1" max="100" value="{{ old('amount') }}">
    </div>
    <div class="form-group">
      <label for="stop_date" class="form-label">Дата окончания</label>
      <input type="text" name="stop_date" id="stop_date" class="form-control datepicker" value="{{ old('stop_date') }}">
    </div>
    @csrf
    <button class="primary-btn submit-btn">{{ $coupon ? 'Обновить купон' : 'Добавить купон' }}</button>
  </form>

</div>

<script>
  const menuItem = 2;
</script>

@endsection

@section('script')
  <script src="{{ asset('/adminpanel/js/air-datepicker.js') }}"></script>
@endsection