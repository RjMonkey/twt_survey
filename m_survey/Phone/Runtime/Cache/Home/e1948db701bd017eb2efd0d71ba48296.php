<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <title>天外天问卷中心--添加问题</title>
    <link href="/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/Public/css/style.css">
    <style>
        div.content{margin-top: 200px;}
        img{width: 45px; height: 45px;}
        .block{width: 33.333%; float: left; text-align: center;}
        .block p{margin-top: 12px;}
        .personP{margin-top: 62px; text-align: center;}
        .personP p{color: #676767; font-size: 24px; font-weight: lighter;}
        .personP p:last-child{margin-top: 20px;}
    </style>
</head>
<body style="background-color: #e5e5e5;">

<div class="content">
    <div class="block">
        <a><img src="/Public/img/singleChooseIcon.png"></a>
        <p>单选题</p>
    </div>
    <div class="block">
        <a><img src="/Public/img/mutiChooseIcon.png"></a>
        <p>多选题</p>
    </div>
    <div class="block">
        <a href="/index.php/Design/addFillQues/data/Fill/survey_id/<?php echo ($survey_id); ?>"><img src="/Public/img/fillInQuesIcon.png"></a>
        <p>填空题</p>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="personP">
    <p>更多功能请登录</p>
    <p>PC端天外天问卷中心</p>
</div>


<script src="/Public/js/jquery.min.js"></script>
<script src="/Public/js/checkbox.js"></script>
<script>
    var single = "<?php echo U('Design/addChooseQ', array('data'=>Single, 'survey_id'=>$survey_id ));?>";
    var multiply = "<?php echo U('Design/addChooseQ', array('data'=>Multiply, 'survey_id'=>$survey_id ));?>";
    $(function(){
        $(".content .block:first-child a").attr("href",single);
        $(".content .block:first-child + .block a").attr("href",multiply);
    })
</script>
</body>
</html>