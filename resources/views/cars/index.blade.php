@extends("layouts.master-with-sidebar")
@section("title",__("cars.menu"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("cars.menu")</h3>
                <a href="{{ route("car.create") }}" class="btn btn-primary float-right">@lang("cars.create")</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label-sm p-0 m-0">@lang("cars.engine_code")</label>
                            <input id="engineCodeSearch" type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                @livewire("tables.cars-table")
                <hr>
                @livewire("car-live-statistics")
            </div>
        </div>
    </div>
</div>
@endsection
@push("after-scripts")
    <script>
        let timeout;

        window.addEventListener("load",function(){
            Livewire.emit('loadedStatisticsPanel');
        });
        document.getElementById('engineCodeSearch').addEventListener('keydown', function () {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                Livewire.emit('engineCodeSearch', this.value);
            }, 500);
        });
    </script>
@endpush
