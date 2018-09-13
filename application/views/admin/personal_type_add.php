<?php include 'common/header.php' ?>
<script src="<?php echo base_url(); ?>asset/js/admin/index.js"></script>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Personals Type
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <form action="<?php echo base_url(); ?>adminResultList/addType" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="form-group">
              <label>Personal Type Name</label>
              <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="English ..." name="personal_name_en" value="" />
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="France ..." name="personal_name_fr" value="" />
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="Vietnamese ..." name="personal_name_vi" value="" />
                </div>
              </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Submit"/>
          </form>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <?php include 'common/footer.php' ?>
