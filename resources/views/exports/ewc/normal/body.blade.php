<table class="table table-bordered text-center table-hover">
    <tbody>
        <tr class="text-bold">
            <td colspan="2">&nbsp;</td>
            <td colspan="4">@lang("exports.ewc.normal.table.headers.export_masses")</td>
            <td colspan="5">@lang("exports.ewc.normal.table.headers.rec_data")</td>
            <td>&nbsp;</td>
        </tr>
        <tr class="text-bold">
            <td>@lang("exports.ewc.normal.table.headers.date")</td>
            <td>@lang("exports.ewc.normal.table.headers.mass")</td>
            <td>@lang("exports.ewc.normal.table.headers.pretreatment")</td>
            <td>@lang("exports.ewc.normal.table.headers.collector")</td>
            <td>@lang("exports.ewc.normal.table.headers.disposal")</td>
            <td>@lang("exports.ewc.normal.table.headers.export")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_name")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_kuj_number")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_ktj_number")</td>
            <td>@lang("exports.ewc.normal.table.headers.rec_treatment_code")</td>
            <td>@lang("exports.ewc.normal.table.headers.sz_ticket_number")</td>
            <td>@lang("exports.ewc.normal.table.headers.rolling_mass")</td>
        </tr>
        <tr class="text-bold">
            <td colspan="12" class="text-left">@lang("exports.ewc.normal.table.headers.yearly_starter"): {{ $ewcCode->getYearlyStarterForYear($year) }}kg</td>
        </tr>
        @php $rollingMass = $ewcCode->getYearlyStarterForYear($year); @endphp
        @foreach($substances as $substance)
            @php $rollingMass += \App\Services\NormalEwcCalculationsService::calculateRollingMassAddage($substance) @endphp
            <tr>
                <td>{{ $substance->date }}</td>
                <td>{{ $substance->mass }}</td>
                <td>{{ $substance->pretreatment_mass ?? 0 }}</td>
                <td>{{ $substance->collector_mass ?? 0 }}</td>
                <td>{{ $substance->disposal_mass ?? 0 }}</td>
                <td>{{ $substance->export_mass ?? 0 }}</td>
                <td>{{ $substance->company_name }}</td>
                <td>{{ $substance->kuj_number }}</td>
                <td>{{ $substance->ktj_number }}</td>
                <td>{{ $substance->treatment_code }}</td>
                <td>{{ $substance->delivery_note }}</td>
                <td>{{ $rollingMass }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
