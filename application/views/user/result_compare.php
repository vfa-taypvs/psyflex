<?php include 'common/header.php' ?>
  <div class="main-content">
    <div class="container">
      <section class="content01 chapter">

        <h2>Your record</h2>
        <?php
          // print("<pre>".print_r($results,true)."</pre>");
          $pointA_x = $results_1[0]['point'];
          $pointA_y = $results_1[1]['point'];
          $pointB_x = $results_1[3]['point'];
          $pointB_y = $results_1[4]['point'];
          $colorPointA = "";
          $colorPointB = "";

          $solution = $this->lang->line('you_are')." ";
          $solution2 = $this->lang->line('you_are')." ";
          // Set color point A
          if (($pointA_x + $pointA_y) > 0) {
            $colorPointA = $results_1[0]['color'];
          } else if (($pointA_x + $pointA_y) < 0) {
            $colorPointA = $results_1[1]['color'];
          } else  {
            $colorPointA = $results_1[2]['color'];
          }

          // Set color point B
          if (($pointB_x + $pointB_y) > 0) {
            $colorPointB = $results_1[3]['color'];
          } else if (($pointB_x + $pointB_y) < 0) {
            $colorPointB = $results_1[4]['color'];
          } else  {
            $colorPointB = $results_1[5]['color'];
          }

          $final_point_X = $pointA_x + $pointA_y;
          $final_point_Y = $pointB_x + $pointB_y;
          $final_color = ($pointA_x + $pointA_y) >= ($pointB_x + $pointB_y) ? $colorPointA : $colorPointB;


          // ========  Point 2
          // print("<pre>".print_r($results,true)."</pre>");
          $pointA_x_2 = $results_2[0]['point'];
          $pointA_y_2 = $results_2[1]['point'];
          $pointB_x_2 = $results_2[3]['point'];
          $pointB_y_2 = $results_2[4]['point'];
          $colorPointA_2 = "";
          $colorPointB_2 = "";

          // Set color point A
          if (($pointA_x_2 + $pointA_y_2) > 0) {
            $colorPointA_2 = $results_2[0]['color'];
          } else if (($pointA_x_2 + $pointA_y_2) < 0) {
            $colorPointA_2 = $results_2[1]['color'];
          } else  {
            $colorPointA_2 = $results_2[2]['color'];
          }

          // Set color point B
          if (($pointB_x_2 + $pointB_y_2) > 0) {
            $colorPointB_2 = $results_2[3]['color'];
          } else if (($pointB_x_2 + $pointB_y_2) < 0) {
            $colorPointB_2 = $results_2[4]['color'];
          } else  {
            $colorPointB_2 = $results_2[5]['color'];
          }

          $final_point_X_2 = $pointA_x_2 + $pointA_y_2;
          $final_point_Y_2 = $pointB_x_2 + $pointB_y_2;
          $final_color_2 = ($pointA_x_2 + $pointA_y_2) >= ($pointB_x_2 + $pointB_y_2) ? $colorPointA_2 : $colorPointB_2;
        ?>

        <div>
        <!-- <div id="animatedshapes_div" style="width: 900px; height: 500px;"></div> -->

        <canvas id="myCanvas" width="1080" height="678"></canvas>

      </section>
    </div>
  </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable
            ([['X', ''],
              [<?php echo $final_point_X;?>, <?php echo $final_point_Y;?>]
              // , [<?php // echo $pointB_x;?>, null, <?php // echo $pointB_y;?>]
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
        // colors: ['<?php // echo $colorPointA; ?>','<?php //echo $colorPointB; ?>'],
        colors: ['<?php echo $final_color; ?>'],
        pointShape: 'point',
        series: {
                0: {targetAxisIndex: 0},
                1: {targetAxisIndex: 1}
        },
        hAxis: {title: 'Hours Studied'},
        vAxes: {
          // Adds titles to each axis.
          0: {title: 'Hours Studied'},
          1: {title: 'Final Exam Grade'}
        },
        pointSize: 18,
        animation: {
          duration: 200,
          easing: 'inAndOut',
        }
      };


      chart.draw(data, options);


    }
  </script> -->


  <script>
    // Point 1
    var result_X = <?php echo $final_point_X;?>;
    var result_Y = <?php echo $final_point_Y;?>;
    var biggerV = Math.abs(result_X) > Math.abs(result_Y) ? Math.abs(result_X) : Math.abs(result_Y);
    var density = getDensity(biggerV, 15);

    var margin_width = 180;
    var margin_height = 100;
    var space_width = 30;
    var space_height = 30;

    var canvas_width = $('#myCanvas').width();
    var canvas_height = $('#myCanvas').height();

    var point_root_X = canvas_width/2;
    var point_root_Y = canvas_height/2;

    var graph_width = canvas_width/2 - margin_width - space_width;
    var graph_height = canvas_height/2 - margin_height - space_height;

    var canvas = document.getElementById('myCanvas');
    var context = canvas.getContext('2d');

    // Axis value
    // horizontal
    h_x_from_line_1 = point_root_X - graph_width - space_width;
    h_y_from_line_1 = point_root_Y;
    h_x_to_line_1 = h_x_from_line_1 + graph_width;
    h_y_to_line_1 = point_root_Y;

    h_x_from_line_2 = point_root_X + space_width;
    h_y_from_line_2 = point_root_Y;
    h_x_to_line_2 = h_x_from_line_2 + graph_width;
    h_y_to_line_2 = point_root_Y;

    // vertical
    v_x_from_line_1 = point_root_X;
    v_y_from_line_1 = point_root_Y - space_height - graph_height;
    v_x_to_line_1 = point_root_X;
    v_y_to_line_1 = v_y_from_line_1 + graph_height;

    v_x_from_line_2 = point_root_X
    v_y_from_line_2 = point_root_Y + space_height;
    v_x_to_line_2 = point_root_X
    v_y_to_line_2 = v_y_from_line_2 + graph_height;

    // Point 1 value
    var point_X_to = ((graph_width + space_width) / density) * Math.abs(result_X);
    var point_Y_to = ((graph_height + space_height) / density) * Math.abs(result_Y);
    var centerX = result_X >= 0 ? (point_root_X + point_X_to) : (point_root_X - point_X_to);
    var centerY = result_Y >= 0 ? (point_root_Y - point_Y_to) : (point_root_Y + point_Y_to);

    // Text Value
    var h_text_margin = 20;
    var v_text_margin = 10;
    var top_text_y = v_y_from_line_1 - h_text_margin;
    var top_text_x = point_root_X;
    var bot_text_y = v_y_to_line_2 + h_text_margin + 20;
    var bot_text_x = point_root_X;

    var left_text_y = point_root_Y;
    var left_text_x = 0 + 90;
    var right_text_y = point_root_Y;
    var right_text_x = h_x_to_line_2 + 60 + v_text_margin;


    // ====== Point 2
    var result_X_2 = <?php echo $final_point_X_2;?>;
    var result_Y_2 = <?php echo $final_point_Y_2;?>;
    var biggerV_2 = Math.abs(result_X) > Math.abs(result_Y) ? Math.abs(result_X) : Math.abs(result_Y);
    var density_2 = getDensity(biggerV_2, 15);
    density = density > density_2 ? density : density_2;
    // Point 2 value
    var point_X_to_2 = ((graph_width + space_width) / density) * Math.abs(result_X_2);
    var point_Y_to_2 = ((graph_height + space_height) / density) * Math.abs(result_Y_2);
    var centerX_2 = result_X_2 >= 0 ? (point_root_X + point_X_to_2) : (point_root_X - point_X_to_2);
    var centerY_2 = result_Y_2 >= 0 ? (point_root_Y - point_Y_to_2) : (point_root_Y + point_Y_to_2);
    var radius = 10;

    function renderGraph () {
      // Begin Draw
      context.beginPath();
      // Draw Horizontal
      context.moveTo(h_x_from_line_1, h_y_from_line_1);
      context.lineTo(h_x_to_line_1, h_y_to_line_1);
      context.moveTo(h_x_from_line_2, h_y_from_line_2);
      context.lineTo(h_x_to_line_2, h_y_to_line_2);

      // Draw Vertical
      context.moveTo(v_x_from_line_1, v_y_from_line_1);
      context.lineTo(v_x_to_line_1, v_y_to_line_1);
      context.moveTo(v_x_from_line_2, v_y_from_line_2);
      context.lineTo(v_x_to_line_2, v_y_to_line_2);

      context.stroke();

      // Draw point 1
      context.beginPath();
      context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
      context.fillStyle = '<?php echo $final_color; ?>';
      context.fill();
      context.stroke();

      // Draw point 2
      context.beginPath();
      context.arc(centerX_2, centerY_2, radius, 0, 2 * Math.PI, false);
      context.fillStyle = '<?php echo $final_color_2; ?>';
      context.fill();
      context.stroke();

      // Draw Text
      // Top
      context.font = 'normal 17pt arial';
      context.textAlign = 'center';
      // context.fillStyle = '#119F18';
      // context.fillText('Idealist', top_text_x, top_text_y);
      context.fillStyle = '<?php echo $results_1[0]['color'];?>';
      context.fillText('<?php echo $results_1[0]['name'];?>', top_text_x, top_text_y);
      // Bot
      // context.fillStyle = '#FF0000';
      // context.fillText('Warrior', bot_text_x, bot_text_y);
      context.fillStyle = '<?php echo $results_1[1]['color'];?>';
      context.fillText('<?php echo $results_1[1]['name'];?>', bot_text_x, bot_text_y);
      // Left
      // context.fillStyle = '#6548E0';
      // context.fillText('Protector', left_text_x, left_text_y);
      context.fillStyle = '<?php echo $results_1[4]['color'];?>';
      context.fillText('<?php echo $results_1[4]['name'];?>', left_text_x, left_text_y);
      // Right
      // context.fillStyle = '#FFC000';
      // context.fillText('Adventure', right_text_x, right_text_y);
      context.fillStyle = '<?php echo $results_1[3]['color'];?>';
      context.fillText('<?php echo $results_1[3]['name'];?>', right_text_x, right_text_y);
    }

    renderGraph ();
    renderNumbers ();

    function getDensity (value, density) {
      if (value <= density)
        return density;
      else {
        return getDensity(value, density + 15);
      }
    }

    // Point Hover
    canvas.onmousemove = function(e) {
      // Get the current mouse position
      var r = canvas.getBoundingClientRect(),
          x = e.clientX - r.left, y = e.clientY - r.top;
      hover = false;

      context.clearRect(0, 0, canvas.width, canvas.height);
      renderGraph ();
      renderNumbers ();
      if(isInPoint(x, y, centerX, centerY, radius)) {
          // The mouse honestly hits the rect
          renderCoord (centerX, centerY, radius, 1) ;
      }

      if(isInPoint(x, y, centerX_2, centerY_2, radius)) {
          // The mouse honestly hits the rect
          renderCoord (centerX_2, centerY_2, radius, 2) ;
      }

    }

    function isInPoint (x, y, centerX, centerY, radius) {
      return Math.round(Math.sqrt(Math.pow(x - centerX, 2) + Math.pow(y - centerY, 2))) <= radius;
    }

    function renderCoord (centerX, centerY, radius, index) {
      // index = 1: Point 1
      // index = 2: Point 2
      var margin = 5;
      // context.fillStyle = "gray";
      // context.fillRect(centerX + margin, centerY - radius - margin, 50, -30);
      // draw font in red
      context.fillStyle = 'red';
      context.font = "10pt sans-serif";
      if (index == 1)
        context.fillText('(' + <?=$final_point_X?> + ', ' + <?=$final_point_Y?> + ')', centerX + margin + 25, centerY - radius - margin - 10);
      else
        context.fillText('(' + <?=$final_point_X_2?> + ', ' + <?=$final_point_Y_2?> + ')', centerX + margin + 25, centerY - radius - margin - 10);
      // context.fillText("Canvas Rocks!", 5, 100);
    }

    function renderNumbers () {
      // Graph Number Background
      var horizontal_root_X = point_root_X;
      var horizontal_root_Y = v_y_to_line_2;
      var vertical_root_X = h_x_from_line_1;
      var vertical_root_Y = point_root_Y;
      var count_num = density; // -15 ~ 0 ~ + 15
      var rate = density / 15;

      for (var i = 1; i <= count_num; i += 2*rate) {
        var this_num = i;

        context.font = 'normal 8pt arial';
        context.textAlign = 'center';
        context.fillStyle = 'gray';

        if (this_num != 0 && this_num != density) {
          context.fillText(this_num, horizontal_root_X + this_num * ((graph_width + space_width) / density), horizontal_root_Y + 10);
          context.fillText(this_num * -1, horizontal_root_X - this_num * ((graph_width + space_width) / density), horizontal_root_Y + 10);

          context.fillText(this_num * -1, vertical_root_X, vertical_root_Y + this_num * ((graph_height + space_width) / density) + 8);
          context.fillText(this_num, vertical_root_X, vertical_root_Y - this_num * ((graph_height + space_width) / density));
        }

      }

    }

</script>
</body>
</html>
