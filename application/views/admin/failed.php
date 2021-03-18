<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?=SITENAME;?> | Courses</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>public/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
              <h1 class="m-0 text-dark">Courses</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Courses</li>
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
              if(!empty($this->session->flashdata('error')))
              {
               echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>".$this->session->flashdata('error')."</div>";
             }
             ?>
             <?php
             if(!empty($this->session->flashdata('success')))
             {
               echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>".$this->session->flashdata('success')."</div>";
             }
             ?>
             <?=form_open_multipart('admin/failed/index');?>
             <div class="card-body">
              <div class="row">
               <div class="col-md-3">
                <div class="form-group">
                  <label for="inputName">Month</label>
                  <select class="form-control" name="month">
                    <?php $month_names = array("January","July");?>
                    <option value="">Choose Value</option>
                    <?php
                    $i=1;
                    foreach($month_names as $month)
                    {
                      echo "<option value=".$i.">".$month."</option>";
                      $i++;
                    }
                    ?>
                  </select>
                </div>
                <?=form_error("month");?>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputName">Year</label>
                  <input type="number" class="form-control" name="year" value="" placeholder="Year">
                </div>
                <?=form_error("year");?>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputName">Courses</label>
                  <select class="form-control" name="course">
                    <option value="">Choose Value</option>
                    <?php
                    $i=1;
                    foreach($getAllCourse as $Courses)
                    {
                      $courseDetails = $Courses['COURSE'];?>
                      <option value="<?=$courseDetails?>"><?=$courseDetails?></option><?php
                      $i++;
                    }
                    ?>
                  </select>
                </div>
                <?=form_error("month");?>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <br>
                  <input type="submit" name="submit" value="submit" class="btn btn-danger">
                </div>
                <?=form_error("type");?>
              </div>
            </div>
          </div>
        </form>
        <?php
        if(@!empty($getAllResult)){
         ?>
         <div class="card" id="display_details">
          <div class="card-header">
            <div class="card-tools">
              <!-- <span style="margin-right: 745px;"><strong>Date :</strong>  <?=date('Y-m-d');?></span> -->
              <button onclick="javascript:window.print();" class="btn btn-info">PDF</button>
               <a id="export_csv" href="#" class="btn btn-danger"><i class="fas fa-plus"></i> Export</a>
            </div>
          </div>
          <div class="card-body">
            <table id="example" class="table table-bordered table-striped export">
              <thead>
                <tr>
                  <th>S.no</th>
                  <th>REG_NO</th>
                  <th>Name</th>
                  <th>COURSE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // $i=1;
                foreach($getAllResult as $balancesheet){
                  ?>
                  <tr>
                    <td><?=$balancesheet['id']?></td>
                    <td><?=$balancesheet['REG_NO']?></td>
                    <td><?=$balancesheet['NAME']?></td>
                    <td><?=$balancesheet['COURSE']?></td>
                  </tr>
                  <?php
                  // $i++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php
      }else{
       echo "<h1 class='text-center'>No Data Found</h1>";
     }
     ?>
   </div>
 </div>
</div>
</div>
</div>
<!-- Main Footer -->
<?php $this->load->view('admin/footer');?>
<!-- Main Footer -->
</div>
<!-- jQuery -->
<script src="<?=base_url()?>public/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>public/admin/dist/js/adminlte.min.js"></script>
<script src="<?=base_url()?>public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>public/admin/export_csv_plugin.js"></script>
<script src="<?=base_url()?>public/jquery.tabledit.js"></script>
<script>
  $(function () {
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

  $(document).ready(function(){
    $('#example').Tabledit({
      deleteButton: false,
      editButton: true,      
      columns: {
        identifier: [0, 'id'],                    
        editable: [[0,'id'],[1,'REG_NO'], [2,'Name'],[3, 'COURSE']]
      },
      hideIdentifier: false,
      url: '<?=base_url(); ?>admin/failed/update'   
    });
  });

  function filter_data()
  {
   var branch_id = $('#branch_id').val();

   if(branch_id!="")
   {
    $.ajax({
     url:"<?=base_url(); ?>admin/failed/filter",
     method:"POST",
     dataType:"html",
     data:{branch_id:branch_id},
     success:function(data)
     {	
      $('#append_data').empty();
      $('#append_data').html(data);
      $('#display_details').show();
    }
  });
  }else{
    $('#display_details').hide();
  } 

}

$('#export_csv').click(function(){
   $.exportCSV(
    [
                this, //Do not change
                '.export', //Selected table, Required, Type: string
                5, //All columns number,  Required, Type: number
                ['S.no','REG_NO', 'NAME', 'COURSE','ACTION'],  //Column names, Required, Type: array
                'export', //The download prefix name, Required, Default: 'download', Type: string
                '-', // A date separator in a file, Default: '-', Type: string
                '_', // A time separator in a file, Default: '_', Type: string
                10 // The length of random digits, Default: 6, Type: number
                ]
                );
 })

$('#pay_emis').click(function () { 
 var all_ids = get_filter("pay_emis");
 if(all_ids!="")
 {

   if(confirm("Are You Sure Want To Pay All Emi"))
   {
    $.ajax({
     url:"<?=base_url(); ?>admin/member/pay_emi_bulk",
     method:"POST",
     data:{emi_ids:all_ids},
     success:function(data)
     {
      alert("Paid Successfully");
    }
  });
  }

}else{
  alert("Please Select Emi");
}  
});

function get_filter(class_name)
{
 var filter = [];
 $('.'+class_name+':checked').each(function(){
  filter.push($(this).val());
});
 return filter;
}
</script>
</body>
</html>