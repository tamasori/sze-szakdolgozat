@extends("layouts.master-with-sidebar")
@section("title",__("imports.title"))

@section("main")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang("imports.title")</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('import-r4.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">@lang("imports.file")</label>
                            <input type="file" class="form-control-file" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-success">@lang("imports.submit")</button>
                    </form>
                    <hr>
                    @if(isset($created) && !empty($created))
                        <h4>@lang("imports.created")</h4>
                        <table>
                            @foreach($created as $item)
                                <tr>
                                    @foreach($item as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    @if(isset($problems) && !empty($problems))
                        <h4>@lang("imports.failed")</h4>
                        <table>
                            @foreach($problems as $item)
                                <tr>
                                    @foreach($item as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
