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

<script>
    $(function() {
        $("body").prepend("<header class='PC-header'></header>");
        $(".PC-header").load("<?php echo U('Template/header');?>", function () {
            $(".PC-header ul li:eq(3)").append("<div class='triangleTop'></div>");
        })
    })

    function clickThat(){
        $("#btn1").click();
    }
</script>

<div class="QIndexContent">
    <div class="Qheader">
        <h2>最新问卷</h2>
        <form action="/index.php/Statics/search_result" method="post">
            <button id="btn1" type="submit" style="display: none">Clickme</button>
            <input type="text" name="content" placeholder="搜索相关问卷"><img onclick="clickThat()" src="/Public/img/DesignIcons/search.png"  width="20" height="20">
            <div class="clearFloat" style="height: 12px;"></div>
        </form>
    </div>

    <!--One Line-->
    <div class="QLine">
        <!--block-->
        <?php if(is_array($survey)): $i = 0; $__LIST__ = array_slice($survey,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="QBlock">
                <a href="/index.php/Statics/statisticsDetail/survey_id/<?php echo ($data["survey_id"]); ?>"><img src="/Public/img/QuesIndex/Block1.png" width="100%"></a>
                <a href="/index.php/Statics/statisticsDetail/survey_id/<?php echo ($data["survey_id"]); ?>"><p><?php echo ($data["title"]); ?></p></a>
                <div class="total">
                    <img src="/Public/img/QuesIndex/TimeIcon.png"><span><?php echo ($data["fabu_time"]); ?></span>
                    <img src="/Public/img/QuesIndex/WatchedIcon.png"><span><?php echo ($data["hit"]); ?></span>
                    <img src="/Public/img/QuesIndex/AnswerIcon.png"><span><?php echo ($data["num_of_answer"]); ?></span>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--block-->

        <div class="clearFloat"></div>
    </div>

    <!--One Line-->
    <div class="QLine">
        <!--block-->
        <?php if(is_array($survey)): $i = 0; $__LIST__ = array_slice($survey,4,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="QBlock">
                <a href="/index.php/Statics/statisticsDetail/survey_id/<?php echo ($data["survey_id"]); ?>"><img src="/Public/img/QuesIndex/Block1.png" width="100%"></a>
                <a href="/index.php/Statics/statisticsDetail/survey_id/<?php echo ($data["survey_id"]); ?>"><p><?php echo ($data["title"]); ?></p></a>
                <div class="total">
                    <img src="/Public/img/QuesIndex/TimeIcon.png"><span><?php echo ($data["fabu_time"]); ?></span>
                    <img src="/Public/img/QuesIndex/WatchedIcon.png"><span><?php echo ($data["hit"]); ?></span>
                    <img src="/Public/img/QuesIndex/AnswerIcon.png"><span>65</span>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--block-->

        <div class="clearFloat"></div>
    </div>

    <div class="Qbottom">

        <a href="/index.php/Statics/index/p/<?php echo ($pre); ?>"><span>前一页</span></a>
        <?php if($p > 1): ?><a href="/index.php/Statics/index/p/1"><span>首页</span></a>
            <?php if($pre != 1): ?><label>...</label><?php endif; ?>
            <a href="/index.php/Statics/index/p/<?php echo ($pre); ?>"><?php echo ($p-1); ?></a><?php endif; ?>

        <a class="ahover"><?php echo ($p); ?></a>
        <?php if($p != $last): ?><a href="/index.php/Statics/index/p/<?php echo ($after); ?>"><?php echo ($p+1); ?></a><?php endif; ?>
        <?php if(($p == 1) AND ($after < $last)): ?><a href="/index.php/Statics/index/p/<?php echo ($afterAgain); ?>"><?php echo ($p+2); ?></a><?php endif; ?>
        <?php if($p != $last): ?><label>...</label><?php endif; ?>
        <a href="/index.php/Statics/index/p/<?php echo ($last); ?>"><span>末页</span></a>
        <a href="/index.php/Statics/index/p/<?php echo ($after); ?>"><span>下一页</span></a>
    </div>
</div>


</body>
</html>