<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= SITENAME; ?> | Donation</title>
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
              <h1 class="m-0 text-dark">Donation</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Donation</li>
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
              if (@!empty($getAllResult)) {
              ?>
                <div class="card" id="display_details">
                  <div class="card-header">
                    <div class="card-tools">
                      <!-- <span style="margin-right: 745px;"><strong>Date :</strong>  <?= date('Y-m-d'); ?></span> -->
                      <button onclick="javascript:window.print();" class="btn btn-info">PDF</button>
                      <a id="export_csv" href="#" class="btn btn-danger"><i class="fas fa-plus"></i> Export</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="example" class="table table-bordered table-striped export">
                      <thead>
                        <tr>
                          <th>Donor Name</th>
                          <th>Father or Husband's name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Full Address</th>
                          <th>Purpose</th>
                          <th>PAN number</th>
                          <th>Donate amount</th>
                          <th>Payment Status</th>
                          <th>Donated On</th>
                          <th>Invoice Number</th>
                          <th>Payment Txn ID</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($getAllResult as $balancesheet) {
                          $total[] = $balancesheet['donations_amount'];
                        ?>
                          <tr>
                            <td><?= $balancesheet['donations_name']; ?></td>
                            <td><?= $balancesheet['donations_surname']; ?></td>
                            <td><?= $balancesheet['donations_email']; ?></td>
                            <td><?= $balancesheet['donations_phone']; ?></td>
                            <td><?= $balancesheet['donations_address']; ?></td>
                            <td><?= $balancesheet['donations_reason']; ?></td>
                            <td><?= $balancesheet['donations_pan']; ?></td>
                            <td><?= $balancesheet['donations_amount']; ?></td>
                            <td><?= $balancesheet['donations_paymentstatus']; ?></td>
                            <td><?= $balancesheet['donations_donatedon']; ?></td>
                            <td><?= $balancesheet['donations_invoicenumber']; ?></td>
                            <td><?= $balancesheet['donations_paymenttxnid']; ?></td>
                          </tr>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                      <tr>
                        <td colspan="4">Total Donations</td>
                        <td>₹<?= number_format(array_sum($total), 2); ?></td>
                      </tr>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://www.jqueryscript.net/demo/table-csv-converter/table2csv.js"></script>
<script>
  $('#export_csv').on('click',function(){
    $('#example').table2csv({
      file_name: 'donation.csv',
      header_body_space: 0
    });
  })
  </script>
</body>

</html>