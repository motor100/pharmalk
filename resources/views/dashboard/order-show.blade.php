@extends('dashboard.layout')

@section('title', 'Заказы')

@section('dashboardcontent')

<div class="dashboard-content">

  @if(session()->get('status'))
    <div class="alert alert-success">
      {{ session()->get('status') }}
    </div>
  @endif

  <div class="order-content">
    <div class="form-group mb-3">
      <div class="label-text mb-1">Сумма</div>
      <div class="order-info">{{ $order->summ }}р</div>
    </div>
    <div class="form-group mb-3">
      <div class="label-text mb-1">Оплата</div>
      <div class="order-info">{{ $order->payment_method }}</div>
      @if($order->payment_method == 'Онлайн')
        <div class="order-info {{ !$order->payment_status ? 'text-danger' : '' }}">{{ $order->payment_status ? 'Оплачен' : 'Оплаты нет' }}</div>
      @endif
    </div>
    <div class="form-group mb-3">
      <div class="label-text mb-1">Доставка</div>
      <div class="order-info">{{ $order->delivery_method }}</div>
    </div>
    <div class="form-group mb-3">
      <div class="label-text mb-1">Время</div>
      <div class="order-info">{{ $order->created_at->format("d.m.Y H:i") }}</div>
    </div>
    <div class="form-group mb-3">
      <div class="label-text mb-1">Покупатель</div>
      <div class="order-info">
        <p>{{ $order->customer->customer_type }}</p>
        <p>{{ $order->customer->name }}</p>
        <p>{{ $order->customer->email }}</p>
        <p>{{ $order->customer->phone }}</p>
        <p>{{ $order->customer->inn }}</p>
        <p>{{ $order->customer->manager }}</p>
      </div>
    </div>
  </div>

  <div class="order-edit mb-5">
    <form class="form" action="{{ route('admin.order-update', $order->id) }}" method="post">
      <div class="form-group mb-3">
        <div class="label-text mb-1">Статус</div>
        @if($order->status == "Выдан")
          <div class="order-info">{{ $order->status }}</div>
        @else
          <select name="status" id="status" class="form-select">
            <option value="В обработке" {{ $order->status == 'В обработке' ? 'selected' : '' }}>В обработке</option>
            <option value="Выдан" {{ $order->status == 'Выдан' ? 'selected' : '' }}>Выдан</option>
            <option value="Отменен" {{ $order->status == 'Отменен' ? 'selected' : '' }}>Отменен</option>
          </select>
        @endif
      </div>

      @if($order->status != "Выдан")
        <div class="form-group mb-5">
          <label for="comment" class="form-check-label d-block mb-1">Комментарий</label>
          <input type="text" name="comment" id="comment" class="form-control" maxlength="250" value="{{ $order->comment }}">
        </div>

        @csrf
        <input type="submit" class="btn btn-primary" value="Обновить">
      @endif

    </form>
  </div>

  <div class="order-products">
    <div class="label-text mb-1">Товары</div>
    @foreach($products as $product)
      <p>{{ $product->title }} {{ $product->quantity }}шт</p>
    @endforeach
  </div>

</div>

<script>
  const menuItem = 1;
</script>

@endsection