@extends('dashboard.layout')

@section('title', $slide->title)

@section('dashboardcontent')

<div class="dashboard-content">

  <p class="show-item">{{ $slide->title }}</p>
  <p class="show-item">{{ $slide->text }}</p>
  <p>
    <a href="{{ $slide->link }}" class="show-item" target="_blank">{{ $slide->link }}</a>
  </p>
  <div class="show-item show-item__image">
    <img src="{{ Storage::url($slide->image) }}" alt="">
  </div>

<script>
  const menuItem = 2;
</script>

@endsection