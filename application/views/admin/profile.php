<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?=SITENAME;?> | Profile</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>public/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <?php $this->load->view('admin/header');?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('admin/sidebar');?>
    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
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
              if(!empty($this->session->flashdata('msg')))
              {
                echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>".$this->session->flashdata('msg')."</div>";
              }
              ?>
              <?php
              if(!empty($this->session->flashdata('success')))
              {
                echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>".$this->session->flashdata('success')."</div>";
              }
              ?>
              <!-- jquery validation -->
              <div class="card card-info">
<!--                 <div class="card-header">
                  <div class="card-tools">
                    <a class="btn btn-success" href="<?=base_url().'admin/staff/index';?>"><i class="fas fa-previous"></i> Back</a>
                  </div>
                </div> -->
                <!-- /.card-header -->
                <!-- form start -->
                <?=form_open_multipart('admin/home/profile/'.$profile['id']);?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" placeholder="Name" name="name" id="name" class="form-control" value="<?=set_value('name',$profile['name']);?>">
                      </div>
                      <?=form_error("name");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">UserName</label>
                        <input type="text" placeholder="UserName" name="username" id="username" class="form-control" value="<?=set_value('username',$profile['username']);?>">
                      </div>
                      <?=form_error("username");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Type</label>
                        <input type="text" placeholder="Type" name="type" id="type" class="form-control" value="<?=set_value('type',$profile['type']);?>" disabled="disabled">
                      </div>
                      <?=form_error("type");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Email</label>
                        <input type="text" placeholder="Email" name="email" id="email" class="form-control" value="<?=set_value('email',$profile['email']);?>">
                      </div>
                      <?=form_error("email");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Phone Number</label>
                        <input type="text" placeholder="Phone Number" name="phone" id="phone" class="form-control" value="<?=set_value('phone',$profile['phone_number']);?>">
                      </div>
                      <?=form_error("phone");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Profile Image</label>
                        <input type="file" name="image" id="category_image" class="form-control">
                        <?php echo (!empty($errorImageUpload)) ?$errorImageUpload:''; ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Password</label>
                        <input type="text" placeholder="Password" name="password" id="password" class="form-control" value="">
                        <span style="color: red;">Note : Please dont fill Password If You dont want to change password.</span>
                      </div>
                      <?=form_error("password");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Confirm Password</label>
                        <input type="text" placeholder="Confirm Password" name="cpassword" id="password" class="form-control" value="">
                      </div>
                      <?=form_error("cpassword");?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Protection Password</label>
                        <input type="text" placeholder="Protection Password" name="protection_password" id="password" class="form-control" value="">
                        <span style="color: red;">Note : Please dont fill Password If You dont want to change password.</span>
                      </div>
                      <?=form_error("password");?>
                    </div>
                    <?php if($profile['profile_image']!="" && file_exists('./public/uploads/profile/thumb/'.$profile['profile_image'])){?>
                      <img src="<?=base_url().'public/uploads/profile/thumb/'.$profile['profile_image']?>" alt="No image found">
                      <?php
                    }else{
                      ?>
                      <img src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif" alt="No image found">
                      <?php
                    }
                    ?>
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
  <?php $this->load->view('admin/sidebar');?>
  <!-- Main Footer -->
</div>

<!-- jQuery -->
<script src="<?=base_url()?>public/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>public/admin/dist/js/adminlte.min.js"></script>
</body>
</html>
