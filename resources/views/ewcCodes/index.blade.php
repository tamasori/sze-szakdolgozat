@extends("layouts.master-with-sidebar")
@section("title",__("ewc-codes.menu"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("ewc-codes.menu")</h3>
                <a href="{{ route("ewc-code.create") }}" class="btn btn-primary float-right">@lang("ewc-codes.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.ewc-codes-table")
            </div>
        </div>
    </div>
</div>
@endsection
