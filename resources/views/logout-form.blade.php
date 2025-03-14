<form class="form logout-form" action="{{ route('logout') }}" method="POST">
  @csrf
  <button class="logout-btn">
    <img src="/img/user.png" class="logout-user" alt="">
    <span class="logout-username">Выйти</span>
    <img src="/img/sign-out.png" alt="">
  </button>
</form>