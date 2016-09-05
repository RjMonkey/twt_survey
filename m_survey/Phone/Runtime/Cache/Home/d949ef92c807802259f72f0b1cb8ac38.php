<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--问卷信息</title>
    <link href="/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/Public/css/style.css">
</head>
<script src="/Public/js/jquery.min.js"></script>

<script>
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    var navTopUrl = "<?php echo U('Template/nav-top');?>";
    var myQ = "<?php echo U('MyQuestionnaire/index');?>"


</script>
<style>
    .Unit button img{position: relative; top:2px; right: 4px;}
</style>
<body style="background-color: white;">
<?php if($status == 1): ?><script>var tab = "#tab1";</script>
<?php else: ?><script>var tab = "#tab2";</script><?php endif; ?>

<script>
    var create = "<?php echo U('Design/index', array('survey_id'=>$survey_id));?>";
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load(navTopUrl,function(){
            $(".row h2").text("创建问卷信息");
            $(".row-left a").attr("href",myQ+tab);
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
    <a href="/index.php/Design/addQues/survey_id/<?php echo ($survey_id); ?>"><button class="submit"><img src="/Public/img/plusIcon.png" width="16" height="16">添加题目</button></a>
</div>

</body>
</html>