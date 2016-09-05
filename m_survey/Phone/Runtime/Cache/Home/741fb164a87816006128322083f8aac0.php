<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--我的问卷</title>
    <link href="/m_survey/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/m_survey/Public/css/style.css">
</head>
<script src="/m_survey/Public/js/jquery.min.js"></script>
<script>
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    var navTopUrl = "<?php echo U('Template/nav-top');?>";
    var myQ = "<?php echo U('MyQuestionnaire/index');?>"


</script>
<script>
    var create = "<?php echo U('Design/index');?>";
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    $(function(){
        $("body").prepend("<div id='Ttop'></div>");
        $("#Ttop").load(navLeftUrl,function(){
            $(".row h2").text("我的问卷");
            $(".row-right a").attr("href",create)
        })
    })
</script>

<body style="background-color: white;">


<!--tags-->
<div class="phoneTag">
    <ul class="firstU">
        <li class="active"><a href="#tab1">已发布</a></li>
            <img src="/m_survey/Public/img/phone-line.png">
        <li><a href="#tab2">未发布</a></li>
    </ul>

    <div class="Update" id="tabs-1">
        <!--Block-->
        <div class="phoneBlock">
            <?php if(is_array($survey1)): foreach($survey1 as $key=>$detail): ?><p>
                <?php echo ($detail[title]); ?>
                <?php if($detail[survey_status] == 2 ): ?>(已结束)
                    <?php else: ?> (已发布)<?php endif; ?>
            </p>
            <ul class="block-hide showfalse">
                <li><a href="/m_survey/index.php/my_questionnaire/look/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/m_survey/Public/img/search-q.png"></a></li>
                <li><a><img src="/m_survey/Public/img/invate.png"></a></li>
                <li><a href="/m_survey/index.php/Design/modify/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/m_survey/Public/img/qInfo.png"></a></li>
                <li><a href="/m_survey/index.php/my_questionnaire/stop/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/m_survey/Public/img/StopQ.png"></a></li>
            </ul><?php endforeach; endif; ?>
        </div>
    </div>

    <div class="UnUpdate showfalse" id="tabs-2">
        <!--Block-->
        <div class="phoneBlock">
            <?php if(is_array($survey2)): foreach($survey2 as $key=>$detail): ?><p>
                    <?php echo ($detail[title]); ?>
                     (未发布)
                </p>
            <ul class="block-hide showfalse">
                <li><a href="/m_survey/index.php/Design/modify/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/m_survey/Public/img/Micon1.png"></a></li>
                <li><a href="/m_survey/index.php/Design/modify/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/m_survey/Public/img/qInfo.png"></a></li>
                <li><a href="/m_survey/index.php/my_questionnaire/delete/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/m_survey/Public/img/Dicon2.png"></a></li>
                <li><a href="/m_survey/index.php/my_questionnaire/post/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/m_survey/Public/img/Picon3.png"></a></li>
            </ul><?php endforeach; endif; ?>
        </div>
    </div>
</div>

<script>
    function getURL(name){
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }


    var liFirst = $(".firstU").find("li:first-child");
    var liSec = $(".firstU").find("li:last-child");

    getPara();
    function getPara(){
        var tmp = window.location.href;
        var s = tmp.split("#");
        if(s[s.length-1] == "tab1"){
            aclick1(liFirst,liSec);
        }else{
            aclick2(liFirst,liSec);
        }
    }

    function aclick1(liFirst,liSec){
        $("#tabs-1").show();
        $("#tabs-2").hide();
        liFirst.addClass("active");
        liSec.removeClass("active");
    }

    function aclick2(liFirst,liSec){
        $("#tabs-2").show();
        $("#tabs-1").hide();
        liSec.addClass("active");
        liFirst.removeClass("active");
    }

    liFirst.click(function(){
        aclick1(liFirst,liSec)
    });

    liSec.click(function(){
        aclick2(liFirst,liSec)
    });

    $(".phoneBlock p").toggle(function(){
                $(this).next().slideDown();
            },function(){
                $(this).next().slideUp();
            }
    );
</script>
</body>
</html>