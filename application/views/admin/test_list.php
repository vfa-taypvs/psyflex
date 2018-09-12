<?php include 'common/header.php' ?>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tests List
      </h1>
    </section>

    <?php
      if(isset($mess) && $mess != ''){
        echo '<div class="callout callout-info">';
        echo $mess;
        echo "</div>";
      }
    ?>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List </h3>
              <a href="<?php echo base_url(); ?>admin-questions"><button type="button" style="margin-left:100px"class="btn btn-primary">Add New</button></a>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Created Date</th>
                  <th>Test Name</th>
                  <th></th>
                </tr>
                <?php
                // print("<pre>".print_r($list_career,true)."</pre>");
                foreach ($list_test as $test) {
                  $cipherID = encrypted($test['item_id']);
                  echo "<tr>";
                  echo "<td>".$test['item_id']."</td>";
                  echo "<td>".$test['updated_date']."</td>";
                  echo "<td>".$test['title']."</td>";
                  echo "<td>";
                  echo "<div class='btn-group'>";
                  echo '<a href="'.base_url().'admin-questions?id='.$cipherID.'"><button type="button" class="btn btn-info">Edit</button></a>';
                  echo '<a href="'.base_url().'admin-questions/remove?id='.$cipherID.'"><button type="button" class="btn btn-info">Remove</button></a>';
                  echo "</div>";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'common/footer.php' ?>
