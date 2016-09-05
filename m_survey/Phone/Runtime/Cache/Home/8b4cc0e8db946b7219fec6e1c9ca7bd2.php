<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>天外天问卷中心--添加选择题</title>
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

<script>
    var i = 0;
    //    $(function(){
    //        $("body").prepend("<div id='Ttop'></div>");
    //        $("#Ttop").load("<?php echo U('Template/nav-top');?>")
    //    })
</script>
<div id='Ttop'>
    <div class="phoneContent" >
        <div class="row">
            <div class="row-left">
                <a href="/index.php/Design/addQues"><img src="/Public/img/smallIcon.png" width="10" height="15" class="rowThat"></a>
            </div>
            <h2></h2>
            <div class="row-right">
                <img src="/Public/img/smallIcon.png" width="10" height="15" style="visibility: hidden;">
            </div>
        </div>
    </div>
</div>
<form class="phoneTag" action="/index.php/Design/addQ/survey_id/<?php echo ($survey_id); ?>/data/<?php echo ($type); ?>" method="post">
    <div class="QTitle">
        <p>题目标题</p>
        <input required class="Qtitle-input" name="content" placeholder="请输入题目名称">
    </div>
    <div class="Question Qradio" style="margin-top: 20px;">
        <input type="radio" name="radio" value="1" id="r1">
        <label for="r1" id="l1">单选题</label>
        <input type="radio" name="radio" value="2" id="r2">
        <label for="r2" id="l2">多选题</label>
    </div>
    <div class="QTitle" style="padding-top: 18px;">
        <input required class="Qtitle-input Q2" name="option" placeholder="请输入选项名称（必填）">
        <div class="tttt"><input required class="Qtitle-input Q2 Q3" name="option2[0]" placeholder="请输入选项名称（必填）"></div>
    </div>
    <div class="Question textCenter AddOne">
        <a><img src="/Public/img/AddBtn.png" width="22" height="22"><span>添加选项</span></a>
    </div>

    <div class="Question" style="margin-top: 42px;  padding-left: 3%;">
        <span>此题目为必答题</span>
        <div class="sect selectedtrue">
            <input type="checkbox" name="must" id="checkbox" checked>
            <label for="checkbox"></label>
        </div>
    </div>

    <!--<div class="Question lastQ" style="margin-top: 27px; padding-left: 3%;">-->
        <!--<span>最多选择</span>-->
        <!--<select style="float: right;" name="max" id="select">-->
            <!--<option selected>不限</option>-->
            <!--<option>1</option>-->
            <!--<option>2</option>-->
            <!--<option>3</option>-->
        <!--</select>-->
    <!--</div>-->

    <button class="submit">确定</button>
</form>
<script src="/Public/js/checkbox.js"></script>
<script>
    $(function(){
        setTimeout(function(){
            $(".AddOne").click(function(){
                i++;
                $(".tttt:last-child").after("<div class='tttt'><input class='Qtitle-input Q2 Q3' name='option2["+i+"]' placeholder='请输入选项名称'> <img src='/Public/img/Sicon.png' class='Sicon'></div>");
            });

            $(".QTitle").delegate('.tttt img','click',function(){
                $(this).parent().remove();
            });

            $("label[for='checkbox']").click(function(){
                setTimeout(function(){
                    var s = $(".sect");
                    if($("#checkbox").is(":checked")){
                        s.addClass("selectedtrue");
                        s.removeClass("selectedfalse");
                    }else{
                        s.addClass("selectedfalse");
                        s.removeClass("selectedtrue");
                    }
                },1);
            });

            function getURL(name){
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return unescape(r[2]); return null;
            }

            function click1(){

                $(".lastQ").hide();
                $(".row h2").text("单选题");
            }
            function click2(){
                $(".lastQ").show();
                $(".row h2").text("多选题");
            }

            var tmp = "<?php echo ($type); ?>";
            if(tmp == "Single"){

                click1();
                $("#r1").attr("checked","checked");
            }else{
                click2();
                $("#r2").attr("checked","checked");
            }

            $("#l1").click(function(){
                click1();
            });
            $("#l2").click(function(){
                click2();
            });
        },1)
    })
</script>
</body>
</html>