@extends("layouts.master-with-sidebar")
@section("title",__("sales.title"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("sales.title")</h3>
            </div>
            <div class="card-body">
                @livewire("tables.sales-table")
            </div>
        </div>
    </div>
</div>
@endsection
