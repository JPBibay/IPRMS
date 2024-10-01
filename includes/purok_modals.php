<!-- Add Purok Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addPurok" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Purok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="u-ID" value="<?= $_SESSION['u_id'] ?>">
                    <div class="mb-3">
                        <label for="purok" class="form-label">Purok</label>
                        <input type="text" class="form-control" id="purok" name="purok"
                            placeholder="Enter the purok name" required>
                    </div>
                    <div class="mb-3">
                        <label for="household" class="form-label">Household</label>
                        <input type="text" class="form-control" id="household" name="household"
                            placeholder="Enter the total household" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-purok" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Purok Modal -->

<!-- Delete Purok Modal -->
<div class="modal fade" id="deleteModal<?= $data['id'] ?>" tabindex="-1"
    aria-labelledby="deleteModalLabel<?= $data['id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel<?= $data['id'] ?>">Confirm
                    Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Purok?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="process.php?delete_purok&id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Purok Modal -->

<!-- Edit Purok Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editModal<?= $data['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Purok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="mb-3">
                        <label for="purok" class="form-label">Purok</label>
                        <input type="text" class="form-control" id="purok" name="purok"
                            placeholder="Enter the purok name" value="<?= $data['purok'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="household" class="form-label">Household</label>
                        <input type="text" class="form-control" id="household" name="household"
                            placeholder="Enter the total household" value="<?= $data['household'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit-purok" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Purok Modal -->