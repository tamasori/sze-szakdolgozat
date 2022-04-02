@extends("layouts.master-with-sidebar")
@section("title",__("inspectors.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("inspectors.title")</h3>
                <a href="{{ route("inspector.create") }}" class="btn btn-primary float-right">@lang("inspectors.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.inspectors-table")
            </div>
        </div>
    </div>
</div>
@endsection
