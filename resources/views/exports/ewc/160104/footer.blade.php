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
            <td class="text-bold">@lang("exports.ewc.160104.table.footer.hazardous_sum", ["year" => $year])</td>
            <td>{{ array_sum($hazardousSubstancesByCar) }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.160104.table.footer.160106_amount", ["year" => $year])</td>
            <td>{{ $query->get()->sum("car.dry_weight") }} kg</td>
        </tr>
        <tr>
            <td class="text-bold">@lang("exports.ewc.normal.table.footer.sum", ["year" => $year])</td>
            <td>0 kg</td>
        </tr>
    </tbody>
</table>
