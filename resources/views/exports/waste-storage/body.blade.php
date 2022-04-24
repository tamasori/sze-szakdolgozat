<table class="table table-bordered text-center table-hover">
    <tbody>
        <tr class="text-bold">
            <td>@lang("logbook-entries.date")</td>
            <td>@lang("exports.waste_storage.table.body.import_mass")</td>
            <td>@lang("exports.waste_storage.table.body.export_mass")</td>
            <td>@lang("substances.company_name")</td>
            <td>@lang("substances.ktj_number")</td>
            <td>@lang("substances.kuj_number")</td>
            <td>@lang("substances.treatment_code")</td>
            <td>@lang("exports.ewc.normal.table.headers.rolling_mass")</td>
        </tr>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->date_of_demolition }}</td>
                <td>{{ $car->retrieved_weight }}</td>
                <td>{{ $car->retrieved_weight }}</td>
                <td>{{ config("company.name") }}</td>
                <td>{{ config("company.ktj_number") }}</td>
                <td>{{ config("company.kuj_number") }}</td>
                <td>E02-09, E02-10</td>
                <td>0</td>
            </tr>
        @endforeach
    </tbody>
</table>
