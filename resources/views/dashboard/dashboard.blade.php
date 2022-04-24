@extends("layouts.master-with-sidebar")
@section("title",__("misc.dashboard"))

@section("main")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary w-100 pt-5 pb-5" href="{{ route("material-balance-export.show", date("Y")) }}">
                    <i class="fas fa-balance-scale big-button"></i>
                    <h3 class="mt-3">@lang("dashboard.big_buttons.scale")</h3>
                </a>
            </div>
            <div class="col-md-2">
                <a class="btn btn-secondary w-100 pt-5 pb-5" href="{{ route("car.create") }}">
                    <i class="fas fa-car-crash big-button"></i>
                    <h3 class="mt-3">@lang("dashboard.big_buttons.new_car")</h3>
                </a>
            </div>
            <div class="col-md-2">
                <a class="btn btn-danger w-100 pt-5 pb-5" href="{{ route("car.index",["filters[date_of_demolition_from]" => \Carbon\Carbon::now()->startOfYear()->format("Y-m-d")]) }}">
                    <i class="fas fa-car big-button"></i>
                    <h3 class="mt-3">@lang("dashboard.big_buttons.current_cars")</h3>
                </a>
            </div>
            <div class="col-md-2">
                <a class="btn btn-dark w-100 pt-5 pb-5" href="{{ route('enquiries.create') }}">
                    <i class="fas fa-book-medical big-button"></i>
                    <h3 class="mt-3">@lang("dashboard.big_buttons.new_request")</h3>
                </a>
            </div>
            <div class="col-md-2">
                <a class="btn btn-success w-100 pt-5 pb-5" href="{{ route('enquiries.open') }}">
                    <i class="fas fa-book big-button"></i>
                    <h3 class="mt-3">@lang("dashboard.big_buttons.current_requests")</h3>
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @lang("dashboard.charts.cars_count_quaterly")
                    </div>
                    <div class="card-body">
                        <canvas id="cars-count-quarterly" width="800" height="450"></canvas>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @lang("dashboard.charts.makes_count_quaterly")
                    </div>
                    <div class="card-body">
                        <canvas id="makes-count-quarterly" width="800" height="450"></canvas>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @lang("dashboard.charts.cities_count_quaterly")
                    </div>
                    <div class="card-body">
                        <canvas id="cities-count-quarterly" width="800" height="450"></canvas>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @lang("dashboard.charts.cars_count_monthly")
                    </div>
                    <div class="card-body">
                        <canvas id="cars-count-monthly" width="800" height="450"></canvas>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @lang("dashboard.charts.makes_count_year")
                    </div>
                    <div class="card-body">
                        <canvas id="makes-count-yearly" width="800" height="450"></canvas>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        @lang("dashboard.charts.cities_count_year")
                    </div>
                    <div class="card-body">
                        <canvas id="cities-count-yearly" width="800" height="450"></canvas>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
        </div>
    </div>

@endsection
@push("after-scripts")
    <script>
        const carsCountQuarterly = document.getElementById("cars-count-quarterly").getContext('2d');
        const carsCountQuarterlyChart = new Chart(carsCountQuarterly, {!! json_encode((new \App\Services\Graphs\QuarterlyCarsCountGraph())->getConfig()) !!});

        const carsCountMonthly = document.getElementById("cars-count-monthly").getContext('2d');
        const carsCountMonthlyChart = new Chart(carsCountMonthly, {!! json_encode((new \App\Services\Graphs\MonthlyCarsCountGraph())->getConfig()) !!});

        const makesCountQuarterly = document.getElementById("makes-count-quarterly").getContext('2d');
        const makesCountQuarterlyChart = new Chart(makesCountQuarterly, {!! json_encode((new \App\Services\Graphs\QuarterlyMakesCountGraph())->getConfig()) !!});

        const makesCountYear = document.getElementById("makes-count-yearly").getContext('2d');
        const makesCountYearChart = new Chart(makesCountYear, {!! json_encode((new \App\Services\Graphs\YearlyMakesCountGraph())->getConfig()) !!});

        const citiesCountQuarterly = document.getElementById("cities-count-quarterly").getContext('2d');
        const citiesCountQuarterlyChart = new Chart(citiesCountQuarterly, {!! json_encode((new \App\Services\Graphs\QuarterlyCitiesCountGraph())->getConfig()) !!});

        const citiesCountYear = document.getElementById("cities-count-yearly").getContext('2d');
        const citiesCountYearChart = new Chart(citiesCountYear, {!! json_encode((new \App\Services\Graphs\YearlyCitiesCountGraph())->getConfig()) !!});
    </script>
@endpush