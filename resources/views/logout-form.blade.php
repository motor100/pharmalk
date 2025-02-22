<form class="form logout-form" action="{{ route('logout') }}" method="POST">
  <img src="/img/user.png" class="logout-user" alt="">
  <div class="logout-username">{{ auth()->user()->name }}</div>
  @csrf
  <button class="logout-btn">
    <img src="/img/sign-out.png" alt="">
  </button>
</form>