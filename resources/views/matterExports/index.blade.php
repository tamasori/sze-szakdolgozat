@extends("layouts.master-with-sidebar")
@section("title",__("menu.yearly.matter_exports", ["year" => $year]))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("menu.yearly.matter_exports", ["year" => $year])</h3>
                <a href="{{ route("matter-export.create",$year) }}" class="btn btn-primary float-right">@lang("matter-exports.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.matter-exports-table", ["year"=>$year])
            </div>
        </div>
    </div>
</div>
@endsection
