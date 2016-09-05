<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <title>天外天问卷中心</title>
    <link href="/Public/css/style.css" rel="stylesheet">
    <link rel="icon" href="/Public/img/PageIcon.jpg">
    <style>
        .FillInQuesTake{margin-top: 20px;}
        .FillQ{text-align: center}
        .FillContainer{margin-top: 30px;}
    </style>
</head>
<body>
<script src="/Public/js/jquery.min.js"></script>
<script>
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load("<?php echo U('Template/nav-top');?>",function(){
            $(".row h2").text("创建问卷信息");
            $(".row-left a").attr("href","<?php echo U('Statics/index');?>");
        })
    })
</script>
<script src="/Public/js/jquery.reveal.js"></script>
<script src="/Public/js/canvasjs.min.js"></script>


<div class="phoneTag" style="background-color: white; padding-bottom: 50px; padding-top: 10px;">
    <div class="FillQ">
        <p class="title">创业承载梦想，创新点燃希望”，在国家政策的支持与社会各界的关注下，越来越多的大学生选择了自主创业</p>
    </div>
    <div class="FillContainer">

    </div>
</div>



<!--画图-->
<script>
    $(function(){
        $.get("/index.php/Statics/statics/survey_id/<?php echo ($sid); ?>", function(data){

            data = JSON.parse(data);

            var Qid = data.survey_id;
            var Qtitle = data.title;
            var Qdesc = data.description;

            if(Qtitle != ""){
                $("p.title").text(Qtitle);
            }else{
                $("p.title").text("未命名");
            }

            var question = data.question;
            var i;
            for(i = 0; i < question.length; i++){
                if(question[i].question_type == 1 || question[i].question_type == 2){
                    var T = "<div id='canvas"+i+"' style='height: 250px; width: 90%; margin: 10px auto'></div>";
                    $(".FillContainer").append(T);
                    RenderChart("canvas"+i+"",question[i],question[i].option.length);
                }
                else if(question[i].question_type == 3){
                    var t = "Q"+question[i].question_id + "."+question[i].question_content;
                    var Surl = "/index.php/Statics/fillInResult/Sid/"+Qid+"/Qid/"+ question[i].question_id
                    var T = "<div class='FillInQuesTake'>"+t+"<a href="+Surl+" style='display: block; margin: 10px auto; text-align: center; color:lightseagreen'>点击查看答题情况</a></div>"
                    $(".FillContainer").append(T);
                }else{
                    alert("数据有误请联系天外天后台君");
                    break;
                }

            }
        })
    })

    function RenderChart(DomID, data, items){
        var DynamicData = [];

        for(var i = 0; i<items; i++){
            var temp = {y: data.option[i].sum, indexLabel: data.option[i].option_content};
            DynamicData.push(temp);
        }
        var chart = new CanvasJS.Chart(DomID,
                {
                    theme: "theme",
                    title:{
                        text: "Q" +　data.question_id + "." + data.question_content
                    },
                    data: [
                        {
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{y} - #percent %",
                            yValueFormatString: "#0.#,,. Million",
                            legendText: "{indexLabel}",
                            dataPoints:DynamicData
                        }
                    ]
                });
        chart.render();
    }

    function ReaderFillInQues(data){

    }
</script>


</body>
</html>