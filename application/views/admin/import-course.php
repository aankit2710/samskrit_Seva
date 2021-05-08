<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= SITENAME; ?> | Import CSV</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>public/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
              <h1 class="m-0 text-dark">Import Course CSV</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Import Course CSV</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <?php
              if (!empty($this->session->flashdata('msg'))) {
                echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>" . $this->session->flashdata('msg') . "</div>";
              }
              ?>

              <?php
              if (!empty($this->session->flashdata('success'))) {
                echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>" . $this->session->flashdata('success') . "</div>";
              }
              ?>
              <!-- jquery validation -->
              <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart('admin/import/createCourse'); ?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Import csv</label>
                        <input type="file" title="Import File" name="import_csv" id="import_csv" class="form-control <?php echo (form_error("import_csv") != "") ? 'is-invalid' : ''; ?>">
                        <span style="color:red;">Note : Please Upload only .csv file</span>
                      </div>
                      <?= form_error("import_csv"); ?>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Import csv</label>
                        <br>
                        <a href="<?= base_url() ?>data.csv" class="btn btn-primary" download>Download Csv</a>
                      </div>
                      <?= form_error("import_csv"); ?>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <?php $this->load->view('admin/sidebar'); ?>
    <!-- Main Footer -->
  </div>

  <!-- jQuery -->
  <script src="<?= base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>public/admin/dist/js/adminlte.min.js"></script>
</body>

</html>