<?php if (!defined('THINK_PATH')) exit();?><!--PC header-->
<div class="container">
    <a href="/m_survey/index.php/Index/index"><img src="/m_survey/Public/img/nav-top.png" width="223" height="39"></a>
    <ul>
        <li><a href="/m_survey/index.php/MyQuestionnaire/index">我的问卷</a></li>
        <li><a href="/m_survey/index.php/Fill/fill">问卷填写</a></li>
        <li><a href="/m_survey/index.php/Design/quesDesign">问卷设计</a></li>
        <li><a href="/m_survey/index.php/Statics/index">问卷统计</a></li>
        <li><span><?php echo (session('username')); ?></span> | <a href="/m_survey/index.php/Index/logout">注销</a></li>
    </ul>
    <div class="clearFloat"></div>
</div>