<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <title>问卷填写</title>
    <link href="/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/Public/css/style.css">
</head>
<script src="/Public/js/jquery.min.js"></script>
<script>
    $(function(){
        $("#Ttop").load("<?php echo U('Template/nav-left');?>",function(){
            $(".row h2").text("问卷推荐");
            $(".row-right a").attr("href","<?php echo U('Design/index');?>")
        })
    })

</script>
<body>

<div id="Ttop"></div>

<div class="QuesIndexContent">
    <div class="myContent">
        <form action="/index.php/Fill/search_result" method="post">

            <input  name="content" class="search"><img class="item" src="/Public/img/DesignIcons/search.png" width="20" height="20"> <button type="submit" style="display: none" id="hiddenBtn"></button>

        </form>
    </div>
    <?php if(is_array($survey)): foreach($survey as $k=>$data): ?><!--Block-->
    <div class="QuesIndexBlock">
        <img src="/Public/img/QuesIndex/Block<?php echo ($k % 4 + 1); ?>.png">
        <div class="Qright">
            <a href="/index.php/Fill/index/survey_id/<?php echo ($data["survey_id"]); ?>"><p><?php echo ($data["title"]); ?></p></a>
            <img src="/Public/img/QuesIndex/TimeIcon.png"><span><?php echo ($data["fabu_time"]); ?></span>
            <br>
            <img src="/Public/img/QuesIndex/WatchedIcon.png"><span><?php echo ($data["hit"]); ?></span>
            <br>
            <img src="/Public/img/QuesIndex/AnswerIcon.png"><span><?php echo ($data["num_of_answer"]); ?></span>
        </div>
    </div><?php endforeach; endif; ?>
    <!--Block-->

    <!--Block-->

</div>

</body>
</html>