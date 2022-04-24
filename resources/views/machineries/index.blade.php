@extends("layouts.master-with-sidebar")
@section("title",__("machines.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("machines.title")</h3>
                <a href="{{ route("machines.create") }}" class="btn btn-primary float-right">@lang("machines.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.machines-table")
            </div>
        </div>
    </div>
</div>
@endsection
