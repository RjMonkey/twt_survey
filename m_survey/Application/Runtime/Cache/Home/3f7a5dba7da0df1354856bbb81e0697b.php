<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Public/css/wodewenjuan.css"/>
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/wodewenjuan.js"></script>
    <title></title>
</head>
<body>
<header>
    <nav>
        <a href="<?php echo U('Index/index');?>"><img src="/Public/img/logo.png" id="logo"/></a>
        <ul>
            <li><a href="<?php echo U('Myqsnaire/index');?>">我的问卷</a></li>
            <li><a href="<?php echo U('Fill/fill');?>">问卷填写</a></li>
            <li><a href="<?php echo U('Design/index');?>">问卷设计</a></li>
            <!--<li><a href="">问卷统计</a></li>-->
        </ul>
    </nav>
    <!--<div id="exitBar">--><button id="name"><?php echo (session('realname')); ?></button><button id="exit"><a href="<?php echo U('User/logout');?>"> 注销</a></button><!--</div>-->
</header>
<img src="/Public/img/pagetag.png" id="tag"/>

<!-- <div id="yifabuTag">
    <p>已发布</p>
</div>
<div id="weifabuTag">
    <p>未发布</p>
</div> -->
<!--<img src="/Public/img/yifabu.png" id="yifabuTag"/>-->
<!--<img src="/Public/img/weifabu.png" id="weifabuTag"/>-->
<button id="yifabuTag" >已发布</button>
<button id="weifabuTag" >未发布</button>
<table id="yifabu" border="0" cellspacing="0" >
    <tr>
        <td id="biaohao" width=83 height=30>编号</th>
        <td id="biaoti">标题</th>
        <td id="caozuo">操作</th>
    </tr>
    <?php if(is_array($survey1)): foreach($survey1 as $i=>$id): ?><tr class="wenJuanList" id="ordinaryYifabu">
            <td class="wenJuanNum"> <?php echo ($i+1); ?> </td>
            <td class="wenJuanTitle"> <a href="<?php echo U('Myqsnaire/chakan', array('survey_id'=>$id['survey_id']));?>"><?php echo ($id['title']); ?></a> </td>
            <td class="wenJuanCaoZuo">
                <a href="<?php echo U('Myqsnaire/download', array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/daochuhuida.png"/></a>
                <?php if($id['survey_status'] == 2): ?><a href="<?php echo U('Myqsnaire/chakan', array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/chakanwenjuan.png"/></a><?php endif; ?>
                <?php if($id['survey_status'] == 1): ?><img src="/Public/img/yaoqinghuida.png" class="yaoQingHuiDaClass"/><?php endif; ?>
                <?php if($id['survey_status'] == 2): ?><a href="<?php echo U('Myqsnaire/xinxi', array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/wenjuanxinxi.png"/></a><?php endif; ?>
                <?php if($id['survey_status'] == 1): ?><a href="<?php echo U('Myqsnaire/stop',array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/tingzhifabu.png"/></a><?php endif; ?>
                <input type="hidden" class="location" value=<?php echo ($id['survey_location']); ?> />
            </td>
        </tr><?php endforeach; endif; ?>
</table>

<table id="weifabu" vborder="0" cellspacing="0">
    <tr>

    </tr>
    <tr>
        <td id="biaohao" width=83 height=30>编号</th>
        <td id="biaoti">标题</th>
        <td id="caozuo">操作</th>
    </tr>
    <?php if(is_array($survey2)): foreach($survey2 as $i=>$id): ?><tr class="wenJuanList" id="ordinaryWeifabu">
            <td class="wenJuanNum"><?php echo ($i+1); ?></td>
            <td class="wenJuanTitle"><?php echo ($id['title']); ?></td>
            <td class="wenJuanCaoZuo">
                <a href="<?php echo U('Design/reedit',array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/xiugaiwenjuan.png"/></a>
                <a href="<?php echo U('Design/deleteall',array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/shanchuwenjuan.png"/></a>
                <a href="<?php echo U('Design/fabu',array('survey_id'=>$id['survey_id']));?>"><img src="/Public/img/fabuwenjuan.png"/></a>

            </td>
        </tr><?php endforeach; endif; ?>
</table>
</body>
</html>