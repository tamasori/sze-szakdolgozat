<table class="table table-hover table-bordered w-auto">
    <tbody>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.starter", ["year" => $year])</td>
            <td>{{ $ewcCode->getYearlyStarterForYear($year) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.mass", ["year" => $year])</td>
            <td>{{ \App\Services\NormalEwcCalculationsService::sumMassFromQuery($query) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.export", ["year" => $year])</td>
            <td>{{ \App\Services\NormalEwcCalculationsService::sumExportsFromQuery($query) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.sum", ["year" => $year])</td>
            <td>{{ \App\Services\NormalEwcCalculationsService::calculateYearEnd($query,$ewcCode,$year) }} kg</td>
        </tr>
    </tbody>
</table>
