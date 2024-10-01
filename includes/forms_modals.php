<!-- Add Forms Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="process.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="u-ID" value="<?= $_SESSION['u_id'] ?>">
                    <div class="mb-3">
                        <label for="purok" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter the file name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="Select file"
                            accept=".pdf,.docx" required>
                        <small class="text-muted">The file must not not exceed 1MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-form" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Forms Modal -->

<!-- Edit Forms Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editModal<?= $data['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter the file name"
                            value="<?= $data['file_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file"
                            placeholder="Select file to update">
                        <small class="text-muted">Leave this blank if you don't want to update the file.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit-form" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Forms Modal -->

<!-- Delete Forms Modal -->
<div class="modal fade" id="deleteModal<?= $data['id'] ?>" tabindex="-1"
    aria-labelledby="deleteModalLabel<?= $data['id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel<?= $data['id'] ?>">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this File?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="process.php?delete_form&id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Forms Modal -->