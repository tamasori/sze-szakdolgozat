@extends("layouts.master-with-sidebar")
@section("title", __("logbook-entries.log_types.WASTE_COLLECTION_POINT") . " {$year}")

@section("main")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route("waste-collection-point-export.xlsx",[$year]) }}" class="btn btn-info">XLSX</a>
                    <a href="{{ route("waste-collection-point-export.csv",[$year]) }}" class="btn btn-info">CSV</a>
                    <a href="{{ route("waste-collection-point-export.pdf",[$year]) }}" class="btn btn-info">PDF</a>
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
