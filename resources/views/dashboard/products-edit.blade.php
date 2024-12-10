@extends('dashboard.layout')

@section('title', 'Редактировать товар')

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

  <form class="form" id="save-data-form" action="{{ route('admin.products-update', $product->id) }}" method="post" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <label for="title" class="label-text">Название</label>
      <input type="text" class="form-control" name="title" id="title" maxlength="200" required readonly value="{{ $product->title }}">
    </div>
    <div class="form-group mb-3">
      <label for="text">Описание</label>
      @if($product->content)
        @if($product->content->text_json == NULL && $product->content->text_html)
          <textarea class="form-control" name="text" id="text">{{ $product->content->text_html }}</textarea>
        @else

          @if($product->content->text_json)
            <div id="input" class="hidden">{{ $product->content->text_json }}</div>
          @endif

          <div id="editorjs"></div>
          <input type="hidden" name="save-data" id="save-data-input" value="">
        @endif
      @else
        <div id="editorjs"></div>
        <input type="hidden" name="save-data" id="save-data-input" value="">    
      @endif
    </div>
    <div class="form-group mb-3">
      <div class="image-preview">
        @if($product->content)
          @if($product->content->image)
            <img src="{{ Storage::url($product->content->image) }}" alt="">
          @else
            <img src="/img/no-photo.svg" alt="">
          @endif
        @else
          <img src="/img/no-photo.svg" alt="">
        @endif
      </div>
    </div>
    <div class="form-group mb-3">
      <div class="label-text">Изображение (соотношение сторон 1:1), не более 300кб</div>
      <input type="file" name="input-main-file" id="input-main-file" class="inputfile" accept="image/jpeg,image/png">
      <label for="input-main-file" class="custom-inputfile-label">Выберите файл</label>
      <span class="namefile main-file-text">Файл не выбран</span>
    </div>
    <div class="form-group mb-3">
      <div class="image-preview gallery-image-preview">
        @if($product->gallery->count() > 0)
          @foreach($product->gallery as $gl)
            <img src="{{ Storage::url($gl->image) }}" alt="">
          @endforeach
          <div class="gallery-delete">Удалить галерею</div>
        @endif
      </div>
    </div>
    <div class="form-group mb-3">
      <div class="label-text">Галерея (соотношение сторон 1:1), не более 300кб</div>
      <input type="file" name="input-gallery-file[]" id="input-gallery-file" class="inputfile" accept="image/jpeg,image/png" multiple>
      <label for="input-gallery-file" class="custom-inputfile-label">Выберите файлы</label>
      <span class="namefile gallery-file-text">Файлы не выбраны</span>
    </div>

    @if($product->document)
      <a href="{{ Storage::url($product->document->file) }}" target="_blank">Документ</a>
    @endif
    <div class="form-group mb-3">
      <div class="label-text">Документ PDF</div>
      <input type="file" name="input-pdf-file" id="input-pdf-file" class="inputfile" accept="application/pdf">
      <label for="input-pdf-file" class="custom-inputfile-label">Выберите файл</label>
      <span class="namefile pdf-file-text">Файл не выбран</span>
    </div>

    <div class="form-group mb-3">
      @if($product->content)
        <input type="checkbox" name="hit" id="hit" class="form-check-input me-1" @checked($product->content->hit)>
      @else
        <input type="checkbox" name="hit" id="hit" class="form-check-input me-1">
      @endif
      <label for="hit" class="form-check-label">Хит</label>
    </div>
    <div class="form-group mb-5">
      @if($product->content)
        <input type="checkbox" name="special_offer" id="special_offer" class="form-check-input me-1" @checked($product->content->special_offer)>
      @else
        <input type="checkbox" name="special_offer" id="special_offer" class="form-check-input me-1">
      @endif
      <label for="special_offer" class="form-check-label">Специальное предложение</label>
    </div>

    <input type="hidden" name="delete-gallery" id="delete-gallery" value="">

    @csrf
    <button type="submit" id="save-data-btn" class="btn btn-primary">Обновить</button>
  </form>

</div>

<script>
  const menuItem = 0;
</script>

<script>
  // Выбор файлов Галерея
  let inputGalleryFile = document.querySelector('#input-gallery-file'),
      galleryFileText = document.querySelector('.gallery-file-text');

  inputGalleryFile.onchange = function() {
    let filesName = '';
    for (let i = 0; i < this.files.length; i++) {
      filesName += this.files[i].name + ' ';
    }
    galleryFileText.innerHTML = filesName;
  }

  // Удаление всех файлов из галереи
  const galleryDelete = document.querySelector('.gallery-delete');
  const galleryImagePreview = document.querySelector('.gallery-image-preview');
  const inputDeleteGallery = document.querySelector('#delete-gallery');

  if (galleryDelete) {
    galleryDelete.onclick = function() {
      galleryDelete.classList.add('hidden');
      galleryImagePreview.innerHTML = '';
      inputDeleteGallery.value = 1;
    }
  }

  // Выбор файлов Документ
  let inputPdfFile = document.querySelector('#input-pdf-file'),
      pdfFileText = document.querySelector('.pdf-file-text');

  inputPdfFile.onchange = function() {
    let filesName = '';
    for (let i = 0; i < this.files.length; i++) {
      filesName += this.files[i].name + ' ';
    }
    pdfFileText.innerHTML = filesName;
  }
</script>

@endsection

@section('script')
  <script src="https://cdn.tiny.cloud/1/b62ra2i2sow452bimd9sgry7ofijm72bygzmpmo43uik0503/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="{{ asset('/js/tiny-file-upload.js') }}"></script>
@endsection