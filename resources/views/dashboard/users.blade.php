@extends('dashboard.layout')

@section('title', 'Пользователи')

@section('dashboardcontent')

<div class="dashboard-content users">

  @if(session()->get('status'))
    <div class="alert alert-success">
      {{ session()->get('status') }}
    </div>
  @endif

  <a href="{{ route('users-create') }}" class="btn btn-success mb-3">Добавить</a>
  <div class="table-wrapper mb-3">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="number-column hidden-mobile">№</th>
          <th class="name-column">Имя</th>
          <th class="role-column">Роль</th>
          <th class="button-column"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td class="hidden-mobile">{{ $user->id }}</td>
            <td>
              <a href="{{ route('users-show', $user->id) }}" class="title-link">{{ $user->name }}</a>
            </td>
            <td>{{ $user->role->name_cyr }}</td>
            <td class="button-group">
              <a href="{{ route('users-show', $user->id) }}" class="btn btn-success">
                <i class="fas fa-eye"></i>
              </a>
              <a href="{{ route('users-edit', $user->id) }}" class="btn btn-primary">
                <i class="fas fa-pen"></i>
              </a>
              <!-- <button type="button" class="btn btn-danger del-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-route="{{-- route('users-destroy', $user->id) --}}"> -->
              <button type="button" class="btn btn-danger del-btn">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>

@include('dashboard.modal')

<script>
  const menuItem = 8;
</script>

@endsection

@section('script')
  <script src="{{ asset('/adminpanel/js/bootstrap.min.js') }}"></script>
@endsection