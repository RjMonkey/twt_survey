<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天外天问卷中心</title>
    <link href="/Public/css/PCStyle.css" rel="stylesheet">
    <link rel="icon" href="/Public/img/PageIcon.jpg">
    <style>
        td>p,td>span{display: none;}
    </style>
</head>
<body>
<script src="/Public/js/jquery.min.js"></script>
<script src="/Public/js/jquery.reveal.js"></script>
<script src="/Public/js/jquery.zclip.js"></script>
<script>
    $(function(){
        var header = "<?php echo U('Template/header');?>";
        $("body").prepend("<header class='PC-header'></header>");
        $(".PC-header").load(header, function(){
            $(".PC-header ul li:first-child").append("<div class='triangleTop'></div>");
        })

        $("button[name='copy']").zclip({
            path: "/swf/ZeroClipboard.swf",
            copy: function(){
                return $(this).parent().find("span").html();
            },
            afterCopy:function(){/* 复制成功后的操作 */
                alert("复制成功");
            }
        });



        var liFirst = $("#tabsF li:first-child");
        var liSec = $("#tabsF li:last-child");

        getPara();
        function getPara(){
            var tmp = window.location.href;
            var s = tmp.split("#");
            if(s[s.length-1] == "tab1"){
                aclick1();
            }else{
                aclick2();
            }
        }

        function aclick1(){
            $("#tab1").show();
            $("#tab2").hide();
            $("#tab1-aside").show();
            $("#tab2-aside").hide();
            liFirst.addClass("active");
            liSec.removeClass("active");
        }

        function aclick2(){
            $("#tab2").show();
            $("#tab1").hide();
            $("#tab2-aside").show();
            $("#tab1-aside").hide();
            liSec.addClass("active");
            liFirst.removeClass("active");
        }

        liFirst.click(function(){
            aclick1()
        });

        liSec.click(function(){
            aclick2()
        });



        /*问卷信息模块*/
        var UpdateURL = "<?php echo U('MyQuestionnaire/info1');?>";
        var NoneUpdateURL = "<?php echo U('MyQuestionnaire/info2');?>";
        /*显示函数*/
        var assign = function(val, str){
            var head = $("#myModalInfo .Right span");
            if(!val.title){
                head.eq(0).text("未命名");
            }else{
                head.eq(0).text(val.title);
            }
            head.eq(1).text(val.create_time);
            head.eq(2).text(val.update_time);
            head.eq(3).text(str);
            head.eq(4).text(val.post_time);
            head.eq(5).text( val.num_of_question);
            head.eq(6).text(val.is_login);
            head.eq(7).text(val.num_of_answerer);
            console.log(val)
        }
        /*问卷信息弹出框*/
        $("a[data-reveal-id='myModalInfo']").click(function(){

            /*获取点击位置的问卷ID*/
            var survey_id = $(this).parent().parent().children("td").find("p").html();

            /*判断是已发布还是未发布点击*/
            if($("#tabsF li.active a").html() == "已发布"){
                $.ajax({
                    type:"GET",
                    dataType: "json",
                    data: {SID: survey_id},
                    url: UpdateURL,
                    success: function(data,t){
                        $.each(data, function(n,val){
                            if(val["survey_id"] == survey_id) {
                                assign(val,"是");
                            }
                        });
                    },
                    error: function(data){
                        alert("获取失败")
                    }
                })
            }
            else{
                $.ajax({
                    type:"GET",
                    dataType: "json",
                    url: NoneUpdateURL,
                    success: function(data,t){
                        $.each(data, function(n,val){
                            if(val["survey_id"] == survey_id) {
                                assign(val,"否");
                            }
                        });
                    },
                    error: function(data){
                        alert("获取失败")
                    }
                })
            }

        })

        $("a[data-reveal-id='myModal11']").click(function(){
            var tmp = $(this).parent().parent().children("td").find("span").html();
            $("#myModal11 span").text(tmp);
        });
    })
</script>


<!--问卷信息的弹出层-->
<div id="myModalInfo" class="reveal-modal">
    <a class="close-reveal-modal"><img src="/Public/img/Icons/closeQ.png" width="26" height="26"></a>
    <div class="modal-container">
        <div class="Left">
            <span>问卷名</span>
            <span>创建时间</span>
            <span>最后修改时间</span>
            <span>是否发布</span>
            <span>发布时间</span>
            <span>问题数</span>
            <span>是否需要登录回答</span>
            <span>回答人数（收集回答数）</span>
        </div>
        <div class="Right">
            <span>大学生创业调查</span>
            <span>2015年6月2日,19:15:16</span>
            <span>2015年6月2日,19:17:16</span>
            <span>是</span>
            <span>2015年6月2日,19:20:16</span>
            <span>3</span>
            <span>是</span>
            <span>3</span>
        </div>

    </div>
    <!--block-->
