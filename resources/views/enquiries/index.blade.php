@extends("layouts.master-with-sidebar")
@section("title",__("enquiries.menu"))

@section("main")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("enquiries.menu")</h3>
                <a href="{{ route("enquiries.create") }}" class="btn btn-primary float-right">@lang("enquiries.create")</a>
            </div>
            <div class="card-body">
                @livewire("tables.enquiries-table", ["openOnly" => $openOnly])
            </div>
        </div>
    </div>
</div>
@endsection
@push("after-scripts")
    @if($openOnly)
        <script>
            webSocket = new WebSocket('{{ config("ws.url") }}');
            webSocket.onopen = function(event) {
                console.log("WebSocket is open!");
                webSocket.send("refresh-data");
            };
            webSocket.onmessage = function(event) {
                if(event.data == "refresh-data") {
                    Livewire.emit("enquiry-updated");
                }
            };
            webSocket.onclose = function(event) {
                console.log("WebSocket is closed!");
            };
        </script>
    @endif
@endpush

