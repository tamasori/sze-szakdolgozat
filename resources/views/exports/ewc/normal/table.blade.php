{!! $service->headerView() !!}
{!! $service->bodyView() !!}
{!! $service->footerView() !!}
@if(isset($pdf) && $pdf)
    {!! $service->pdfStyles() !!}
@endif
