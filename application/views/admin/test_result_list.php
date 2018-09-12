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

            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th></th>
                  <th>Test name</th>
                  <th>Participant</th>
                  <th>Date</th>
                  <th></th>
                </tr>
                <?php
                // print("<pre>".print_r($list_career,true)."</pre>");
                foreach ($results as $result) {
                  $cipherID = encrypted($result['id']);
                  echo "<tr>";
                  echo "<td>".$result['id']."</td>";
                  echo "<td></td>";
                  echo "<td>".$result['title']."</td>";
                  echo "<td>".$result['first_name']."</td>";
                  echo "<td>".$result['updated_date']."</td>";
                  echo "<td>";
                  echo "<div class='btn-group'>";
                  echo '<a href="'.base_url().'admin-test-results/detail?id='.$cipherID.'"><button type="button" class="btn btn-info">View Result</button></a>';
                  echo "</div>";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>

              </table>
            </div>
            <!-- /.box-body -->
            <!-- Calculate Pages -->
            <?php
              $totalPage  = ceil($pagesCount/$limit);
              $linkPre = $currentPage == 1 ? '#' : 'admin-test-results?page='.($currentPage - 1);
              $linkNext = $currentPage == $totalPage ? '#' : 'admin-test-results?page='.($currentPage + 1);
            ?>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="<?php echo $linkPre;?>">&laquo;</a></li>
                <?php
                for ($i = 1 ; $i <= $totalPage; $i++) {
                  $classActive = $i == $currentPage ? 'active' : '';
                  $urlPage = $i != $currentPage ? 'admin-test-results?page='.$i : '#' ;
                  echo '<li><a href="'.$urlPage.'" class="'.$classActive.'">'.$i.'</a></li>';
                }
                ?>
                <li><a href="<?php echo $linkNext;?>">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'common/footer.php' ?>
