@extends("layouts.master")

@section("title", "Elfelejtett jelszó")

@section("content")
    <div class="login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Bontó</b>Manager</a>
                </div>
                <div class="card-body">

                    <form action="{{ route("auth.reset-password.post") }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="@lang("users.email")">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">@lang("auth.reset")</button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="{{ route("auth.login") }}">@lang("misc.login")</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
