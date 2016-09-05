<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--我的问卷</title>
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
    .reveal-modal {
        visibility: hidden;
        top: 100px;
        height: 150px;
        width: 80%;
        margin-left: 10%;
        background: #eee url(/Public/img/modal-gloss.png) no-repeat -200px -80px;
        position: absolute;
        z-index: 101;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-box-shadow: 0 0 10px rgba(0,0,0,.4);
        -webkit-box-shadow: 0 0 10px rgba(0,0,0,.4);
        -box-shadow: 0 0 10px rgba(0,0,0,.4);
    }
    .reveal-modal span{overflow: hidden; width: 90%; height: auto; display: block; margin: 10px auto; font-size: 12px;}
</style>
<script src="/Public/js/jquery.validator.js?local=en"></script>
<script src="/Public/js/jquery.reveal.js"></script>
<script src="/Public/js/jquery.zclip.js"></script>
<script>
    var create = "<?php echo U('Design/index');?>";
    var navLeftUrl = "<?php echo U('Template/nav-left');?>";
    $(function(){
        $("#Ttop").load(navLeftUrl,function(){
            $(".row h2").text("我的问卷");
            $(".row-right a").attr("href",create)
        })
    })
    $(function(){
        /*$("#copy").click(function(){
         var clipboardswfdata = $(this).parent().find("span").val();
         window.document.clipboardswf.SetData('str', clipboardswfdata);
         alert(clipboardswfdata);
         })*/

        $("#copy").zclip({
            path: "/swf/ZeroClipboard.swf",
            copy: function(){
                return $(this).parent().find("span").html();
            },
            afterCopy:function(){/* 复制成功后的操作 */
                alert("复制成功");
            }
        });
    })
</script>
<body style="background-color: white;">

<header id="Ttop"></header>
<!--tags-->
<div class="phoneTag">
    <ul class="firstU">
        <li class="active"><a href="#tab1">已发布</a></li>
        <img src="/Public/img/phone-line.png">
        <li><a href="#tab2">未发布</a></li>
    </ul>

    <div class="Update" id="tabs-1">
        <!--Block-->
        <?php if(is_array($survey1)): foreach($survey1 as $key=>$detail): ?><div class="phoneBlock">
                <p>
                    <?php echo ($detail[title]); ?>
                    <?php if($detail[survey_status] == 2 ): ?>(已结束)
                        <?php else: ?> (已发布)<?php endif; ?>
                </p>
                <ul class="block-hide showfalse">
                    <li><a href="/index.php/MyQuestionnaire/look/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/Public/img/search-q.png"></a></li>
                    <li><a data-reveal-id="myModal" > <img src="/Public/img/invate.png"></a></li>
                    <li><a href="/index.php/Design/modify/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/Public/img/qInfo.png"></a></li>
                    <li><a href="/index.php/MyQuestionnaire/stop/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/Public/img/StopQ.png"></a></li>
                </ul>
            </div><?php endforeach; endif; ?>
        <div id="myModal" class="reveal-modal">
            <span><?php echo ($detail[survey_location]); ?></span>
            <button id="copy" class="submit" style="border-radius: 5px; width: 100px; letter-spacing: 0; font-size: 15px;">请手动复制地址</button>
        </div>
    </div>



    <?php if(is_array($survey2)): foreach($survey2 as $key=>$detail): ?><div class="UnUpdate showfalse" id="tabs-2">

            <!--Block-->
            <div class="phoneBlock">
                <p>

                    <?php echo ($detail[title]); ?>
                    (未发布)
                </p>
                <ul class="block-hide showfalse">
                    <li><a href="/index.php/Design/modify/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Micon1.png"></a></li>
                    <li><a href="/index.php/Design/modify/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/qInfo.png"></a></li>
                    <li><a href="/index.php/MyQuestionnaire/delete/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Dicon2.png"></a></li>
                    <li><a href="/index.php/MyQuestionnaire/post/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Picon3.png"></a></li>
                </ul>
            </div>

    </div><?php endforeach; endif; ?>
</div>

<script>
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

    $(".phoneBlock p").click(function(){
        var tmp = $(this).next();
        if( tmp.css("display") == "none" ){
            tmp.slideDown();
        }else{
            tmp.slideUp();
        }
    })

    /*$(".phoneBlock p").toggle(function(){
     $(this).next().slideDown();
     },function(){
     $(this).next().slideUp();
     }
     );*/
</script>
</body>
</html>