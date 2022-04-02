@extends("layouts.master-with-sidebar")
@section("title",__("inspection-records.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("inspection-records.title")</h3>
                <a href="{{ route("inspection-record.create") }}" class="btn btn-primary float-right">@lang("inspection-records.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.inspection-records-table")
            </div>
        </div>
    </div>
</div>
@endsection
