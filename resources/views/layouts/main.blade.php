<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Личный кабинет')</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="shortcut icon" href="{{ asset('/img/favicon.svg') }}" type="image/x-icon">
  @yield('style')
  @vite(['resources/sass/main.scss'])
</head>

<body>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="flex-container">
        @if(request()->cookie('aside_nav'))
          <div class="aside-nav active">
        @else
          <div class="aside-nav">
        @endif
          <div class="aside-nav-logo">
            <div class="wide-logo">
              <img src="/img/natura-pharma-logo.png" class="logo" alt="">
              <img src="/img/natura-pharma-logo-text.png" class="logo-text" alt="">
            </div>            
            <img src="/img/double-left.png" class="double-left" alt="">
          </div>
          <div class="aside-nav-top">
            <div class="nav-item">
              <img class="nav-item__image" src="/img/home.svg" alt="">
              <div class="nav-item__text">Главная</div>
              <div class="arrow-right">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 5.25L19.25 14L10.5 22.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <a href="/" class="full-link"></a>
            </div>
            <div class="nav-item">
              <img class="nav-item__image" src="/img/user.svg" alt="">
              <div class="nav-item__text">Мой профиль</div>
              <div class="arrow-right">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 5.25L19.25 14L10.5 22.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <a href="/profile" class="full-link"></a>
            </div>
            <!-- 
            <div class="nav-item">
              <img class="nav-item__image" src="/img/clock.svg" alt="">
              <div class="nav-item__text">История заказов</div>
              <div class="arrow-right">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 5.25L19.25 14L10.5 22.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <a href="/orders" class="full-link"></a>
            </div>
             -->
            <div class="nav-item">
              <img class="nav-item__image" src="/img/ticket.svg" alt="">
              <div class="nav-item__text">Купоны</div>
              <div class="arrow-right">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 5.25L19.25 14L10.5 22.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <a href="/coupon" class="full-link"></a>
            </div>
            <div class="nav-item">
              <img class="nav-item__image" src="/img/bell.svg" alt="">
              <div class="nav-item__text">Уведомления</div>
              <div class="arrow-right">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 5.25L19.25 14L10.5 22.75" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <a href="/notifications" class="full-link"></a>
            </div>
          </div>
          <div class="aside-nav-bottom">
            <div class="nav-item">
              <img class="nav-item__image" src="/img/hard-drives.svg" alt="">
              <div class="nav-item__text">База знаний</div>
              <a href="/knowledge-base" class="full-link"></a>
            </div>
            <div class="nav-item">
              <img class="nav-item__image" src="/img/info.svg" alt="">
              <div class="nav-item__text">Поддержка</div>
              <a href="/support" class="full-link"></a>
            </div>
          </div>
        </div>

        <div class="lk-content">
          @yield('content')
        </div>
        
      </div>
    </div>
  </div>

  @yield('script')
  @vite(['resources/js/main.js'])

</body>
</html>