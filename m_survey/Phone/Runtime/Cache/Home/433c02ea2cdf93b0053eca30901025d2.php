<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--问卷说明</title>
    <link href="/m_survey/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/m_survey/Public/css/style.css">
</head>
<script src="/m_survey/Public/js/jquery.min.js"></script>
<script>
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    var navTopUrl = "<?php echo U('Template/nav-top');?>";
    var myQ = "<?php echo U('MyQuestionnaire/index');?>"


</script>

<body style="background-color: white;">

<script>

    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load(navTopUrl,function(){
            $(".row h2").text("创建问卷信息");
            $(".row-left a").attr("href",myQ+"#tab2");
        })
    })
</script>

<form class="phoneTag" action="/m_survey/index.php/design/insert/method/qInfo" method="post">
    <div class="QTitle">
        <p>问卷标题</p>
        <input placeholder="请输入问卷标题" name="title" class="Qtitle-input">
    </div>
    <div class="QTitle QInfo">
        <p>问卷说明</p>
        <textarea name="description" class="Qtitle-input"></textarea>
    </div>
    <button class="submit">创建</button>
</form>

</body>
</html>