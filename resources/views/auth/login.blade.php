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
                    <p class="login-box-msg">@lang("auth.login_box_msg")</p>

                    <form action="{{ route("auth.login.post") }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="@lang("users.email")">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="@lang("users.password")">
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
                                        @lang("auth.remember_me")
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">@lang("misc.login")</button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="{{ route("auth.reset-password") }}">@lang("misc.forgot_password")</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
