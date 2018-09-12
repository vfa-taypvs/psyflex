<?php include 'common/header.php' ?>
  <div class="main-content">
    <div class="container">
      <section class="content01 chapter">

        <h2>Your record</h2>
        <?php
          // print("<pre>".print_r($results,true)."</pre>");
          $pointA_x = $results[0]['point'];
          $pointA_y = $results[1]['point'];
          $pointB_x = $results[3]['point'];
          $pointB_y = $results[4]['point'];
          $colorPointA = "";
          $colorPointB = "";

          $solution = $this->lang->line('you_are')." ";
          $solution2 = $this->lang->line('you_are')." ";
          // Set color point A
          if (($pointA_x + $pointA_y) > 0) {
            $colorPointA = $results[0]['color'];
            $solution = $solution.$results[0]['name'].": ".$results[0]['explanation'];
          } else if (($pointA_x + $pointA_y) < 0) {
            $colorPointA = $results[1]['color'];
            $solution = $solution.$results[0]['name'].": ".$results[1]['explanation'];
          } else  {
            $colorPointA = $results[2]['color'];
            $solution = $solution.$results[0]['name'].": ".$results[2]['explanation'];
          }

          // Set color point B
          if (($pointB_x + $pointB_y) > 0) {
            $colorPointB = $results[3]['color'];
            $solution2 = $solution2.$results[0]['name'].": ".$results[3]['explanation'];
          } else if (($pointB_x + $pointB_y) < 0) {
            $colorPointB = $results[4]['color'];
            $solution2 = $solution2.$results[0]['name'].": ".$results[4]['explanation'];
          } else  {
            $colorPointB = $results[5]['color'];
            $solution2 = $solution2.$results[0]['name'].": ".$results[5]['explanation'];
          }

        ?>
        <table>

          <tr>
            <th class="color01" style="background-color: <?php echo $results[0]['color'];?>"><?php echo $results[0]['name'];?></th>
            <th class="color01" style="background-color: <?php echo $results[0]['color'];?>"><?php echo $pointA_x;?></th>
            <th class="color02" style="background-color: <?php echo $results[1]['color'];?>"><?php echo $results[1]['name'];?></th>
            <th class="color02" style="background-color: <?php echo $results[1]['color'];?>"><?php echo $pointA_y;?></th>
            <th class="color03" style="background-color: <?php echo $results[3]['color'];?>"><?php echo $results[3]['name'];?></th>
            <th class="color03" style="background-color: <?php echo $results[3]['color'];?>"><?php echo $pointB_x;?></th>
            <th class="color04" style="background-color: <?php echo $results[4]['color'];?>"><?php echo $results[4]['name'];?></th>
            <th class="color04" style="background-color: <?php echo $results[4]['color'];?>"><?php echo $pointB_y;?></th>
          </tr>
          <tr>
            <td colspan="3">Result</td>
            <td><?php echo ($pointA_x + $pointA_y);?></td>
            <td colspan="3">Result</td>
            <td><?php echo ($pointB_x + $pointB_y);?></td>
          </tr>
        </table>

        <div id="animatedshapes_div" style="width: 900px; height: 500px;"></div>


        <div>
          <h2 style="color:<?php echo $colorPointA;?>"><?php echo $solution;?></h2>
          <h2 style="color:<?php echo $colorPointB;?>"><?php echo $solution2;?></h2>
        </div>

      </section>
    </div>
  </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      var data = new google.visualization.arrayToDataTable
            ([['X', '', ''],
              [<?php echo $pointA_x;?>, <?php echo $pointA_y;?>, null],
              [<?php echo $pointB_x;?>, null, <?php echo $pointB_y;?>]
        ]);
      // data.addColumn('number');
      // data.addColumn('number');
      //
      // // Our central point, which will jiggle.
      // data.addRow([<?php echo $pointA_x;?>, <?php echo $pointA_y;?>]);
      // data.addRow([<?php echo $pointB_x;?>, <?php echo $pointB_y;?>]);


      var chart = new google.visualization.ScatterChart(document.getElementById('animatedshapes_div'));

      var options = {
        legend: 'none',
        colors: ['<?php echo $colorPointA; ?>','<?php echo $colorPointB; ?>'],
        pointShape: 'point',
        series: {
                0: { colors: [''] },
                1: { colors: [''] }
              },
        pointSize: 18,
        animation: {
          duration: 200,
          easing: 'inAndOut',
        }
      };


      chart.draw(data, options);


    }
  </script>
</body>
</html>
