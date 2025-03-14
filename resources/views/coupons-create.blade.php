@section('title', 'Добавить купон')

@extends('layouts.main')

@section('style')
  <link rel="stylesheet" href="{{ asset('/adminpanel/css/air-datepicker.css') }}">
@endsection

@section('content')

<div class="coupons-page">

  <div class="page-title-wrapper">
    <div class="page-title">Добавить купон</div>
    @include('logout-form')
  </div>

  <form class="form" action="{{ route('coupons-store') }}" method="post">
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
      <input type="text" name="stop_date" id="stop_date" class="form-control datepicker" required value="{{ old('stop_date') }}">
    </div>
    @csrf
    <button class="primary-btn submit-btn">Добавить</button>
  </form>

  <style>
    .form-label {
      display: block;
    }
    .form-control {
      display: block;
      width: 100%;
      height: 30px;
      padding: 5px 10px;
      border: 1px solid #000;
      border-radius: 5px;
      font-family: inherit;
    }
    .input-number {
      -webkit-appearance: textfield;
      -moz-appearance: textfield;
      appearance: textfield;
    }
    .input-number::-webkit-inner-spin-button,
    .input-number::-webkit-outer-spin-button {
      margin: 0;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }
    .textarea {
      height: 70px;
      resize: none;
    }
    .submit-btn {
      margin: 30px 0;
    }
  </style>

</div>

<script>
  const menuItem = 3;
</script>

@endsection

@section('script')
  <script src="{{ asset('/adminpanel/js/air-datepicker.js') }}"></script>
@endsection