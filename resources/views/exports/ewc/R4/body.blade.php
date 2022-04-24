<table class="table table-bordered text-center table-hover">
    <tbody>
        <tr class="text-bold">
            <td>@lang("exports.ewc.normal.table.headers.date")</td>
            <td>@lang("exports.ewc.normal.table.headers.mass")</td>
            <td>@lang("exports.ewc.normal.table.headers.rolling_mass")</td>
            <td>@lang("exports.ewc.R4.table.body.checked_quantity")</td>
        </tr>
        <tr class="text-bold">
            <td colspan="12" class="text-left">@lang("exports.ewc.normal.table.headers.yearly_starter"): {{ $ewcCode->getYearlyStarterForYear($year) }}kg</td>
        </tr>
        @php($rollingMass = 0)
        @foreach($substances as $substance)
            @php($subTotal = \App\Services\EwcR4CalculationsService::calculateRollingMassAddage($substance))
            @php($rollingMass += $subTotal)
            <tr>
                <td>{{ $substance->date }}</td>
                <td>{{ $subTotal }}</td>
                <td>{{ $rollingMass }}</td>
                <td>{{ $subTotal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
