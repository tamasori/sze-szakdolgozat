<table class="table table-bordered text-center table-hover">
    <tbody>
        <tr class="text-bold">
            <td>&nbsp;</td>
            <td colspan="3">@lang("exports.waste_management.table.body.car")</td>
            <td>@lang("exports.waste_management.table.body.export_date")</td>
        </tr>
        <tr class="text-bold">
            <td>@lang("logbook-entries.date")</td>
            <td>@lang("cars.retrieved_weight")</td>
            <td>@lang("cars.car_make")</td>
            <td>@lang("cars.car_model")</td>
            <td>160106</td>
        </tr>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->date_of_demolition }}</td>
                <td>{{ $car->retrieved_weight }}</td>
                <td>{{ $car->carMake->make }}</td>
                <td>{{ $car->carModel->model }}</td>
                <td>{{ $car->date_of_demolition }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
