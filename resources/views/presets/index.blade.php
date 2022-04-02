@extends("layouts.master-with-sidebar")
@section("title",__("presets.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("presets.title")</h3>
                <a href="{{ route("preset.create") }}" class="btn btn-primary float-right">@lang("presets.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.presets-table")
            </div>
        </div>
    </div>
</div>
@endsection
