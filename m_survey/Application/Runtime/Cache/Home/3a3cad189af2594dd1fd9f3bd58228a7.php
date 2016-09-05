<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <script src="/Public/js/jquery.form.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Public/css/sheji.css"/>
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/wenjuansheji.js"></script>

    
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
    <input type="hidden" id="myId" value=<?php echo ($survey_id); ?> />
    <input type="hidden" id="isreedit" value=<?php echo ($isreedit); ?> />

    <div id="tempedit">
        <p id="showTitle"><?php echo ($Fill["title"]); ?></p>
        <img src="../img/hengxian.png"/>
        <p id="showDescription"><?php echo ($Fill["description"]); ?></p>
        <div id="main">
            <?php if(is_array($question)): foreach($question as $i=>$id): ?><div class="block">
                    <?php if($id['is_must'] == 1): ?><p class="must">*Q</p>
                        <?php else: ?>
                        <p class="must">Q</p><?php endif; ?>
                    <p class="num"><?php echo ($i); ?></p>. <p class="title"><?php echo ($id['question_content']); ?></p>
                    <?php if($id['question_type'] == 1): if(is_array($id['xuanxiang'])): $j = 0; $__LIST__ = array_slice($id['xuanxiang'],1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($j % 2 );++$j;?><div class="allList danXuanList"><input type="radio" name="<?php echo ($id['question_content']); ?>"/><p><?php echo ($option); ?></p></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if($id['question_type'] == 2): if(is_array($id['xuanxiang'])): $j = 0; $__LIST__ = array_slice($id['xuanxiang'],1,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($j % 2 );++$j;?><div class="allList duoXuanList"><input type="checkbox" /><p><?php echo ($option); ?></p></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if($id['question_type'] == 3): ?><div class="allList tianKongList"><p><?php echo ($id['question_content']); ?></p><textarea></textarea></div><?php endif; ?>
                </div><?php endforeach; endif; ?>
        </div>
    </div>

    <main>

        <form>
            <div class="sidebar">
                <div id="exitButton"><img src="/Public/img/back.png"/></div>
                <div id="danXiangButton" class="addButton"><img src="/Public/img/danxiangxuanzeti.png"/></div>
                <div id="duoXiangButton" class="addButton"><img src="/Public/img/duoxiangxuanzeti.png"/></div>
                <div id="duoHangButton" class="addButton"><img src="/Public/img/duohangtiankongti.png"/></div>
                <!--<div id="xiaLaButton" class="addButton"><img src="/Public/img/xialaxuanxiangti.png"/></div>-->
                <!--<div id="fuJianButton" class="addButton"><img src="/Public/img/fujianshangchuanti.png"/></div>-->
            </div>
            
            <!--下面是添加图片的部分-->
            
            <div id="uploadpicture">
                <p>请上传一张图片作为你的封面(如果未上传则使用系统默认封面)</p>
                <input type="file" accept="image/png,image/gif,image/jpeg" name="photo" id="thepicture"/>
            </div>

            <input type="hidden" name="is_upload" id="is_upload"/>
           

            <style>
                #uploadpicture {
                    box-sizing: border-box;
                    position: relative;
                    float: left;
                    margin-left: 150px;
                    width: 960px;
                    margin-top: 10px;
                    margin-right: 0;
                    font-size: 18px;
                    border:solid #cccccc 1px;
                    height: auto;
                    background-color: white;
                    text-align: center;
                    padding: 10px;s

                }
                #uploadpicture p {
                    position: relative;
                    display: block;
                    margin:0 auto;
                    margin-top: 2px;
                    margin-bottom: 2px;
                    font-size: 18px;
                }
                #uploadpicture input {
                    position: relative;
                    display: block;
                    margin: 0 auto;
                    /*margin-bottom: 2000px;*/
                    margin-top: 2px;
                    font-size: 18px;
                }
            </style>
            <!---->


            <!--下面是几个主体部分-->
            <div class="danXuan" id="ordinaryDanXuan">
                <p class="numOfXuanXiang">0</p>
                <span class="danJiCiShu">0</span>
                <div class="smallBar">
                    <p>Q1</p>
                    <button class="up" onclick="return false;"><img src="/Public/img/up.png"/></button>
                    <button class="down" onclick="return false;"><img src="/Public/img/down.png"/></button>
                    <button class="delete" onclick="return false;"><img src="/Public/img/delete.png"/></button>
                </div>
                <div class="neiBuBiaoTi">
                    <p>单选题</p><input type="text"/>
                </div>
                <div class="mainBoard">
                    <!--<input type="radio" name="danXuanXiang" value="1"/><lable>选项1</lable><br/>
                    <input type="radio" name="danXuanXiang" value="2"/><lable>选项2</lable><br/>
                    <input type="radio" name="danXuanXiang" value="3"/><lable>选项3</lable><br/>-->
                </div>
                <div class="downBoard">
                    <button onclick="return false;"><img src="/Public/img/add.png"/></button>
                    <!--<button onclick="return false;" class="littleJian"><img src="/Public/img/jian.png"/></button>-->
                    <input type="checkbox" name="requireTest"/><label>必填</label>
                </div>
            </div>
            <!---->
            <div class="duoXuan" id="ordinaryDuoXuan">
                <p class="numOfXuanXiang">0</p>

                <div class="smallBar">
                    <p>Q2</p>
                    <button class="up" onclick="return false;"><img src="/Public/img/up.png"/></button>
                    <button class="down" onclick="return false;"><img src="/Public/img/down.png"/></button>
                    <button class="delete" onclick="return false;"><img src="/Public/img/delete.png"/></button>
                </div>
                <div class="neiBuBiaoTi">
                    <p>多选题</p><input type="text"/>
                </div>
                <div class="mainBoard">
                    <!--<input type="checkbox" name="danXuanXiang" value="1"/><lable>选项1</lable><br/>
                    <input type="checkbox" name="danXuanXiang" value="2"/><lable>选项2</lable><br/>
                    <input type="checkbox" name="danXuanXiang" value="3"/><lable>选项3</lable><br/>-->
                </div>
                <div class="downBoard">
                    <button onclick="return false;"><img src="/Public/img/add.png"/></button>
                    <input type="checkbox" name="requireTest"/><label>必填</label>
                </div>
            </div>
            <!---->
            <div class="duoHang" id="ordinaryDuoHang">
                <div class="smallBar">
                    <p>Q3</p>
                    <button class="up" onclick="return false;"><img src="/Public/img/up.png"/></button>
                    <button class="down" onclick="return false;"><img src="/Public/img/down.png"/></button>
                    <button class="delete" onclick="return false;"><img src="/Public/img/delete.png"/></button>
                </div>
                <div class="neiBuBiaoTi">
                    <p>填空题</p><input type="text"/>
                </div>
                <div class="mainBoard">
                    <textarea cols="30" name="多行题"></textarea>
                </div>
                <div class="downBoard">
                    <!--<button><img src="/Public/img/add.png"/></button>-->
                    <input type="checkbox" name="requireTest"/><label>必填</label>
                </div>
            </div>
            </form>
            <!---->
            <!--<div class="xiaLa" id="ordinaryXiaLa">
                <p class="numOfXuanXiang">0</p>

                <div class="smallBar">
                    <p>Q4</p>
                    <button class="up" onclick="return false;"><img src="/Public/img/up.png"/></button>
                    <button class="down" onclick="return false;"><img src="/Public/img/down.png"/></button>
                    <button class="delete" onclick="return false;"><img src="/Public/img/delete.png"/></button>
                </div>
                <div class="neiBuBiaoTi">
                    <p>多选题</p><input type="text"/>
                </div>
                <div class="mainBoard">
                    &lt;!&ndash;<input type="checkbox" name="danXuanXiang" value="1"/><lable>选项1</lable><br/>
                    <input type="checkbox" name="danXuanXiang" value="2"/><lable>选项2</lable><br/>
                    <input type="checkbox" name="danXuanXiang" value="3"/><lable>选项3</lable><br/>&ndash;&gt;
                    <select>
                    </select>
                </div>
                <div class="downBoard">
                    <button onclick="return false;"><img src="/Public/img/add.png"/></button>
                    <input type="checkbox" name="requireTest"/><label>必填</label>
                </div>
            </div>-->
            <!---->
            <div class="foot">
                <p>感谢您的配合</p>

                <button id="save" onclick="return false;">保存</button>
                <button id="preload" onclick="return false;">预览</button>
                <button id="publish" onclick="return false;">发布</button>
            </div>
        
        <input type="hidden" id="isSave"/>
        <div id="zheZhao"><img src="/Public/img/zhezhao.png"/></div>
        <div id="sureToExit">
            <img src="/Public/img/sureToExitName.png" />
            <button id="inLeave1" ><img src="/Public/img/exit.png"/></button>
            <p>您尚未保存，是否退出？</p>
            <button id="inSave"><img src="/Public/img/baoCun.png"/></button>
            <button id="inExit"><img src="/Public/img/tuichu2.png" /></button>
        </div>
        <div id="sureToPublish">
            <button id="inLeave2" ><img src="/Public/img/exit.png"/></button>
            <p id="p1">确认发布</p>
            <p id="p2">您是否要发布问卷？</p>
            <button id="inSure"><img src="/Public/img/queding.png"/> </button>
            <button id="inExit2"><img src="/Public/img/quxiao.png"/></button>
        </div>
        <div id="canvas">
        </div>
        <!--<form name="tiJiao" method="post" action="test.php">
            <input type="hidden" name="titile" value="12"/>
            <input type="hidden" name="description" />
            <input type="hidden" name="question_number"/>
            <input type="hidden" name="arr[]" id="ttt"/>
            <script>
                var s = new Array();
                s[1] = "hello";
                $("#ttt").value = s;
            </script>
            <input type="submit" />
        </form>-->

    </main>

</body>
</html>