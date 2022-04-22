@extends("layouts.master-with-sidebar")
@section("title",__("enquiries.menu"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("enquiries.menu")</h3>
                <a href="{{ route("enquiries.create") }}" class="btn btn-primary float-right">@lang("enquiries.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.enquiries-table")
            </div>
        </div>
    </div>
</div>
@endsection

