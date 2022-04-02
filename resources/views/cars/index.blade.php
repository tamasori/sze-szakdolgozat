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
        window.addEventListener("load",function(){
            Livewire.emit('loadedStatisticsPanel');
        });
    </script>
@endpush
