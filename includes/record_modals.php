<!-- Edit Record Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editModal<?= $data['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="container">
                        <!-- Personal Details -->
                        <div class="row">
                            <h5 class="mt-4">Personal Details</h5>
                            <div class="col-md-4 mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    value="<?= $data['fname'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="mname" name="mname"
                                    value="<?= $data['mname'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="<?= $data['lname'] ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option disabled>Select gender</option>
                                    <option value="Male" <?= $data['gender'] == 'Male' ? 'selected' : '' ?>>Male
                                    </option>
                                    <option value="Female" <?= $data['gender'] == 'Female' ? 'selected' : '' ?>>Female
                                    </option>
                                    <option value="Others" <?= $data['gender'] == 'Others' ? 'selected' : '' ?>>Others
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit-birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="edit-birthday" name="birthday"
                                    value="<?= $data['birthday'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit-age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="edit-age" name="age"
                                    value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option disabled>Select Status</option>
                                    <option value="Single" <?= $data['status'] == 'Single' ? 'selected' : '' ?>>Single
                                    </option>
                                    <option value="Married" <?= $data['status'] == 'Married' ? 'selected' : '' ?>>
                                        Married</option>
                                    <option value="Others" <?= $data['status'] == 'Others' ? 'selected' : '' ?>>Others
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="contact" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    list="contactOptions" value="<?= $data['contact_no'] ?>" required>
                                <datalist id="contactOptions">
                                    <option value="N/A">N/A</option>
                                </datalist>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="purok" class="form-label">Purok</label>
                                <select class="form-select" id="purok" name="purok" required>
                                    <option disabled>Select Purok</option>
                                    <?php
                                    $userID = $_SESSION['u_id'];
                                    $select = $conn->prepare("SELECT * FROM purok WHERE user_id = ? ORDER BY purok ASC");
                                    $select->execute([$userID]);
                                    foreach ($select as $purok) {
                                        $selected = ($data['purok'] == $purok['purok']) ? 'selected' : '';
                                        echo "<option value='" . $purok['purok'] . "' $selected>" . $purok['purok'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="barangay" class="form-label">Barangay</label>
                                <input type="text" class="form-control" id="barangay" name="barangay"
                                    value="<?= $data['barangay'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City/Municipality</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="<?= $data['city'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="<?= $data['province'] ?>" required>
                            </div>
                        </div>
                        <h5 class="mt-4">Additional Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="spouse" class="form-label">Spouse Name</label>
                                <input type="text" class="form-control" list="datalistOptions" id="spouse" name="spouse"
                                    value="<?= $data['spouse'] ?>">
                                <datalist id="datalistOptions">
                                    <option value="None">
                                </datalist>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="father" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="father" name="father"
                                    value="<?= $data['father'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mother" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" id="mother" name="mother"
                                    value="<?= $data['mother'] ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                    value="<?= $data['occupation'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="school" class="form-label">School Level</label>
                                <input type="text" class="form-control" list="schoolOptions" id="school" name="school"
                                    value="<?= $data['school_level'] ?>" required>
                                <datalist id="schoolOptions">
                                    <option value="N/A">N/A</option>
                                    <option value="Out of School">Out of School</option>
                                    <option value="Kinder">Kinder</option>
                                    <option value="Pre-School">Pre-School</option>
                                    <option value="Grade 1">Grade 1</option>
                                    <option value="Grade 2">Grade 2</option>
                                    <option value="Grade 3">Grade 3</option>
                                    <option value="Grade 4">Grade 4</option>
                                    <option value="Grade 5">Grade 5</option>
                                    <option value="Grade 6">Grade 6</option>
                                    <option value="Grade 7">Grade 7</option>
                                    <option value="Grade 8">Grade 8</option>
                                    <option value="Grade 9">Grade 9</option>
                                    <option value="Grade 10">Grade 10</option>
                                    <option value="Grade 11">Grade 11</option>
                                    <option value="Grade 12">Grade 12</option>
                                    <option value="1st Year College">1st Year College</option>
                                    <option value="2nd Year College">2nd Year College</option>
                                    <option value="3rd Year College">3rd Year College</option>
                                    <option value="4th Year College">4th Year College</option>
                                    <option value="Graduated">Graduated</option>
                                </datalist>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tribe" class="form-label">Tribe</label>
                                <input type="text" class="form-control" id="tribe" name="tribe"
                                    value="<?= $data['tribe'] ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ip_scholar"
                                        name="ip_scholar"
                                        <?= isset($data['ip_scholar']) && $data['ip_scholar'] == 'IP Scholar' ? 'checked' : '' ?>
                                        value="IP Scholar">
                                    <label class="custom-control-label" for="ip_scholar">IP Scholar</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ip_youth" name="ip_youth"
                                        <?= isset($data['ip_youth']) && $data['ip_youth'] == 'IP Youth' ? 'checked' : '' ?>
                                        value="IP Youth">
                                    <label for="ip_youth" class="custom-control-label">IP
                                        Youth</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ip_women" name="ip_women"
                                        <?= isset($data['ip_women']) && $data['ip_women'] == 'IP Women' ? 'checked' : '' ?>
                                        value="IP Women">
                                    <label for="ip_women" class="custom-control-label">IP
                                        Women</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="pwd" name="pwd"
                                        <?= isset($data['pwd']) && $data['pwd'] == 'PWD' ? 'checked' : '' ?>
                                        value="PWD">
                                    <label for="pwd" class="custom-control-label">PWD</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="edit-senior_C" name="senior_C"
                                        <?= isset($data['senior_citizen']) && $data['senior_citizen'] == 'Senior Citizen' ? 'checked' : '' ?>
                                        value="Senior Citizen">
                                    <label for="edit-senior_C" class="custom-control-label">Senior Citizen</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="SC_pensioner"
                                        name="SC_pensioner"
                                        <?= isset($data['sc_pensioner']) && $data['sc_pensioner'] == 'Pensioner' ? 'checked' : '' ?>
                                        value="Pensioner">
                                    <label for="SC_pensioner" class="custom-control-label">Senior Citizen
                                        Pensioner</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update-record" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Record Modal -->

<!-- View Modal -->
<div class="modal fade" id="viewModal<?= $data['id'] ?>" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="viewModalLabel<?= $data['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"><?= $data['lname'] ?>,
                    <?= $data['fname'] ?>
                    <?= substr($data['mname'], 0, 1) ?>.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #f8f9fa;">
                <div class="container-fluid">
                    <div class="col mt-2 p-2 shadow-sm justify-content-center">
                        <div class="row me-4 ms-4 pt-2">
                            <h5>Personal Information</h5>
                            <hr>
                            <p><strong>First name:</strong> <?= $data['fname'] ?></p>
                            <p><strong>Middle name:</strong> <?= $data['mname'] ?></p>
                            <p><strong>Last name:</strong> <?= $data['lname'] ?></p>
                            <p><strong>Gender:</strong> <?= $data['gender'] ?></p>
                            <p><strong>Age:</strong> <?= $data['age'] ?></p>
                            <p><strong>Birthday:</strong> <?= $data['birthday'] ?></p>
                            <p><strong>Marital Status:</strong> <?= $data['status'] ?></p>
                            <p><strong>Contact No.:</strong> <?= $data['contact_no'] ?></p>
                            <p><strong>Address:</strong> <?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>,
                                <?= $data['city'] ?> <?= $data['province'] ?></p>
                        </div>
                    </div>
                    <div class="col mt-4 p-2 shadow-sm justify-content-center">
                        <div class="row me-4 ms-4 pt-2">
                            <h5>Additional Information</h5>
                            <hr>
                            <p><strong>Spouse</strong> : <?= $data['spouse'] ?></p>
                            <p><strong>Father's name:</strong> <?= $data['father'] ?></p>
                            <p><strong>Mother's name:</strong> <?= $data['mother'] ?></p>
                            <p><strong>Occupation:</strong> <?= $data['occupation'] ?></p>
                            <p><strong>Tribe:</strong> <?= $data['tribe'] ?></p>
                            <p><strong>School Level:</strong> <?= $data['school_level'] ?></p>
                            <p><strong>IP Scholar:</strong> <?= $data['ip_scholar'] ?></p>
                            <p><strong>IP Youth:</strong> <?= $data['ip_youth'] ?></p>
                            <p><strong>IP Women:</strong> <?= $data['ip_women'] ?></p>
                            <p><strong>PWD:</strong> <?= $data['pwd'] ?></p>
                            <p><strong>Senior Citizen:</strong> <?= $data['senior_citizen'] ?>
                            </p>
                            <p><strong>Senior Citizen Pensioner:</strong>
                                <?= $data['sc_pensioner'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id'] ?>"><i
                        class="fa-regular fa-pen-to-square"></i>Edit
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End View Modal -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal<?= $data['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="process.php?delete&id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
// Function to calculate age from birthdate
function calculateAge(birthday) {
    const birthDate = new Date(birthday);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();

    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    return age;
}

$(document).ready(function() {

    $('#edit-birthday').on('change', function() {
        const birthday = $(this).val();
        const age = calculateAge(birthday);
        $('#edit-age').val(age);

        if (age >= 70) {
            $('#edit-senior_C').prop('checked', true);
        } else {
            $('#edit-senior_C').prop('checked', false);
        }
    });

    $('#editModal<?= $data['id'] ?>').on('show.bs.modal', function(event) {
        const birthday = $('#edit-birthday').val();
        const age = calculateAge(birthday);
        $('#edit-age').val(age);

        if (age >= 70) {
            $('#edit-senior_C').prop('checked', true);
        } else {
            $('#edit-senior_C').prop('checked', false);
        }
    });
});
</script>
