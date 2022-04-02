<div class="d-flex justify-content-end">
    <a class="btn btn-success ml-2" href="{{ route("ewc-code.show", $model) }}"><i class="fas fa-eye"></i></a>
    <a class="btn btn-primary ml-2" href="{{ route("ewc-code.edit", $model) }}"><i class="fas fa-edit"></i></a>
    @if($model->isDeletable())
        @include("includes.delete-button",[
            "url" => route("ewc-code.destroy", $model)
        ])
    @endif
</div>
