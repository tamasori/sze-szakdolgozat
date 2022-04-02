<table class="table table-bordered text-center table-hover">
    <tbody>
    <tr>
        <td>@lang("exports.waste_management.table.footer.date")</td>
        <td>@lang("exports.waste_management.table.footer.normal.description")</td>
        <td>@lang("exports.waste_management.table.footer.normal.result")</td>
    </tr>
    @forelse($logbookEntriesNormal as $logbookEntryNormal)
        <tr>
            <td>{{ $logbookEntryNormal->date }}</td>
            <td>{{ $logbookEntryNormal->description }}</td>
            <td>{{ $logbookEntryNormal->result }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">@lang("exports.waste_management.table.footer.no_entries")</td>
        </tr>
    @endforelse
    </
    >
</table>
<br>
<table class="table table-bordered text-center table-hover">
    <tbody>

    <tr>
        <td>@lang("exports.waste_management.table.footer.date")</td>
        <td>@lang("exports.waste_management.table.footer.extraordinary.description")</td>
        <td>@lang("exports.waste_management.table.footer.extraordinary.result")</td>
    </tr>
    @forelse($logbookEntriesExtraordinary as $logbookEntryExtraordinary)
        <tr>
            <td>{{ $logbookEntryExtraordinary->date }}</td>
            <td>{{ $logbookEntryExtraordinary->description }}</td>
            <td>{{ $logbookEntryExtraordinary->result }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">@lang("exports.waste_management.table.footer.no_entries")</td>
        </tr>
    @endforelse
    </tbody>
</table>