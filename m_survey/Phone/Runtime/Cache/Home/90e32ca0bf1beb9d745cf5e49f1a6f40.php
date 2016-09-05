<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--添加填空题</title>
    <link href="/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/Public/css/style.css">
</head>
<script src="/Public/js/jquery.min.js"></script>

<script>
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    var navTopUrl = "<?php echo U('Template/nav-top');?>";
    var myQ = "<?php echo U('MyQuestionnaire/index');?>"


</script>

<body style="background-color: white; overflow: visible;">
<script src="../js/jquery.min.js"></script>
<script>
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load(navTopUrl,function(){
            $(".row h2").text("填空题");
/*            $(".row-left a").attr("href","")*/
        })
    })
</script>
<script src="/Public/js/checkbox.js"></script>


<form class="phoneTag"  action="/index.php/Design/addQ/survey_id/<?php echo ($survey_id); ?>/data/<?php echo ($type); ?>" method="post">
    <div class="QTitle">
        <p>题目标题</p>
        <input required class="Qtitle-input" placeholder="请输入题目标题" name="content">
    </div>
    <!--<div class="Question" style="margin-top: 27px;">-->
        <!--<span>输入框行数</span>-->
        <!--<select style="float: right;" name="max" id="select">-->
            <!--<option selected>不限</option>-->
            <!--<option>1</option>-->
            <!--<option>2</option>-->
            <!--<option>3</option>-->
            <!--<option>4</option>-->
        <!--</select>-->
    <!--</div>-->
    <div class="Question" style="margin-top: 42px;">
        <span>此题目为必答题</span>
        <div class="sect selectedtrue">
            <input type="checkbox" name="must" id="checkbox" checked>
            <label for="checkbox"></label>
        </div>
    </div>
    <button class="submit">确定</button>
</form>


</body>
</html>