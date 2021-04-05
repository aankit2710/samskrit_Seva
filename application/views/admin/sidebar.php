 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="<?= base_url() ?>admin/home" class="brand-link bg-white">
     <img src="<?= base_url() ?>public/logo.png" class="img-fluid">
     <br>
     <span class="brand-text ml-4 text-center"><strong>samskritaseva</strong></span>
     <!-- <br>
      <span class="brand-text ml-4 text-center"><strong class="text-right">Enterprises</strong></span> -->
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
           <a href="<?= base_url() . 'admin/home/index'; ?>" class="nav-link">
             <i class="nav-icon far fa-circle"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>
         <?php if($type == 'admin') {?>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon far fa-circle"></i>
             <p>
               Users
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/users/index'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Users</p>
               </a>
             </li>
           </ul>
         </li>
         <?php } ?>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon far fa-circle"></i>
             <p>
               Courses
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/course/index'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Courses</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon far fa-circle"></i>
             <p>
               Donation
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/donation/index'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Donation</p>
               </a>
             </li>
           </ul>
         </li>
         <?php if($type === 'result'){ ?>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon far fa-circle"></i>
             <p>
               Result
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/result/index'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Results</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/failed/index'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Failed</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/reapear/index'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Re-apear</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url() . 'admin/import'; ?>" class="nav-link">
                 <i class="far fa-circle nav-icon text-danger"></i>
                 <p>Import</p>
               </a>
             </li>
           </ul>
         </li>
         <?php } ?>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>