<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天外天问卷中心</title>
    <link href="/Public/css/PCStyle.css" rel="stylesheet">
    <link rel="icon" href="/Public/img/PageIcon.jpg">
    <style type="text/css">
        .FillContainer{
            padding-top: 40px;
        }
        table.imagetable {
            font-family: verdana,arial,sans-serif;
            width: 100%;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #999999;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table.imagetable th {
            background:#b5cfd2 url('/Public/img/DesignIcons/cell-blue.jpg') repeat;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #999999;
            text-align: center
        }
        table.imagetable td {
            background:#dcddc0 url('/Public/img/DesignIcons/cell-grey.jpg') repeat;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #999999;
            overflow: visible;
        }
        table.imagetable td:first-child{
            text-align: center;
        }
    </style>
</head>
<body>
<script src="/Public/js/jquery.min.js"></script>
<script>
    $(function() {
        $("body").prepend("<header class='PC-header'></header>");
        $(".PC-header").load("<?php echo U('Template/header');?>", function () {
            $(".PC-header ul li:eq(3)").append("<div class='triangleTop'></div>");
        })
    })

    var GetURL = "/index.php/Statics/fill/qid/<?php echo ($qid); ?>"
    /*获取填空题数据*/
    $(function(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url:GetURL,
            success:function(data){
                $(".FillContainer h1").text(data.question_content);
                var tmp = data.result;
                var i;
                for(i = 0; i < data.sum; i++){
                    $(".imagetable tbody").append("<tr><td>11</td><td>11</td></tr>");
                    var t = i + 1;
                    $(".imagetable tbody tr").eq(t).find("td").eq(0).text("#" + t);
                    $(".imagetable tbody tr").eq(t).find("td").eq(1).text(tmp[i].result_content);
                }
            }
        })
    })

</script>

<form class="FillContent">
    <div class="FillContainer" style="text-align: center;">
        <h1>题目是什么呀我不知奥</h1>
        <table class="imagetable">
            <tbody>
                <tr>
                    <th style="width: 190px; ">编号</th><th style="width: 600px;">答 案</th>
                </tr>
            </tbody>
        </table>
    </div>
</form>

</body>
</html>