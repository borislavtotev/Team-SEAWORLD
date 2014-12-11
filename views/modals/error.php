<?php if (isset( $_GET[ 'error' ] )) :?>
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="Error" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="errModalLabel">Error</h4>
            </div>
            <div class="modal-body">
                <p><?= $_GET[ 'error' ] ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>