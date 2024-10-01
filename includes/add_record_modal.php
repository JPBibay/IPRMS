<!-- Add Record Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addRecord" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="u-ID" value="<?= $_SESSION['u_id'] ?>">
                    <div class="container">
                        <div class="row">
                            <h5 class="mt-4">Personal Details</h5>
                            <div class="col-md-4 mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    placeholder="Enter the firstname" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="mname" name="mname"
                                    placeholder="Enter the middlename" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    placeholder="Enter the lastname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Others</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="add-birthday">Birthday</label>
                                <input type="date" class="form-control mb-3" id="add-birthday" name="birthday">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="add-age">Age</label>
                                <input type="number" class="form-control mb-3" id="add-age" name="age"
                                    placeholder="Enter your age" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Others</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="contact" class="form-label">Contact No.</label>
                                <input type="tel" class="form-control" list="contactOptions" id="contact" name="contact"
                                    placeholder="Enter the contact no." required>
                                <datalist id="contactOptions">
                                    <option value="N/A">N/A</option>
                                </datalist>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="purok" class="form-label">Purok</label>
                                <select class="form-select" id="purok" name="purok" required>
                                    <option value="" disabled selected>Select Purok</option>
                                    <?php
                                    include 'includes/conn.php';
                                    $userID = $_SESSION['u_id'];
                                    $select = $conn->prepare("SELECT * FROM purok WHERE user_id = ? ORDER BY purok ASC");
                                    $select->execute([$userID]);
                                    foreach ($select as $data) { ?>
                                    <option><?= $data['purok'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="barangay" class="form-label">Barangay</label>
                                <input type="text" class="form-control" id="barangay" name="barangay"
                                    placeholder="Enter your barangay" value="Oringao" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City/Municipality</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Enter your city/municipality" value="Kabankalan City" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    placeholder="Enter your province" value="Negros Occidental" required>
                            </div>
                        </div>
                        <h5 class="mt-4">Additional Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="spouse" class="form-label">Spouse Name</label>
                                <input type="text" class="form-control" list="spouseOptions" id="spouse" name="spouse"
                                    placeholder="Enter the spouse name">
                                <datalist id="spouseOptions">
                                    <option value="None">None</option>
                                </datalist>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="father" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="father" name="father"
                                    placeholder="Enter the father's name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mother" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" id="mother" name="mother"
                                    placeholder="Enter the mother's name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                    placeholder="Enter the occupation" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="school" class="form-label">School Level</label>
                                <input type="text" class="form-control" list="schoolOptions" id="school" name="school"
                                    placeholder="Enter your school level" required>
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
                                <input type="text" class="form-control" id="tribe" name="tribe" value="Bukidnon"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ip_scholar"
                                        name="ip_scholar" value="IP Scholar">
                                    <label for="ip_scholar" class="custom-control-label">IP Scholar</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ip_youth" name="ip_youth"
                                        value="IP Youth">
                                    <label for="ip_youth" class="custom-control-label">IP Youth</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="ip_women" name="ip_women"
                                        value="IP Women">
                                    <label for="ip_women" class="custom-control-label">IP Women</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="pwd" name="pwd" value="PWD">
                                    <label for="pwd" class="custom-control-label">PWD</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="add-senior_C" name="senior_C"
                                        value="Senior Citizen">
                                    <label for="add-senior_C" class="custom-control-label">Senior Citizen</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="SC_pensioner"
                                        name="SC_pensioner" value="Pensioner">
                                    <label for="SC_pensioner" class="custom-control-label">Senior Citizen
                                        Pensioner</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-record" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Record Modal -->



<!-- Add CSV Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addcsv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="u-ID" value="<?= $_SESSION['u_id'] ?>">
                    <div class="mb-3">
                        <label for="csv" class="form-label">CSV File</label>
                        <input type="file" class="form-control" id="csv" name="csv" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-csv" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add CSV Modal -->

<script>
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
    $('#add-birthday').on('change', function() {
        const birthday = $(this).val();
        const age = calculateAge(birthday);
        $('#add-age').val(age);

        if (age >= 70) {
            $('#add-senior_C').prop('checked', true);
        } else {
            $('#add-senior_C').prop('checked', false);
        }
        
    });
});
</script>