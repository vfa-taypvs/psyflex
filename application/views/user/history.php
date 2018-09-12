<?php include 'common/header.php' ?>
  <div class="main-content">
    <div class="container">
      <section class="content01 chapter">
        <h2>Your record</h2>
        <table>
          <tr>
            <th></th>
            <th></th>
            <th colspan="4" class="gray">Score</th>
          </tr>
          <tr>
            <th class="gray">Test name</th>
            <th class="gray">Date</th>
            <th class="color01">Adventure</th>
            <th class="color02">Protector</th>
            <th class="color03">Idealist</th>
            <th class="color04">Warrior</th>
          </tr>
          <?php for($i = 0; $i < sizeof ($results); $i++) {?>
          <tr>
            <td><?php echo $results[$i]['title']; ?></td>
            <td><?php echo $results[$i]['updated_date']; ?></td>
            <td><?php echo $results[$i]['point_1']; ?></td>
            <td><?php echo $results[$i]['point_2']; ?></td>
            <td><?php echo $results[$i]['point_4']; ?></td>
            <td><?php echo $results[$i]['point_5']; ?></td>
          </tr>

          <?php } ?>
        </table>
      </section>
    </div>
  </div>
</body>
</html>
