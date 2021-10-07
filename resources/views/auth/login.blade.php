@extends("layouts.master")

@section("title", "Bejelentkezés")

@section("content")
    <div class="login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Bontó</b>Manager</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Jelentkezz be, és tedd produktívabbá a napot!</p>

                    <form action="{{ route("auth.login.post") }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Jelszó">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">
                                        Emlékezz rám
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Bejelentkezés</button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="{{ route("auth.reset-password") }}">Elfelejtetted jelszavadat?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
