<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= SITENAME; ?> | Course</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>public/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('admin/header'); ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php $this->load->view('admin/sidebar'); ?>
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Course</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Course</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <?php
              if (!empty($this->session->flashdata('error'))) {
                echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>" . $this->session->flashdata('error') . "</div>";
              }
              ?>
              <?php
              if (!empty($this->session->flashdata('success'))) {
                echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>" . $this->session->flashdata('success') . "</div>";
              }
              ?>
              <?php
              if (@!empty($getAllCourse)) {
              ?>
                <div class="card" id="display_details">
                  <div class="card-header">
                    <div class="card-tools">
                      <!-- <span style="margin-right: 745px;"><strong>Date :</strong>  <?= date('Y-m-d'); ?></span> -->
                      <button onclick="javascript:window.print();" class="btn btn-info">PDF</button>
                      <a id="export_csv" href="#" class="btn btn-danger"><i class="fas fa-plus"></i> Export</a>
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                Add Course Details
                              </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="example" class="table table-bordered table-striped export">
                      <thead>
                        <tr>
                          <th>Course ID</th>
                          <th>Course Name</th>
                          <th>Student Name</th>
                          <th>Address</th>
                          <th>Occupation</th>
                          <th>Qualification</th>
                          <th>Gender</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>DOB</th>
                          <th>Medium Study</th>
                          <th>Exam Month</th>
                          <th>Course Preferred Time</th>
                          <th>Registered On</th>
                          <th>Transaction ID</th>
                          <th>Status</th>
                          <th>Course Amount</th>
                          <th>Net Amount</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($getAllCourse as $balancesheet) {
                        ?>
                          <tr>
                            <td><?= $balancesheet['student_course_courseid']; ?></td>
                            <td><?= $balancesheet['student_course_coursename']; ?></td>
                            <td><?= $balancesheet['student_profile_name']; ?> <?= $balancesheet['student_profile_lastname']; ?></td>
                            <td><?= $balancesheet['student_profile_address']; ?>, <?= $balancesheet['student_profile_district']; ?>, <?= $balancesheet['student_profile_state']; ?>, <?= $balancesheet['student_profile_pincode']; ?></td>
                            <td><?= $balancesheet['student_profile_occupation']; ?></td>
                            <td><?= $balancesheet['student_profile_qualification']; ?></td>
                            <td><?= $balancesheet['student_profile_gender']; ?></td>
                            <td><?= $balancesheet['student_profile_phone']; ?></td>
                            <td><?= $balancesheet['student_profile_email']; ?></td>
                            <td><?= $balancesheet['student_profile_dob']; ?></td>
                            <td><?= $balancesheet['student_course_medium_study']; ?></td>
                            <td><?= $balancesheet['student_course_month']; ?></td>
                            <td><?= $balancesheet['student_course_preferredtime']; ?></td>
                            <td><?= $balancesheet['student_course_registedon']; ?></td>
                            <td><?= $balancesheet['student_course_ss_txnid']; ?></td>
                            <td><?= ucfirst($balancesheet['student_course_paymentstatus']); ?></td>
                            <td>Rs. <?= $balancesheet['student_course_amount']; ?></td>
                            <td>Rs. <?= $balancesheet['student_course_net_amount']; ?></td>
                            <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?= $balancesheet['student_course_courseid']; ?>">
                                edit Course Details
                              </button></td>
                          </tr>
                          <div class="modal fade" id="modal-default<?= $balancesheet['student_course_courseid']; ?>">
                            <div class="modal-dialog modal-lg" style="max-width: 90%;">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Course Details</h4>
                                  <h5>Course Id: <?= $balancesheet['student_course_courseid']; ?></h5>
                                </div>
                                <div class="modal-body">
                                  <form autocomplete="off" id="registrationForm" action="" method="post">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="reg_name">Full Name</label>
                                              <input type="text" name="reg_name" value="<?= $balancesheet['student_profile_name']." ".$balancesheet['student_profile_lastname']; ?>" class="form-control" id="reg_name" placeholder="Enter First Name">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_dob">Date of Birth</label>
                                          <input type="date" class="form-control" value="student_profile_dob" name="reg_dob" id="reg_dob" placeholder="Enter Date of Birth">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_gender">Gender</label>
                                          <select name="reg_gender" class="custom-select">
                                              <option value="" selected>Select Gender</option>
                                              <option <?php $balancesheet['student_profile_gender'] == "Male"  ? "selected" : ''; ?> value="Male">Male</option>
                                              <option <?php $balancesheet['student_profile_gender'] == "Female"  ? "selected" : ''; ?> value="Female">Female</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_phone">Mobile Number<span style="font-size: 11px;"> (WhatsApp Preferred)</label>
                                          <input type="tel" maxlength="10" name="reg_phone" value="<?= $balancesheet['student_profile_phone'] ?>" class="form-control numbers-only" id="reg_phone" placeholder="Enter Phone/Whatsapp">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_email">Email</label>
                                          <input type="email" class="form-control" value="<?= $balancesheet['student_profile_email'] ?>" name="reg_email" id="reg_email" placeholder="Enter Email">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_Qualification">Qualification</label>
                                          <input type="text" class="form-control" value="<?= $balancesheet['student_profile_qualification'] ?>" name="reg_Qualification" id="reg_Qualification" placeholder="Enter Qualification">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_occupation">Occupation</label>
                                          <input type="text" class="form-control" value="<?= $balancesheet['student_profile_occupation'] ?>" name="reg_occupation" id="reg_occupation" placeholder="Enter Occupation">
                                        </div>
                                      </div>
                                      <div class="col-md-8">
                                        <div class="form-group">
                                          <label for="reg_address">Address (Door/Flat No, Flat/House Name, Street Name, Village/Town/City)</label>
                                          <input type="text" class="form-control" value="<?= $balancesheet['student_profile_address'] ?>" name="reg_address" id="reg_address" placeholder="Enter Address">
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="reg_district">District</label>
                                          <select name="reg_district" id="reg_district" class="custom-select">
                                            <option value="" selected>Select District</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Chengleput"  ? "selected" : ''; ?> value="Chengleput">Chengleput</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Chennai"  ? "selected" : ''; ?> value="Chennai">Chennai</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Cuddalore"  ? "selected" : ''; ?> value="Cuddalore">Cuddalore</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Dharmapuri"  ? "selected" : ''; ?> value="Dharmapuri">Dharmapuri</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Kallakurichi"  ? "selected" : ''; ?> value="Kallakurichi">Kallakurichi</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Kanchipuram"  ? "selected" : ''; ?> value="Kanchipuram">Kanchipuram</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Krishnagiri"  ? "selected" : ''; ?> value="Krishnagiri">Krishnagiri</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Namakkal"  ? "selected" : ''; ?> value="Namakkal">Namakkal</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Puducherry"  ? "selected" : ''; ?> value="Puducherry">Puducherry</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Ranipet"  ? "selected" : ''; ?> value="Ranipet">Ranipet</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Salem"  ? "selected" : ''; ?> value="Salem">Salem</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Thiruvallur"  ? "selected" : ''; ?> value="Thiruvallur">Thiruvallur</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Tirupattur"  ? "selected" : ''; ?> value="Tirupattur">Tirupattur</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Tiruvannamalai"  ? "selected" : ''; ?> value="Tiruvannamalai">Tiruvannamalai</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Vellore"  ? "selected" : ''; ?> value="Vellore">Vellore</option>
                                            <option <?php $balancesheet['student_profile_district'] == "Villupuram"  ? "selected" : ''; ?> value="Villupuram">Villupuram</option>
                                            <option <?php $balancesheet['student_profile_district'] == "others-districts-tn"  ? "selected" : ''; ?> value="others-districts-tn">Other Districts of Tamilnadu</option>
                                            <option <?php $balancesheet['student_profile_district'] == "others"  ? "selected" : ''; ?> value="others">Other States Of India</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="reg_state">State</label>
                                          <select name="reg_state" id="reg_state" class="custom-select">
                                            <option value="">Select State</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Andaman & Nicobar"  ? "selected" : ''; ?>>Andaman & Nicobar</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Andhra Pradesh"  ? "selected" : ''; ?>>Andhra Pradesh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Arunachal Pradesh"  ? "selected" : ''; ?>>Arunachal Pradesh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Assam"  ? "selected" : ''; ?>>Assam</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Bihar"  ? "selected" : ''; ?>>Bihar</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Chandigarh"  ? "selected" : ''; ?>>Chandigarh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Chhattisgarh"  ? "selected" : ''; ?>>Chhattisgarh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Dadra & Nagar Haveli"  ? "selected" : ''; ?>>Dadra & Nagar Haveli</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Daman & Diu"  ? "selected" : ''; ?>>Daman & Diu</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Delhi"  ? "selected" : ''; ?>>Delhi</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Goa"  ? "selected" : ''; ?>>Goa</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Gujarat"  ? "selected" : ''; ?>>Gujarat</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Haryana"  ? "selected" : ''; ?>>Haryana</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Himachal Pradesh"  ? "selected" : ''; ?>>Himachal Pradesh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Jammu & Kashmir"  ? "selected" : ''; ?>>Jammu & Kashmir</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Jharkhand"  ? "selected" : ''; ?>>Jharkhand</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Karnataka"  ? "selected" : ''; ?>>Karnataka</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Kerala"  ? "selected" : ''; ?>>Kerala</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Lakshadweep"  ? "selected" : ''; ?>>Lakshadweep</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Madhya Pradesh"  ? "selected" : ''; ?>>Madhya Pradesh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Maharashtra"  ? "selected" : ''; ?>>Maharashtra</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Manipur"  ? "selected" : ''; ?>>Manipur</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Meghalaya"  ? "selected" : ''; ?>>Meghalaya</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Mizoram"  ? "selected" : ''; ?>>Mizoram</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Nagaland"  ? "selected" : ''; ?>>Nagaland</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Orissa"  ? "selected" : ''; ?>>Orissa</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Pondicherry"  ? "selected" : ''; ?>>Pondicherry</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Punjab"  ? "selected" : ''; ?>>Punjab</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Rajasthan"  ? "selected" : ''; ?>>Rajasthan</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Sikkim"  ? "selected" : ''; ?>>Sikkim</option>
                                            <option value="Tamil Nadu" <?php $balancesheet['student_profile_state'] == "Tamil Nadu"  ? "selected" : ''; ?>>Tamil Nadu</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Tripura"  ? "selected" : ''; ?>>Tripura</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Uttar Pradesh"  ? "selected" : ''; ?>>Uttar Pradesh</option>
                                            <option <?php $balancesheet['student_profile_state'] == "Uttaranchal"  ? "selected" : ''; ?>>Uttaranchal</option>
                                            <option <?php $balancesheet['student_profile_state'] == "West Bengal"  ? "selected" : ''; ?>>West Bengal</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="reg_pincode">Pincode</label>
                                          <input type="number" onKeyPress="if(this.value.length==6) return false;" min="110001" max="859999" value="<?$balancesheet['student_profile_pincode']?>" class="form-control numbers-only" name="reg_pincode" id="reg_pincode" placeholder="Enter Pincode">
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="reg_country">Country</label>
                                          <input type="text" class="form-control" value="<?= $balancesheet['student_profile_country'] ?>" name="reg_country" id="reg_country" placeholder="Enter Country">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <h4>Course Details</h4>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="reg_courses">Courses</label>
                                            <select name="reg_courses" id="reg_courses" class="custom-select">
                                              <optgroup label="Module 1">
                                                <option value="Pravesha" >Pravesha</option>
                                              </optgroup>
                                              <optgroup label="Module 2">
                                                <option value="Gita Shikshanakendram Level 1">Gita Shikshanakendram Level 1 - Prak Sopanam (Level 1)</option>
                                                <option value="Gita Shikshanakendram Level 2">Gita Shikshanakendram Level 2 - Bhasha Pravesha 1</option>
                                              </optgroup>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_medium">Medium of Study (books - only for Module 1)</label>
                                         <select name="reg_medium" id="reg_medium" class="custom-select">
                                              <option value="" selected>Select Medium of Study (books)</option>
                                              <option <?php $balancesheet['student_course_medium_study'] == "Tamil"  ? "selected" : ''; ?> value="Tamil">Tamil</option>
                                              <option <?php $balancesheet['student_course_medium_study'] == "Samskrit"  ? "selected" : ''; ?> value="Samskrit">Samskrit</option>
                                              <option <?php $balancesheet['student_course_medium_study'] == "English"  ? "selected" : ''; ?> value="English">English</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_examinationmonth">Examination Month</label>
                                          <select name="reg_examinationmonth" class="custom-select">
                                              <option value="" selected>Select Month</option>
                                              <option <?php $balancesheet['student_course_month'] == "Jan"  ? "selected" : ''; ?> value="Jan">Jan</option>
                                              <option <?php $balancesheet['student_course_month'] == "July"  ? "selected" : ''; ?> value="July">July</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="reg_preftime">Preferred Time for Class</label>
                                          <select name="reg_preftime" class="custom-select">
                                              <option value="" selected>Select Preferred Time for Class</option>
                                              <option <?php $balancesheet['student_course_preferredtime'] == "Morning"  ? "selected" : ''; ?> value="Morning">Morning</option>
                                              <option <?php $balancesheet['student_course_preferredtime'] == "Evening"  ? "selected" : ''; ?> value="Evening">Evening</option>
                                              <option <?php $balancesheet['student_course_preferredtime'] == "Anytime"  ? "selected" : ''; ?> value="Anytime">Anytime</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 text-right">
                                        
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button type="submit" name="register_form_submit" id="register-now" class="btn btn-success submit-btn btn-bold">Proceed</button>
                                       
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php
              } else {
                echo "<h1 class='text-center'>No Data Found</h1>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Main Footer -->
    <?php $this->load->view('admin/footer'); ?>
    <!-- /.modal -->
    <!-- Main Footer -->
  </div>
  <!-- jQuery -->
  <script src="<?= base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>public/admin/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url() ?>public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>public/admin/export_csv_plugin.js"></script>
  <script src="<?= base_url() ?>public/jquery.tabledit.js"></script>
  <script>
    $(function() {
      $("#example").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    // $(document).ready(function(){
    //   $('#example').Tabledit({
    //     deleteButton: false,
    //     editButton: true,      
    //     columns: {
    //       identifier: [0, 'id'],                    
    //       editable: [[0,'id'],[1,'REG_NO'], [2,'Name'],[3, 'COURSE'],[4,'GRADE'],[5,'ACTION']]
    //     },
    //     hideIdentifier: false,
    //     url: '<?= base_url(); ?>admin/balancesheet/update'   
    //   });
    // });

    function filter_data() {
      var branch_id = $('#branch_id').val();

      if (branch_id != "") {
        $.ajax({
          url: "<?= base_url(); ?>admin/result/filter",
          method: "POST",
          dataType: "html",
          data: {
            branch_id: branch_id
          },
          success: function(data) {
            $('#append_data').empty();
            $('#append_data').html(data);
            $('#display_details').show();
          }
        });
      } else {
        $('#display_details').hide();
      }

    }

    $('#pay_emis').click(function() {
      var all_ids = get_filter("pay_emis");
      if (all_ids != "") {

        if (confirm("Are You Sure Want To Pay All Emi")) {
          $.ajax({
            url: "<?= base_url(); ?>admin/member/pay_emi_bulk",
            method: "POST",
            data: {
              emi_ids: all_ids
            },
            success: function(data) {
              alert("Paid Successfully");
            }
          });
        }

      } else {
        alert("Please Select Emi");
      }
    });

    function get_filter(class_name) {
      var filter = [];
      $('.' + class_name + ':checked').each(function() {
        filter.push($(this).val());
      });
      return filter;
    }
  </script>
</body>

</html>