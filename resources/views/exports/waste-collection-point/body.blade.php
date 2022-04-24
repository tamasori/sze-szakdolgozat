<table class="table table-bordered text-center table-hover">
    <tbody>
    <tr>
        <td colspan="4"></td>
        <td colspan="5">@lang("exports.waste_collection_point.table.header.receiver")</td>
    </tr>
        <tr class="text-bold">
            <td>@lang("substances.date")</td>
            <td>@lang("substances.ewc_code")</td>
            <td>@lang("exports.waste_storage.table.body.import_mass")</td>
            <td>@lang("exports.waste_storage.table.body.export_mass")</td>
            <td>@lang("substances.company_name")</td>
            <td>@lang("substances.kuj_number")</td>
            <td>@lang("substances.ktj_number")</td>
            <td>@lang("substances.treatment_code")</td>
            <td>@lang("substances.delivery_note")</td>
        </tr>
        @php($currentDate = null)
        @foreach($substances as $substance)
            @if($currentDate != $substance->date)
                <tr class="text-bold">
                    <td colspan="9" style="text-align: left">{{ $substance->date }}</td>
                </tr>
                @php($currentDate = $substance->date)
            @endif
            <tr>
                <td>{{ $substance->date }}</td>
                <td>{{ $substance->ewcCode->code }}@if($substance->ewcCode->hazardous)*@endif</td>
                <td>{{ $substance->mass }}</td>
                <td>{{ $substance->sumExport() }}</td>
                <td>{{ $substance->company_name }}</td>
                <td>{{ $substance->ktj_number }}</td>
                <td>{{ $substance->kuj_number }}</td>
                <td>{{ $substance->treatment_code }}</td>
                <td>{{ $substance->delivery_note }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
