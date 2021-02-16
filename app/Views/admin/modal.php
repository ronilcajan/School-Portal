<!-- create modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete User</h4> </div>
            <form action="<?= base_url('admin/delete-user') ?>" method="POST">
                <div class="modal-body">
                    <p>Are you sure to delete this user/s?</p>
                    <ul class="user_list">
						<li>No user selected!</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="users" name="id" id="user_id">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger waves-effect waves-light" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>