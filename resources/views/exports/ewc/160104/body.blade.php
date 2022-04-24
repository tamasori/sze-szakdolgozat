<table class="table table-bordered text-center table-hover">
    <tbody>
        <tr class="text-bold">
            <td colspan="6">@lang("exports.ewc.160104.table.headers.amount_header")</td>
        </tr>
        <tr class="text-bold">
            <td>@lang("exports.ewc.normal.table.headers.date")</td>
            <td>@lang("exports.ewc.normal.table.headers.mass")</td>
            <td>@lang("exports.ewc.160104.table.headers.hazardous_sum")</td>
            <td>@lang("exports.ewc.160104.table.headers.160106_amount")</td>
            <td>@lang("exports.ewc.160104.table.headers.storage_mode")</td>
            <td>@lang("exports.ewc.normal.table.headers.rolling_mass")</td>
        </tr>
        <tr class="text-bold">
            <td colspan="12" class="text-left">@lang("exports.ewc.normal.table.headers.yearly_starter"): {{ $ewcCode->getYearlyStarterForYear($year) }}kg</td>
        </tr>
        @php($rollingMass = 0)
        @foreach($substances as $substance)
            @php($subTotal = $substance->mass - ($hazardousSubstancesByCar[$substance->car_id] ?? 0) - $substance->car->dry_weight)
            @php($rollingMass += $subTotal)
            <tr class="@if($subTotal != 0) bg-warning @endif">
                <td>{{ $substance->date }}</td>
                <td>{{ $substance->mass }}</td>
                <td>{{ ($hazardousSubstancesByCar[$substance->car_id] ?? 0) }}</td>
                <td>{{ $substance->car->dry_weight }}</td>
                <td>@lang("exports.ewc.160104.table.body.storage_on_site")</td>
                <td>
                    {{ $rollingMass }}
                    @if($subTotal != 0)
                        <br>
                        <span class="text-black">@lang("exports.ewc.160104.table.body.warning_subtotal") <a target="_blank" href="{{ route("car.edit", $substance->car) }}">{{ $substance->car->local_identifier }}</a></span>
                    @endif
                </td>
            </tr>
        @endforeach
            <tr class="text-bold">
                <td>&nbsp;</td>
                <td>{{ $substances->sum("mass") }}</td>
                <td>{{ array_sum($hazardousSubstancesByCar) }}</td>
                <td>{{ $substances->sum("car.dry_weight") }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
    </tbody>
</table>
