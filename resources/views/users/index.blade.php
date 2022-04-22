@extends("layouts.master-with-sidebar")
@section("title",__("users.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("users.title")</h3>
                <a href="{{ route("user.create") }}" class="btn btn-primary float-right">@lang("users.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.users-table")
            </div>
        </div>
    </div>
</div>
@endsection
