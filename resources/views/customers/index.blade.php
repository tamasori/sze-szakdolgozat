@extends("layouts.master-with-sidebar")
@section("title",__("customers.menu"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("customers.menu")</h3>
                <a href="{{ route("customers.create") }}" class="btn btn-primary float-right">@lang("customers.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.customers-table")
            </div>
        </div>
    </div>
</div>
@endsection