</div>

<section class="content">
    <div class="container">
        <ul id="tabsF">
            <li><a href="#tab1">已发布</a></li>
            <li><a href="#tab2">未发布</a></li>
        </ul>

        <table>
            <thead>
            <td style="width: 83px">编号</td>
            <td>标题</td>
            <td>操作</td>
            </thead>

            <tbody id="tab1">

            <!--tab1邀请回答弹出层-->
            <div id="myModal11" class="reveal-modal">
                <a class="close-reveal-modal"><img src="/Public/img/Icons/closeQ.png" width="26" height="26"></a>
                <span class="reveal-p">www.github.com/Elson8080longWordsTestLongWordsTestlongWordsTestLongWordsTestngWordsTestlongWordsTestLongWordsTest</span>
                <button name="copy" class="submit" style="border-radius: 5px; width: 100px; letter-spacing: 0; font-size: 15px;">点击复制</button>
            </div>
            <!--block-->
            <?php if(is_array($survey1)): foreach($survey1 as $i=>$detail): ?><tr>
                    <td><?php echo ($i+1); ?></td>
                    <td><?php echo ($detail[title]); ?>
                        <?php if($detail[survey_status] == 2 ): ?>(已结束)
                            <?php else: ?> (已发布)<?php endif; ?>
                    </td>
                    <td>
                        <a href="/index.php/MyQuestionnaire/download/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Icons/exportQ.png">导出答案</a>
                        <a href="/index.php/MyQuestionnaire/look/survey_id/<?php echo ($detail[survey_id]); ?>/p/<?php echo ($p); ?>/m/1"><img src="/Public/img/Icons/throughQ.png">查看问卷</a>
                        <a data-reveal-id="myModal11"><img src="/Public/img/Icons/inviteQ.png">邀请回答</a>
                        <a data-reveal-id="myModalInfo"><img src="/Public/img/Icons/inforQ.png">问卷信息</a>
                        <a href="/index.php/MyQuestionnaire/stop/survey_id/<?php echo ($detail[survey_id]); ?>/status/<?php echo ($detail[survey_status]); ?>"><img src="/Public/img/Icons/closeQ.png">停止发布</a>
                        <p><?php echo ($detail[survey_id]); ?></p>
                        <span><?php echo ($detail[survey_location]); ?></span>
                    </td>
                </tr>
                <!--控制样式组件，请不要删除--><?php endforeach; endif; ?>
            <!--控制样式组件，请不要删除-->
            <tr style="height: 100%;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>

            <tbody id="tab2">
            <?php if(is_array($survey2)): foreach($survey2 as $i=>$detail): ?><tr>
                    <td><?php echo ($i+1); ?></td>
                    <td><?php echo ($detail[title]); ?>(未发布)</td>
                    <td>
                        <a href="/index.php/Design/modifyQues/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Icons/check.png">修改问卷</a>
                        <a href="/index.php/MyQuestionnaire/delete/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Icons/closeQ.png">删除问卷</a>
                        <a href="/index.php/MyQuestionnaire/look/survey_id/<?php echo ($detail[survey_id]); ?>/p/<?php echo ($p); ?>/m/0"><img src="/Public/img/Icons/throughQ.png">查看问卷</a>
                        <a data-reveal-id="myModalInfo"><img src="/Public/img/Icons/inforQ.png">问卷信息</a>
                        <a href="/index.php/MyQuestionnaire/post/survey_id/<?php echo ($detail[survey_id]); ?>"><img src="/Public/img/Icons/export.png">发布问卷</a>
                        <p><?php echo ($detail[survey_id]); ?></p>
                    </td>
                </tr><?php endforeach; endif; ?>
            <!--控制样式组件，请不要删除-->
            <tr style="height: 100%;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<aside id="tab1-aside">
    <a href="/index.php/MyQuestionnaire/index/p/1/m/1#tab1">首页</a>
    <a href="/index.php/MyQuestionnaire/index/p/1/m/1#tab1"> << </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($pre); ?>/m/1#tab1"> < </a>
    <a> <?php echo ($p); ?> </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($after); ?>/m/1#tab1"> > </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($last); ?>/m/1#tab1"> >> </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($last); ?>/m/1#tab1">尾页</a>
</aside>
<aside id="tab2-aside">
    <a href="/index.php/MyQuestionnaire/index/p/1/m/0#tab2">首页</a>
    <a href="/index.php/MyQuestionnaire/index/p/1/m/0#tab2"> << </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($pre); ?>/m/0#tab2"> < </a>
    <a> <?php echo ($p); ?> </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($after); ?>/m/0#tab2"> > </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($last_nonPost); ?>/m/0#tab2"> >> </a>
    <a href="/index.php/MyQuestionnaire/index/p/<?php echo ($last_nonPost); ?>/m/0#tab2">尾页</a>
</aside>
</body>
</html>