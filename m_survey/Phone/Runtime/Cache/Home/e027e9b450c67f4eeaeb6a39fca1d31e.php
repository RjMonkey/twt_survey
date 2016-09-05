<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--问卷信息</title>
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
    var create = "<?php echo U('Design/index', array('survey_id'=>$survey_id));?>";
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load(navTopUrl,function(){
            $(".row h2").text("创建问卷信息");
            $(".row-left a").attr("href",create);
        })
    })
</script>

<div class="Unit">
    <!--block-->
    <div class="Unit-block">
        <span><?php echo ($survey[title]); ?></span>
        <span>说明</span>
    </div>
    <?php if(is_array($survey["question"])): foreach($survey["question"] as $i=>$detail): ?><!--block-->
    <div class="Unit-block">
        <span><?php echo ($detail["question_content"]); ?></span>
        <?php if($detail["question_type"] == 1): ?><span>单选题</span>
        <?php elseif($detail["question_type"] == 2): ?>
            <span>多选题</span>
            <?php else: ?>
            <span>填空题</span><?php endif; ?>
    </div><?php endforeach; endif; ?>
    <a href="/m_survey/index.php/design/addQues/survey_id/<?php echo ($survey_id); ?>"><button class="submit"><img src="/m_survey/Public/img/plusIcon.png" width="20" height="20">添加题目</button></a>
</div>

</body>
</html>