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
    // var colorBtn1 = LightenDarkenColor(baseColor1, -30);
    // var colorBtn2 = LightenDarkenColor(baseColor1, -15);
    // var colorBtn3 = LightenDarkenColor(baseColor1, 15);
    // var colorBtn4 = LightenDarkenColor(baseColor1, 30);
    //
    // var colorBtn5 = LightenDarkenColor(baseColor2, 0);
    //
    // var colorBtn6 = LightenDarkenColor(baseColor3, 40);
    // var colorBtn7 = LightenDarkenColor(baseColor3, 15);
    // var colorBtn8 = LightenDarkenColor(baseColor3, -15);
    // var colorBtn9 = LightenDarkenColor(baseColor3, -45);

    var colorBtn1 = shadeBlendConvert(-0.30, baseColor1);
    var colorBtn2 = shadeBlendConvert(-0.15, baseColor1);
    var colorBtn3 = shadeBlendConvert(0.15, baseColor1);
    var colorBtn4 = shadeBlendConvert(0.30, baseColor1);

    var colorBtn5 = shadeBlendConvert(0, baseColor2);

    var colorBtn6 = shadeBlendConvert(0.30, baseColor3);
    var colorBtn7 = shadeBlendConvert(0.15, baseColor3);
    var colorBtn8 = shadeBlendConvert(-0.15, baseColor3);
    var colorBtn9 = shadeBlendConvert(-0.30, baseColor3);

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
            // alert(data.result);
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

  function shadeBlendConvert (p, from, to) {
    if(typeof(p)!="number"||p<-1||p>1||typeof(from)!="string"||(from[0]!='r'&&from[0]!='#')||(to&&typeof(to)!="string"))return null; //ErrorCheck
    if(!this.sbcRip)this.sbcRip=(d)=>{
        let l=d.length,RGB={};
        if(l>9){
            d=d.split(",");
            if(d.length<3||d.length>4)return null;//ErrorCheck
            RGB[0]=i(d[0].split("(")[1]),RGB[1]=i(d[1]),RGB[2]=i(d[2]),RGB[3]=d[3]?parseFloat(d[3]):-1;
        }else{
            if(l==8||l==6||l<4)return null; //ErrorCheck
            if(l<6)d="#"+d[1]+d[1]+d[2]+d[2]+d[3]+d[3]+(l>4?d[4]+""+d[4]:""); //3 or 4 digit
            d=i(d.slice(1),16),RGB[0]=d>>16&255,RGB[1]=d>>8&255,RGB[2]=d&255,RGB[3]=-1;
            if(l==9||l==5)RGB[3]=r((RGB[2]/255)*10000)/10000,RGB[2]=RGB[1],RGB[1]=RGB[0],RGB[0]=d>>24&255;
        }
    return RGB;}
    var i=parseInt,r=Math.round,h=from.length>9,h=typeof(to)=="string"?to.length>9?true:to=="c"?!h:false:h,b=p<0,p=b?p*-1:p,to=to&&to!="c"?to:b?"#000000":"#FFFFFF",f=this.sbcRip(from),t=this.sbcRip(to);
    if(!f||!t)return null; //ErrorCheck
    if(h)return "rgb"+(f[3]>-1||t[3]>-1?"a(":"(")+r((t[0]-f[0])*p+f[0])+","+r((t[1]-f[1])*p+f[1])+","+r((t[2]-f[2])*p+f[2])+(f[3]<0&&t[3]<0?")":","+(f[3]>-1&&t[3]>-1?r(((t[3]-f[3])*p+f[3])*10000)/10000:t[3]<0?f[3]:t[3])+")");
    else return "#"+(0x100000000+r((t[0]-f[0])*p+f[0])*0x1000000+r((t[1]-f[1])*p+f[1])*0x10000+r((t[2]-f[2])*p+f[2])*0x100+(f[3]>-1&&t[3]>-1?r(((t[3]-f[3])*p+f[3])*255):t[3]>-1?r(t[3]*255):f[3]>-1?r(f[3]*255):255)).toString(16).slice(1,f[3]>-1||t[3]>-1?undefined:-2);
  }
  </script>
</body>
</html>
