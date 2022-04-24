@extends("layouts.master-with-sidebar")
@section("title",__("logbook-entries.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("logbook-entries.title")</h3>
                <a href="{{ route("logbook-entry.create") }}" class="btn btn-primary float-right">@lang("logbook-entries.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.logbook-entries-table")
            </div>
        </div>
    </div>
</div>
@endsection
