@extends('dashboard.layout')

@section('title', 'Слайдер')

@section('dashboardcontent')

<div class="dashboard-content">

  @if($errors->any())
    <div class="alert alert-danger cart-errors">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form" action="{{ route('admin.main-slider-store') }}" enctype="multipart/form-data" method="post">

    <div class="form-group mb-3">
      <label for="title" class="form-check-label mb-1">Заголовок</label>
      <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group mb-3">
      <label for="link" class="form-check-label mb-1">Ссылка на товар</label>
      <input type="text" name="link" id="link" class="form-control" required>
    </div>
    <div class="form-group mb-5">
      <div class="label-text mb-1">Изображение</div>
      <input type="file" name="input-main-file" id="input-main-file" class="inputfile" required accept="image/jpeg,image/png">
      <label for="input-main-file" class="custom-inputfile-label">Выберите файл</label>
      <span class="namefile main-file-text">Файл не выбран</span>
    </div>

    @csrf
    <button type="submit" class="btn btn-primary">Добавить</button>

  </form>

</div>

<script>
  const menuItem = 2;
</script>

@endsection