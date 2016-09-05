<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天外天问卷中心</title>
    <link href="/m_survey/Public/css/style.css" rel="stylesheet">
    <link rel="icon" href="/m_survey/Public/img/PageIcon.jpg">
</head>
<script src="/m_survey/Public/js/jquery.min.js"></script>
<script src="/m_survey/Public/js/jquery.reveal.js"></script>
<script src="/m_survey/Public/js/jquery.easing.min.js"></script>
<script src="/m_survey/Public/js/ElsonLiu.js"></script>
<!--<script src="js/TWT_Que.min.js"></script>-->
<body class="Pagesbody">
<!--header-->
<div class="header">
    <div class="row">
        <div class="header-logo">
            <img src="/m_survey/Public/img/logo-main.png">
        </div>
        <ul>
            <li><a href="/m_survey/index.php/Fill/fill">问卷填写</a></li>
            <li><a href="/m_survey/index.php/Design/quesDesign">问卷设计</a></li>
            <li><a href="/m_survey/index.php/Statics/index">问卷统计</a></li>
            <li class="header-log"><a href="<?php echo U('Index/sso_jump');?>" data-animation="fade">登录</a> <span class="header-span"> | </span><a>注册</a></li>
        </ul>
    </div>
</div>
<!--End-header-->


<!--content-->
<div class="content">
    <div class="row">
        <div class="content-words">
            <p>从现在开始</p>
        </div>
        <div class="content-words-center">
            <p>用<span>天外天问卷中心</span>协助你的调研生活</p>
        </div>
        <div class="content-btn">
            <a data-reveal-id="myModal" data-animation="fade"><button>登录</button></a>
        </div>
    </div>
</div>
<!--End-content-->

<!--弹出层-->
<div id="myModal" class="reveal-modal">
    <h1>天外天问卷中心</h1>
    <p>请使用天外天账号进行登录</p>
    <form class="modal-form" action="<?php echo U('Index/login');?>" method="post">
        <div class="modal-block">
            <img src="/m_survey/Public/img/Icon1.png"><input id="username" class="username" name="username" type="text" placeholder="用户名" required>
        </div>
        <div class="modal-block" style="margin-top: 25px;">
            <img class="img2" src="/m_survey/Public/img/Icon2.png"><input id="psd" class="psd" name="password" type="password" placeholder="密码" required>
        </div>
        <div class="rememberme">
            <input id="checkinput" type="checkbox"> <span>记住我</span>
            <a class="modal-btn" href="http://www.twt.edu.cn/account/forget.php?t=password">忘记密码？</a>
        </div>
        <button id="submit" class="submit-a">登录</button>
    </form>

    <span class="close-reveal-modal">&#215;</span>
</div>

<!--banner-->
<div class="banner">
    <div class="row">
        <div class="banner-words">
            <p>来自天外天的问卷调查平台</p>
        </div>
        <div class="banner-img">
            <img src="/m_survey/Public/img/banner.png">
        </div>

        <div class="banner-recommend">
            <div class="banner-h">
                <img src="/m_survey/Public/img/Recommend2.png">
                <a class="banner-rs" href="<?php echo ($more); ?>">MORE</a>
            </div>
            <ul>
                <?php if(is_array($new)): foreach($new as $i=>$id): ?><li><a href=<?php echo ($id['survey_location']); ?>><?php echo ($id['title']); ?><span class="a-span"><?php echo ($id['fabu_time']); ?></span></a></li><?php endforeach; endif; ?>
            </ul>
        </div>

        <div class="banner-recommend recomend2">
            <div class="banner-h">
                <img src="/m_survey/Public/img/Recommend.png">
                <a class="banner-rs" href="<?php echo ($more); ?>">MORE</a>
            </div>
            <ul>
                <?php if(is_array($recommend)): foreach($recommend as $i=>$id): ?><li><a href=<?php echo ($id['survey_location']); ?>><?php echo ($id['title']); ?><span class="a-span"><?php echo ($id['fabu_time']); ?></span></a></li><?php endforeach; endif; ?>
            </ul>
        </div>

        <div class="banner-next">
            <a href="#unique1" class="ss-next page-scroll"><img src="/m_survey/Public/img/next.png" id="banner-next"></a>
        </div>
    </div>
</div>
<!--End-banner-->

<div class="unique" id="unique1">
    <div class="row">
        <div class="unique-words">
            <h2>UNIQUE</h2>
            <h3>独特的问卷外观</h3>
            <img src="/m_survey/Public/img/line.png">
            <p class="unique-p">拜托传统问卷的枯燥，增添活泼与个性</p>
            <p>独特的问卷外观让你的问卷更具吸引力，使填写过程轻松愉悦</p>
        </div>
        <div class="unique-img">
            <img src="/m_survey/Public/img/interface.png">
        </div>

        <div class="unique-next">
            <a href="#unique2" class="ss-next page-scroll"><img src="/m_survey/Public/img/next.png" id="unique-next"></a>
        </div>
    </div>
</div>

<div class="unique" id="unique2">
    <div class="row">
        <div class="unique-words">
            <h2>VARIOUS</h2>
            <h3 style="font-weight: bold;">多样的问卷题型</h3>
            <img src="/m_survey/Public/img/line.png">
        </div>
        <div class="unique-img2">
            <img src="/m_survey/Public/img/pic.png">
            <p style="margin-top: 60px;">多种题型和常见问题供选择，满足不同需求</p>
            <p style="margin-top: 12px;">问卷创建省时省力，问卷填写样式丰富</p>
        </div>

        <div class="unique2-next">
           <a href="#unique3" class="ss-next page-scroll"><img src="/m_survey/Public/img/next.png" id="unique2-next"></a>
        </div>
    </div>
</div>

<div class="unique" id="unique3">
    <div class="row">
        <div class="unique-words">
            <h2>PERFECT</h2>
            <h3 style="font-weight: bold;">完备的数据分析</h3>
            <img src="/m_survey/Public/img/line.png">
            <p class="unique-p">精致细致的数据分析，降低分析无误差</p>
            <p>数据分析表现形式丰富，分析结果一目了然</p>
        </div>
        <div class="unique-img3">
            <img src="/m_survey/Public/img/row.png">
        </div>
        <?php if(!isset($_SESSION['uid'])): ?><div class="unique-btn">
                <a  data-reveal-id="myModal" data-animation="fade"><button>立即使用</button></a>
            </div>
            <?php else: ?>
            <div class="unique-btn">
                <a href="/m_survey/index.php/myQuestionnaire/index"><button>立即使用</button></a>
            </div><?php endif; ?>
    </div>
</div>
<!--End-unique-->

<!--Footer-->
<div class="footer">
    <p>Copyright 2015 TWT Studio. All rights reserved</p>
</div>

</body>
</html>