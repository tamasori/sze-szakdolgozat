<table class="table table-hover table-bordered w-auto">
    <tbody>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.starter", ["year" => $year])</td>
            <td>{{ $ewcCode->getYearlyStarterForYear($year) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.mass", ["year" => $year])</td>
            <td>0 kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.R4.table.footer.from_160106", ["year" => $year])</td>
            <td>{{ \App\Services\NormalEwcCalculationsService::sumMassFromQuery($query) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.R4.table.footer.sold_r4", ["year" => $year])</td>
            <td>{{ \App\Services\EwcR4CalculationsService::sumSoldR4($year) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.R4.table.footer.disposal", ["year" => $year])</td>
            <td>{{ \App\Services\EwcR4CalculationsService::sumDisposal($year) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.sum", ["year" => $year])</td>
            <td>
                {{
                    $ewcCode->getYearlyStarterForYear($year)
                    + \App\Services\NormalEwcCalculationsService::sumMassFromQuery($query)
                    - \App\Services\EwcR4CalculationsService::sumSoldR4($year)
                    - \App\Services\EwcR4CalculationsService::sumDisposal($year)
                }} kg
            </td>
        </tr>
    </tbody>
</table>
