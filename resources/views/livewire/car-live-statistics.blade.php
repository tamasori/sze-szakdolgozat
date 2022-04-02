<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                @lang("cars.statistics.title")
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $carCount }}db</h3>
                            <p>@lang("cars.statistics.count")</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $carDryWeight }}kg</h3>
                            <p>@lang("cars.statistics.dry_weight_sum")</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $carRetWeight }}kg</h3>
                            <p>@lang("cars.statistics.retrieved_weight_sum")</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $carAvgYear }}</h3>
                            <p>@lang("cars.statistics.year_avg")</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>@lang("cars.statistics.by_city")</h3>
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <th>@lang("cars.city")</th>
                            <th>@lang("cars.statistics.count")</th>
                            <th>@lang("cars.statistics.retrieved_weight_sum")</th>
                        </thead>
                        <tbody>
                            @foreach($statsByCity as $stats)
                                <tr>
                                    <td>{{ $stats["city"] }}</td>
                                    <td>{{ $stats["count"] }}</td>
                                    <td>{{ $stats["sum"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>@lang("cars.statistics.by_make")</h3>
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                        <th>@lang("cars.car_make")</th>
                        <th>@lang("cars.statistics.count")</th>
                        <th>@lang("cars.statistics.retrieved_weight_sum")</th>
                        </thead>
                        <tbody>
                        @foreach($statsByMake as $stats)
                            <tr>
                                <td>{{ $stats["make"] }}</td>
                                <td>{{ $stats["count"] }}</td>
                                <td>{{ $stats["sum"] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
