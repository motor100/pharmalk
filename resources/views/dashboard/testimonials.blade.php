@extends('dashboard.layout')

@section('title', 'Отзывы')

@section('dashboardcontent')

<div class="dashboard-content">

  <div class="testimonials-wrapper">
    @if($testimonials->count() > 0)
      @foreach($testimonials as $testimonial)
        <div class="item">
          <form class="form" action="{{ route('admin.tesimonials-update', $testimonial->id) }}" method="post">
            <div class="form-group mb-3">
              <label for="inputName" class="form-check-label">Имя</label>
              <input type="text" name="name" id="inputName" class="form-control" value="{{ $testimonial->name }}" required>
            </div>
            <div class="form-group mb-3">
              <label for="inputText" class="form-check-label">Отзыв</label>
              <textarea name="text" id="inputText" class="form-control" required>{{ $testimonial->text }}</textarea>
            </div>
            <input type="hidden" name="email" value="{{ $testimonial->email }}">
            @csrf
            <button type="submit" class="publicate-btn btn btn-primary">опубликовать</button>
          </form>
          <form class="form rm-testimonial-form" action="{{ route('admin.tesimonials-destroy', $testimonial->id) }}" method="post">
            @csrf
            <button type="submit" class="rm-btn btn btn-secondary">удалить</button>
          </form>
        </div>
      @endforeach
    @endif
  </div>

</div>

<script>
  const menuItem = 3;
</script>
@endsection