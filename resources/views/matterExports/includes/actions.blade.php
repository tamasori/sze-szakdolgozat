<div class="d-flex justify-content-end">
    <a class="btn btn-primary ml-2" href="{{ route("matter-export.edit", [\Carbon\Carbon::parse($model->year)->year,$model->id]) }}"><i class="fas fa-edit"></i></a>
    @include("includes.delete-button",[
        "url" => route("matter-export.destroy",  [\Carbon\Carbon::parse($model->year)->year,$model->id])
    ])
</div>
