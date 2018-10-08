<?php include 'common/header.php' ?>
  <div class="main-content">
    <div class="container">
      <section class="content01 chapter">
        <?php

        ?>
        <h2><?php echo $questions[$q_index]['title'];?></h2>
        <div class="question clearfix">
          <?php
          $answer = $questions[$q_index]['answers'];
          ?>
          <p class="first"><?php echo $answer[0]['title'];?></p>
          <button class="btn btn01 btn-choice" value="<?php echo 10;?>" data-color="<?php echo $answer[0]['color'] ?>" data-answer="<?php echo $answer[0]['item_id'] ?>"></button>
          <button class="btn btn02 btn-choice" value="<?php echo 6;?>" data-color="<?php echo $answer[0]['color'] ?>" data-answer="<?php echo $answer[0]['item_id'] ?>"></button>
          <button class="btn btn03 btn-choice" value="<?php echo 3;?>" data-color="<?php echo $answer[0]['color'] ?>" data-answer="<?php echo $answer[0]['item_id'] ?>"></button>
          <button class="btn btn04 btn-choice" value="<?php echo 1?>" data-color="<?php echo $answer[0]['color'] ?>" data-answer="<?php echo $answer[0]['item_id'] ?>"></button>
          <button class="btn btn05 btn-choice" value="<?php echo 0;?>" data-color="<?php echo $answer[2]['color'] ?>" data-answer="<?php echo $answer[2]['item_id'] ?>"><?php echo $answer[2]['title'];?></button>
          <button class="btn btn06 btn-choice" value="<?php echo -1;?>" data-color="<?php echo $answer[1]['color'] ?>" data-answer="<?php echo $answer[1]['item_id'] ?>"></button>
          <button class="btn btn07 btn-choice" value="<?php echo -3;?>" data-color="<?php echo $answer[1]['color'] ?>" data-answer="<?php echo $answer[1]['item_id'] ?>"></button>
          <button class="btn btn08 btn-choice" value="<?php echo -6;?>" data-color="<?php echo $answer[1]['color'] ?>" data-answer="<?php echo $answer[1]['item_id'] ?>"></button>
          <button class="btn btn09 btn-choice" value="<?php echo -10;?>" data-color="<?php echo $answer[1]['color'] ?>" data-answer="<?php echo $answer[1]['item_id'] ?>"></button>
          <p class="last"><?php echo $answer[1]['title'];?></p>
        </div>
      </section>
      </div>
    </div>
  </div>
  <script>
    var baseColor1 = "<?php echo $answer[0]['color'] ?>";
    var baseColor2 = "<?php echo $answer[2]['color'] ?>";
    var baseColor3 = "<?php echo $answer[1]['color'] ?>";
    var colorBtn1 = LightenDarkenColor(baseColor1, -30);
    var colorBtn2 = LightenDarkenColor(baseColor1, -15);
    var colorBtn3 = LightenDarkenColor(baseColor1, 15);
    var colorBtn4 = LightenDarkenColor(baseColor1, 30);

    var colorBtn5 = LightenDarkenColor(baseColor2, 0);

    var colorBtn6 = LightenDarkenColor(baseColor3, 40);
    var colorBtn7 = LightenDarkenColor(baseColor3, 15);
    var colorBtn8 = LightenDarkenColor(baseColor3, -15);
    var colorBtn9 = LightenDarkenColor(baseColor3, -45);

    $(document).ready(function(){
      $('.btn01').css('background', colorBtn1);
      $('.btn02').css('background', colorBtn2);
      $('.btn03').css('background', colorBtn3);
      $('.btn04').css('background', colorBtn4);
      $('.btn05').css('background', colorBtn5);
      $('.btn06').css('background', colorBtn6);
      $('.btn07').css('background', colorBtn7);
      $('.btn08').css('background', colorBtn8);
      $('.btn09').css('background', colorBtn9);
      $('.first').css('color', colorBtn4);
      $('.last').css('color', colorBtn9);

    });


    $(".btn-choice").click(function(){
      var value = $(this).val();
      var color = $(this).data('color');
      var answer_id = $(this).data('answer');
      $.ajax({
        url : "<?php echo base_url(); ?>tests/doTest",
        type : "POST",
        dataType : "json",
        data : {"point" : value, "test_id" : <?php echo $testId; ?>,"type" : color
                , "question_id": "<?php echo $questions[$q_index]['item_id'];?>"
                , "answer_id": answer_id},
        success : function(data) {
            // do something
            if (data.result ==  "success")
              location.reload();
            else if (data.result ==  "finish")
              // similar behavior as an HTTP redirect
              window.location.replace("<?php echo base_url(); ?>result?id=" + data.id + "&type_id=" + data.type_id );
        },
        error : function(data) {
            // do something
            alert(data.result);
        }
      });
    });

    function LightenDarkenColor(col, amt) {

      var usePound = false;

      if (col[0] == "#") {
          col = col.slice(1);
          usePound = true;
      }

      var num = parseInt(col,16);

      var r = (num >> 16) + amt;

      if (r > 255) r = 255;
      else if  (r < 0) r = 0;

      var b = ((num >> 8) & 0x00FF) + amt;

      if (b > 255) b = 255;
      else if  (b < 0) b = 0;

      var g = (num & 0x0000FF) + amt;

      if (g > 255) g = 255;
      else if (g < 0) g = 0;

      return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);

  }
  </script>
</body>
</html>
