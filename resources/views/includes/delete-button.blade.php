<form action="{{ $url }}" method="post" class="ml-2">
    @method("delete")
    @csrf
    <button class="btn btn-danger d-inline-block" type="button" data-toggle="modal" data-target="#modelDestroyModal{{ md5($url) }}"><i class="fas fa-trash"></i></button>
    <div class="modal fade" id="modelDestroyModal{{ md5($url) }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang("messages.destroy.title")</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang("messages.destroy.body")</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">@lang("messages.destroy.button")</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang("misc.cancel")</button>
                </div>
            </div>
        </div>
    </div>

</form>
