<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/sass/main.scss'])
</head>

<body>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 d-lg-block d-none">
          <div class="aside-nav">
            <div class="aside-nav-top">
              <div class="nav-item">
                <img class="nav-item__image" src="/img/home.svg" alt="">
                <div class="nav-item__text">Главная</div>
                <a href="/" class="full-link"></a>
              </div>
              <div class="nav-item">
                <img class="nav-item__image" src="/img/user.svg" alt="">
                <div class="nav-item__text">Мой профиль</div>
                <a href="/profile" class="full-link"></a>
              </div>
              <div class="nav-item">
                <img class="nav-item__image" src="/img/clock.svg" alt="">
                <div class="nav-item__text">История заказов</div>
                <a href="/orders" class="full-link"></a>
              </div>
              <div class="nav-item">
                <img class="nav-item__image" src="/img/ticket.svg" alt="">
                <div class="nav-item__text">Купоны</div>
                <a href="/coupons" class="full-link"></a>
              </div>
              <div class="nav-item">
                <img class="nav-item__image" src="/img/ticket.svg" alt="">
                <div class="nav-item__text">Уведомления</div>
                <a href="/notifications" class="full-link"></a>
              </div>
            
          </div>
        </div>
        <div class="col-lg-9 col-md-12">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  @vite(['resources/js/main.js'])
</body>
</html>