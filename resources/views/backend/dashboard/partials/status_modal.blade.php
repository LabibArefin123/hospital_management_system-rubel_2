<div class="modal fade" id="statusChangeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Confirm Status Change</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body text-center">
                <h5 id="statusChangeText">Do you want to change status?</h5>
            </div>

            <div class="modal-footer justify-content-center">
                <button class="btn btn-secondary" data-dismiss="modal">No</button>

                <form id="statusChangeForm" method="POST">
                    @csrf
                    <input type="hidden" name="status" id="selectedStatus">
                    <button class="btn btn-success">
                        <i class="fas fa-check"></i> Yes
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
