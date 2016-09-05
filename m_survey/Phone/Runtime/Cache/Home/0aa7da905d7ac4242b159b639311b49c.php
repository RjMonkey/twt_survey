<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--问卷填写</title>
    <link href="/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/Public/css/style.css">
</head>
<script src="/Public/js/jquery.min.js"></script>

<script>
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    var navTopUrl = "<?php echo U('Template/nav-top');?>";
    var myQ = "<?php echo U('MyQuestionnaire/index');?>"


</script>
<body style="background-color: white;">

<script src="/Public/js/jquery.validator.js?local=en"></script>
<script>
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load(navTopUrl,function(){
            $(".row h2").text("创建问卷信息");
            $(".row-left a").attr("href","<?php echo U('Fill/fill');?>");
        })

        $(".FillContainer>div span.star").siblings("input[type=checkbox]").attr("data-rule","checked");
        $(".FillContainer>div span.star").siblings("input[type=radio]").attr("data-rule","checked");
        $(".FillContainer>div span.star").siblings("textarea").attr("data-rule","required;");

        $(".Qlist li:last-child").on("click", function() {
            var tmp = $(this).children("div");
            if( $(this).children("input").is(":checked") )
                tmp.css("display","block");
        })
    })
</script>
<form action="/index.php/Fill/add/survey_id/<?php echo ($survey[survey_id]); ?>" method="post">
    <div class="phoneTag">
        <div class="FillQ">
            <p class="title"><?php echo ($survey[title]); ?></p>
        </div>
        <!--block单选题-->
        <?php if(is_array($survey["question"])): foreach($survey["question"] as $i=>$detail): if($detail["question_type"] == 1): ?><div class="FillQ">
                    <p class="QName">Q<?php echo ($i+1); ?>.<?php echo ($detail["question_content"]); if($detail["is_must"] == 1): ?><span style="color:red">*</span><?php endif; ?></p>
                    <ul class="Qlist">
                        <?php if(is_array($detail["option"])): foreach($detail["option"] as $j=>$op): if($op["is_other"] != 1): ?><li>
                                    <input type="radio" name="q[<?php echo ($detail["question_id"]); ?>]" id="q1[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" value="<?php echo ($j); ?>">
                                    <label for="q1[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]"><?php echo ($op["option_content"]); ?></label>
                                </li>

                                <?php else: ?>
                                <li>
                                    <input type="radio" name="q[<?php echo ($detail["question_id"]); ?>]" value="other" id="q14">
                                    <label for="q14">其他</label>
                                    <div class="HiddenInput">
                                        <input type="text" name="q[<?php echo ($detail["question_id"]); ?>]">
                                    </div>
                                </li><?php endif; endforeach; endif; ?>
                    </ul>
                </div>
                <?php elseif($detail["question_type"] == 2): ?>
                <!--block多选题-->
                <div class="FillQ">
                    <p class="QName">Q<?php echo ($i+1); ?>.<?php echo ($detail["question_content"]); if($detail["is_must"] == 1): ?><span style="color:red">*</span><?php endif; ?></p>
                    <ul class="Qlist">
                        <?php if(is_array($detail["option"])): foreach($detail["option"] as $j=>$op): if($op["is_other"] != 1): ?><li>
                                    <input type="checkbox" name="q[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" id="q2[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" value="<?php echo ($j); ?>">
                                    <label for="q2[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]"><?php echo ($op["option_content"]); ?></label>
                                </li>
                                <?php else: ?>
                                <li>
                                    <input type="checkbox" name="q[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]" value="other" id="q24">
                                    <label for="q24">其他</label>
                                    <div class="HiddenInput">
                                        <input type="text" name="q[<?php echo ($detail["question_id"]); ?>][<?php echo ($j); ?>]">
                                    </div>
                                </li><?php endif; endforeach; endif; ?>
                    </ul>
                </div>
                <?php else: ?>
                <!--block填空题-->
                <div class="FillQ">
                    <p class="QName">Q<?php echo ($i+1); ?>.<?php echo ($detail["question_content"]); if($detail["is_must"] == 1): ?><span style="color:red">*</span><?php endif; ?></p>
                    <textarea class="myArea" name="q[<?php echo ($detail["question_id"]); ?>]" min-height="22"></textarea>
                </div><?php endif; endforeach; endif; ?>
        <button class="submit">提交</button>
    </div>
</form>

</body>
</html>