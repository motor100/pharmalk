@extends('dashboard.layout')

@section('title', 'Редактировать подкатегорию')

@section('dashboardcontent')

<div class="dashboard-content">
    
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form" action="{{ route('admin.subcategories-update', $subcategory->id) }}" method="post" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <label for="title" class="label-text">Название</label>
      <input type="text" class="form-control" name="title" id="title" maxlength="200" required readonly value="{{ $subcategory->title }}">
    </div>

    <div class="form-group mb-3">
      <div class="image-preview">
        @if($subcategory->image)
          @if($subcategory->image->image)
            <img src="{{ Storage::url($subcategory->image->image) }}" alt="">
          @else
            <img src="/img/no-photo.svg" alt="">
          @endif
        @else
          <img src="/img/no-photo.svg" alt="">
        @endif
      </div>
    </div>

    <div class="form-group mb-5">
      <div class="label-text">Изображение</div>
      <input type="file" name="input-main-file" id="input-main-file" class="inputfile" accept="image/jpeg,image/png">
      <label for="input-main-file" class="custom-inputfile-label">Выберите файл</label>
      <span class="namefile main-file-text">Файл не выбран</span>
    </div>

    @csrf
    <button type="submit" class="btn btn-primary">Обновить</button>
  </form>

</div>

<script>
  const menuItem = 4;
</script>

@endsection