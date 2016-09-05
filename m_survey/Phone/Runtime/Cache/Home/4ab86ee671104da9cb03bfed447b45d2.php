<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <title>填空题统计信息</title>
    <link href="/m_survey/Public/css/style.css" rel="stylesheet">
    <link rel="icon" href="/m_survey/Public/img/PageIcon.jpg">
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
            background:#b5cfd2 url('/m_survey/Public/img/DesignIcons/cell-blue.jpg') repeat;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #999999;
            text-align: center
        }
        table.imagetable td {
            background:#dcddc0 url('/m_survey/Public/img/DesignIcons/cell-grey.jpg') repeat;
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

<script src="/m_survey/Public/js/jquery.min.js"></script>
<script>
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load("<?php echo U('Template/nav-left');?>",function(){
            $(".row h2").text("填空题具体信息");
            $(".row-left a").attr("href","<?php echo U('Statics/statisticsDetail', array('survey_id' => $sid));?>");
        })
    })


    var GetURL = "/m_survey/index.php/Statics/fill/qid/<?php echo ($qid); ?>";
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
                <th>编号</th><th>答 案</th>
            </tr>
            </tbody>
        </table>
    </div>
</form>

</body>
</html>