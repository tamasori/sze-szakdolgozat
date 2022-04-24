@extends("layouts.master-with-sidebar")
@section("title",__("users.title"))

@section("main")
    <form
        action="@if(isset($user)) {{ route("user.update", $user) }} @else {{ route("user.store") }} @endif"
        method="post">
        @csrf
        @if(isset($user))
            @method("PUT")
        @endif
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @if(isset($user)) @lang("users.update",["name" => $user->name]) @else @lang("users.create") @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("users.name")</label>
                                <input type="text" class="form-control" placeholder="@lang("users.name")" name="name"
                                       value="{{ old("name", $user->name ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("users.email")</label>
                                <input type="email" class="form-control" placeholder="@lang("users.email")" name="email"
                                       value="{{ old("email", $user->email ?? "") }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("users.password")</label>
                                <input type="password" class="form-control" placeholder="@lang("users.password")" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang("users.role")</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="{{ \App\Models\User::ADMIN }}" @if(\App\Models\User::ADMIN == old("role", $user->role ?? "")) selected @endif>@lang("users.roles.admin")</option>
                                    <option value="{{ \App\Models\User::DISPATCHER }}" @if(\App\Models\User::DISPATCHER == old("role", $user->role ?? "")) selected @endif>@lang("users.roles.dispatcher")</option>
                                    <option value="{{ \App\Models\User::MECHANIC }}" @if(\App\Models\User::MECHANIC == old("role", $user->role ?? "")) selected @endif>@lang("users.roles.mechanic")</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-danger" href="{{ route("user.index") }}">@lang("misc.back")</a>
                        <button class="btn btn-success" type="submit">@lang("misc.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
