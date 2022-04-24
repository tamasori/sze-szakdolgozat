@extends("layouts.master-with-sidebar")
@section("title", __("exports.material_balance.title") . " {$year}")

@section("main")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route("material-balance-export.pdf",[$year]) }}" class="btn btn-info">PDF</a>
                </div>
                <div class="card-body">
                    {!! $service->headerView() !!}
                    <br>
                    {!! $service->bodyView() !!}
                    <br>
                    {!! $service->footerView() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
