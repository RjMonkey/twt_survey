<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head lang="zh-cn">
    <meta charset="utf-8" />
    <!--<link href="/Public/css/tianxiewenjuan.css"/>-->
    <script src="/Public/js/jquery.js"></script>
    <!-- <script src="/Public/js/tianxiewenjuan.js"></script> -->
    <script src="/Public/js/tianxie2.js"></script>

</head>
<body>
<!--<script>
    $(document).ready(function () {
        alert('eeee');
    });
</script>-->
<input type="hidden" id="myId" value=<?php echo ($survey_id); ?>/>
<!--<script>
    alert($("#myId").val());
</script>-->
<input type="hidden" id="myTitle" value=<?php echo ($survey["title"]); ?> />
<input type="hidden" id="myDescription" value=<?php echo ($survey["description"]); ?>/>
<input type="hidden" id="myQuestion_number" value=<?php echo ($survey["question_number"]); ?>/>
<input type="hidden" id="myQuestion" value=<?php echo ($temp); ?> />

<!--<input type="hidden" id="question" value=<?php echo ($question); ?>/>-->

<form>

    <p id="showTitle"></p>
    <img src="/Public/img/hengxian.png"/>
    <p id="showDescription"></p>
    <div id="main">
        <?php if(is_array($question)): foreach($question as $i=>$id): ?><div class="block">
                <?php if($id['is_must'] == 1): ?><p class="must">*Q</p>
                    <?php else: ?>
                    <p class="must">Q</p><?php endif; ?>
                <p class="num"><?php echo ($i+1); ?></p>. <p class="title"><?php echo ($id['question_content']); ?></p>
                <?php if($id['question_type'] == 1): if(is_array($id['result'])): $j = 0; $__LIST__ = $id['result'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($j % 2 );++$j;?><div class="allList danXuanList"><input type="radio" name="<?php echo ($id['question_content']); ?>"/><p><?php echo ($option); ?></p><p class="renshu">已选该选项的人共有： <?php echo ($id['sum'][$j-1]); ?></p></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <?php if($id['question_type'] == 2): if(is_array($id['option'])): $j = 0; $__LIST__ = array_slice($id['option'],0,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($j % 2 );++$j;?><div class="allList duoXuanList"><input type="checkbox" /><p><?php echo ($option); ?></p><p class="renshu">已选该选项的人共有： <?php echo ($id['sum'][$j-1]); ?></p></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <?php if($id['question_type'] == 3): if(is_array($id['result'])): $j = 0; $__LIST__ = array_slice($id['result'],0,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($j % 2 );++$j;?><div class="allList tianKongList"><!--<p><?php echo ($id['question_content']); ?></p>--><textarea><?php echo ($option); ?></textarea></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </div><?php endforeach; endif; ?>
    </div>

</form>
<button id="submitButton" > <img src="/Public/img/chakanfanhui.png" /></button>
<style>
    body {
        font-family:'Microsoft YaHei','Hiragino Sans GB',Helvetica,Arial,'Lucida Grande',sans-serif;
        padding-top: 0;
        margin-top: 0;
        background-color: #f7f7f7;
    }
    .renshu {
        border-left: 3px solid #cccccc;
        border-bottom: 3px solid #cccccc;
        margin-left: 30px;
        /*font-size: 1px;*/
        color: gray;
    }
    #showTitle {
        text-align: center;
        margin:0 auto;
        margin-top: 100px;
        margin-bottom: 20px;
        font-size: 28px;
        font-weight: bold;
    }

    img {
        position: relative;
        display: block;
        margin: 0 auto;

    }

    #showDescription {
        position: relative;
        display: block;
        text-align: center;
        margin:0 auto;
        margin-top: 30px;
        margin-bottom: 30px;
        font-size: 24px;
        color: gray;
    }

    .block {
        margin-left: 30%;
    }

    .block p{
        display: inline-block;
        font-size: 20px;
    }

    .block p:first-child {
        margin-left: 0px;
    }

    #submitButton {
        display: block;
        border: none;
        background: transparent;
        margin:0 auto;
    }



</style>
<script>
    $("#submitButton").click(function () {
        history.back();
    });
</script>
</body>
</html>