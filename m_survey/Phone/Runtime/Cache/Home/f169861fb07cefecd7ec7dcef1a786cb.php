<?php if (!defined('THINK_PATH')) exit();?>
<!--topplace-->
<div class="phoneContent">
    <div class="row">
        <div class="row-left">
            <a id="nv-left"><img src="/m_survey/Public/img/Phone-Icon1.png"></a>
        </div>
        <h2></h2>
        <a><img src="/m_survey/Public/img/Phone-Icon1.png" class="ab"></a>
        <div class="row-right">
            <a ><img src="/m_survey/Public/img/Phone-Icon2.png" class="cd"></a>
        </div>
    </div>
</div>

<!--左侧滑出框-->
<div class="nav-left">
    <div class="nav-top">
        <img src="/m_survey/Public/img/nav-top.png" width="112" height="20">
    </div>
    <div class="nav-headerLogo">
        <div class="circle">
            <!--用户图片位置-->
        </div>
    </div>
    <ul class="nav-navAll">
        <li><a href="/m_survey/index.php/MyQuestionnaire/index">我的问卷 <img src="/m_survey/Public/img/BiggerIcon.png"></a></li>
        <li><a >问卷填写 <img src="/m_survey/Public/img/BiggerIcon.png"></a></li>
        <li><a href="/m_survey/index.php/Design/index">我的设计 <img src="/m_survey/Public/img/BiggerIcon.png"></a></li>
        <li><a>我的统计 <img src="/m_survey/Public/img/BiggerIcon.png"></a></li>
    </ul>
</div>

<script>
    /*nav-left show and hide*/
    $(function(){
        /*for another stuff hide*/
        $(".ab").hide();
        $("#nv-left").click(function(){
            $(".nav-left").animate({marginLeft: "0px"});
            $(".ab").show(500);
            $(".cd").hide();
            $("#row-h2").css("visibility","hidden");
        });
        $(".ab").click(function(){
            $(".ab").hide();
            $(".cd").show();
            $(".nav-left").animate({marginLeft: "-240px"});
            $("#row-h2").css("visibility","visible");
        });
    })
</script>