<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天外天问卷中心</title>
    <link href="/Public/css/PCStyle.css" rel="stylesheet">
    <link rel="icon" href="/Public/img/PageIcon.jpg">
</head>
<body>
<script src="/Public/js/jquery.min.js"></script>
<script src="/Public/js/jquery.validator.js?local=en"></script>
<script>
    $(function(){
        $("body").prepend("<header class='PC-header'></header>");
        $(".PC-header").load("<?php echo U('Template/header');?>", function(){
            $(".PC-header ul li:eq(1)").append("<div class='triangleTop'></div>");
        })
        $(".FillContainer>div span.star").siblings("input[type=checkbox]").attr("data-rule","checked");
        $(".FillContainer>div span.star").siblings("input[type=radio]").attr("data-rule","checked");
        $(".FillContainer>div span.star").siblings("textarea").attr("data-rule","required;");
    })
</script>

<form class="FillContent" action="/index.php/Fill/add/survey_id/<?php echo ($survey[survey_id]); ?>" method="post">
    <h1><?php echo ($survey[title]); ?></h1>

    <h4><span class="star"> * </span>为必答题</h4>

    <img src="/Public/img/Icons/LINE.png">
    <div class="FillContainer">
        <p class="title"><?php echo ($survey[description]); ?></p>

        <!--请务必在第一题的class中加上FirstQues-->
        <!--单选题-->
        <?php if(is_array($survey["question"])): foreach($survey["question"] as $i=>$detail): if($detail["question_type"] == 1): ?><div class="SingleChoose FirstQues">
                    <?php if($detail["is_must"] == 1): ?><span class="star">*</span><?php endif; ?>
                    <p class="QuesTitle">Q<?php echo ($i+1); ?>.<?php echo ($detail["question_content"]); ?></p>
                    <?php if(is_array($detail["option"])): foreach($detail["option"] as $j=>$op): ?><!--<?php if($op["is_other"] != 1): ?>-->
                            <input type="radio" name="q[<?php echo ($detail["question_id"]); ?>]"  value="<?php echo ($j); ?>" id="q1[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" checked><img src="/Public/img/Icons/circleNone.png" width="20" height="20"><img src="/Public/img/Icons/circleChoose.png" width="20" height="20">
                            <label for="q1[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" style="margin-left: 12px;"><?php echo ($op["option_content"]); ?></label>
                            <br>
                        <!--<?php endif; ?>--><?php endforeach; endif; ?>
                </div>

        <!--多选题-->
            <?php elseif($detail["question_type"] == 2): ?>
                <div class="MutiChoose">
                    <?php if($detail["is_must"] == 1): ?><span class="star">*</span><?php endif; ?>
                    <p class="QuesTitle">Q<?php echo ($i+1); ?>.<?php echo ($detail["question_content"]); ?>（多选）</p>
                    <?php if(is_array($detail["option"])): foreach($detail["option"] as $j=>$op): ?><input type="checkbox"  name="q[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" id="q[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" value="<?php echo ($j); ?>"><img src="/Public/img/Icons/rectNone.png" width="20" height="20"><img src="/Public/img/Icons/rectChoose.PNG" width="20" height="20">
                    <label for="q[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]"><?php echo ($op["option_content"]); ?></label>
                    <br><?php endforeach; endif; ?>
                </div>
            <?php else: ?>
        <!--填空题-->
                <div class="FillQues">
                    <?php if($detail["is_must"] == 1): ?><span class="star">*</span><?php endif; ?>
                    <p class="QuesTitle">Q<?php echo ($i+1); ?>.<?php echo ($detail["question_content"]); ?></p>
                    <textarea name="q[<?php echo ($detail["question_id"]); ?>]" ></textarea>
                </div><?php endif; endforeach; endif; ?>
        <div class="forButton">
            <button class="submit">提交</button>
        </div>

    </div>
</form>
</body>
</html>