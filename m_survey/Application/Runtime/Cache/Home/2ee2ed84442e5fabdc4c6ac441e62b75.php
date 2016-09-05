<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天外天问卷中心</title>
    <link href="/m_survey/Public/css/PCStyle.css" rel="stylesheet">
    <link rel="icon" href="/m_survey/Public/img/PageIcon.jpg">
</head>
<body>
<script src="/m_survey/Public/js/jquery.min.js"></script>

<script>
    $(function() {
        $("body").prepend("<header class='PC-header'></header>");
        $(".PC-header").load("<?php echo U('Template/header');?>", function () {
            $(".PC-header ul li:eq(1)").append("<div class='triangleTop'></div>");
        })
    })

    function clickThat(){
        $("#btn1").click();
    }
</script>

<div class="QIndexContent">
    <div class="Qheader">
        <h2>选择问卷</h2>
        <form action="/m_survey/index.php/Fill/search_result" method="post">
        <button id="btn1" type="submit" style="display: none">Clickme</button>
        <input type="text" name="content" placeholder="搜索相关问卷"><img onclick="clickThat()" src="/m_survey/Public/img/DesignIcons/search.png"  width="20" height="20">
        <div class="clearFloat" style="height: 12px;"></div>
        </form>
    </div>

    <!--One Line-->
    <div class="QLine">
        <!--block-->
        <?php if(is_array($survey)): $k = 0; $__LIST__ = array_slice($survey,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($k % 2 );++$k;?><div class="QBlock">
            <a href="/m_survey/index.php/Fill/index/survey_id/<?php echo ($data["survey_id"]); ?>"><img src="/m_survey/Public/img/QuesIndex/Block<?php echo ($k); ?>.png" width="100%"></a>
            <a href="/m_survey/index.php/Fill/index/survey_id/<?php echo ($data["survey_id"]); ?>"><p><?php echo ($data["title"]); ?></p></a>
            <div class="total">
                <img src="/m_survey/Public/img/QuesIndex/TimeIcon.png"><span><?php echo ($data["fabu_time"]); ?></span>
                <img src="/m_survey/Public/img/QuesIndex/WatchedIcon.png"><span><?php echo ($data["hit"]); ?></span>
                <img src="/m_survey/Public/img/QuesIndex/AnswerIcon.png"><span>65</span>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--block-->

        <div class="clearFloat"></div>
    </div>

    <!--One Line-->
    <div class="QLine">
        <!--block-->
        <?php if(is_array($survey)): $k = 0; $__LIST__ = array_slice($survey,4,7,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($k % 2 );++$k;?><div class="QBlock">
            <a href="/m_survey/index.php/Fill/index/survey_id/<?php echo ($data["survey_id"]); ?>"><img src="/m_survey/Public/img/QuesIndex/Block<?php echo ($k); ?>.png" width="100%"></a>
            <a href="/m_survey/index.php/Fill/index/survey_id/<?php echo ($data["survey_id"]); ?>"><p><?php echo ($data["title"]); ?></p></a>
            <div class="total">
                <img src="/m_survey/Public/img/QuesIndex/TimeIcon.png"><span><?php echo ($data["fabu_time"]); ?></span>
                <img src="/m_survey/Public/img/QuesIndex/WatchedIcon.png"><span><?php echo ($data["hit"]); ?></span>
                <img src="/m_survey/Public/img/QuesIndex/AnswerIcon.png"><span>65</span>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--block-->

        <div class="clearFloat"></div>
    </div>

    <div class="Qbottom">

        <a href="/m_survey/index.php/Fill/fill/p/<?php echo ($pre); ?>"><span>前一页</span></a>
        <?php if($p > 1): ?><a href="/m_survey/index.php/Fill/fill/p/1"><span>首页</span></a>
            <?php if($pre != 1): ?><label>...</label><?php endif; ?>
            <a href="/m_survey/index.php/Fill/fill/p/<?php echo ($pre); ?>"><?php echo ($p-1); ?></a><?php endif; ?>

        <a class="ahover"><?php echo ($p); ?></a>
        <?php if($p != $last): ?><a href="/m_survey/index.php/Fill/fill/p/<?php echo ($after); ?>"><?php echo ($p+1); ?></a><?php endif; ?>
        <?php if(($p == 1) AND ($after < $last)): ?><a href="/m_survey/index.php/Fill/fill/p/<?php echo ($afterAgain); ?>"><?php echo ($p+2); ?></a><?php endif; ?>
        <?php if($p != $last): ?><label>...</label><?php endif; ?>
        <a href="/m_survey/index.php/Fill/fill/p/<?php echo ($last); ?>"><span>末页</span></a>
        <a href="/m_survey/index.php/Fill/fill/p/<?php echo ($after); ?>"><span>下一页</span></a>
    </div>
</div>


</body>
</html>