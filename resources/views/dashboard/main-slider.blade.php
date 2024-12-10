@extends('dashboard.layout')

@section('title', 'Слайдер')

@section('dashboardcontent')

<div class="dashboard-content">

  <a href="{{ route('admin.main-slider-create') }}" class="btn btn-success mb-3">Добавить</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th class="number-column">№</th>
        <th>Название</th>
        <th class="button-column"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($sliders as $slide)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $slide->title }}</td>
          <td class="table-button">
            <a href="{{ route('admin.main-slider-show', $slide->id) }}" class="btn btn-success">
              <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('admin.main-slider-edit', $slide->id) }}" class="btn btn-primary">
              <i class="fas fa-pen"></i>
            </a>
            <form class="form" action="{{ route('admin.main-slider-destroy', $slide->id) }}" method="get">
              @csrf
              <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>

<script>
  const menuItem = 2;
</script>

@endsection