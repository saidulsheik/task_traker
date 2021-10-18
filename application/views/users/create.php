<style>
.error{
		  color:red;
	  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add User</h3>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post" >
              <div class="box-body">
                <div class="form-group">
                  <label for="groups">Groups <span class="error">*</span></label>
                  <select class="form-control" id="groups" name="groups">
                    <option value="">Select Groups</option>
                    <?php foreach ($group_data as $k => $v): ?>
                      <option <?php echo set_select('groups', $v['id']);?> value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <span class="error"><?php echo form_error('groups'); ?></span>
                </div>

                <div class="form-group">
                  <label for="name">Name <span class="error">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" value="<?php echo set_value('name'); ?>" autocomplete="off">
                  <span class="error"><?php echo form_error('name'); ?></span>
                </div>

                <div class="form-group">
                  <label for="email">Email <span class="error">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" autocomplete="off">
                   <span class="error"><?php echo form_error('email'); ?></span>
                </div>

                <div class="form-group">
                  <label for="password">Password <span class="error">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" autocomplete="off">
                   <span class="error"><?php echo form_error('password'); ?></span>  
                </div>

                <div class="form-group">
                  <label for="cpassword">Confirm password <span class="error">*</span></label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" value="<?php echo set_value('cpassword'); ?>" placeholder="Confirm Password" autocomplete="off">
                  <span class="error"><?php echo form_error('cpassword'); ?></span> 
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#groups").select2();

    $("#mainUserNav").addClass('active');
    $("#createUserNav").addClass('active');
  
  });
</script>
