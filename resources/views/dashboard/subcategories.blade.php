@extends('dashboard.layout')

@section('title', 'Подкатегории')

@section('dashboardcontent')

<div class="dashboard-content">

  <form class="form mb-5" action="#" method="get">
    <div class="form-group mb-3">
      <label for="search_query">Поиск</label>
      <input type="text" class="form-control input-number" name="search_query" id="search_query" maxlength="200" required>
    </div>
    <button type="submit" class="btn btn-primary">Найти</button>
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th class="number-column">№</th>
        <th>Название</th>
        <th class="button-column"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($subcategories as $key => $subcat)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td>{{ $subcat->title }}</td>
          <td class="table-button">

            @if(isset($subcat->ancestors))
              @if(count($subcat->ancestors) == 1)
                <a href="/category/{{ $subcat->ancestors[0]->slug }}/{{ $subcat->slug }}" class="btn btn-success" target="_blank">
              @else
                <a href="/category/{{ $subcat->ancestors[0]->slug }}/{{ $subcat->ancestors[1]->slug }}/{{ $subcat->slug }}" class="btn btn-success" target="_blank">
              @endif
            @endif

              <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('admin.subcategories-edit', $subcat->id) }}" class="btn btn-primary">
              <i class="fas fa-pen"></i>
            </a>
            <form class="form" action="#" method="get">
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

  {{ $subcategories->onEachSide(1)->links('pagination.dashboard') }}

</div>

<script>
  const menuItem = 4;
</script>
@endsection