<?php if (!defined('THINK_PATH')) exit();?>
<span class="Single">
    <img class='reduceBtn' src='/Public/img/DesignIcons/ReduceOne.png' width='20' height='20'>
    <img src='/Public/img/Icons/circleNone.png'><input type='text' placeholder='请填写选项'>
</span>

<span class="Muti">
    <img class='reduceBtn' src='/Public/img/DesignIcons/ReduceOne.png' width='20' height='20'>
    <img src="/Public/img/Icons/rectNone.png" width="18" height="18" >
    <input type="text" placeholder="请填写选项" style="left: 5px;">
</span>




<!--单选题-->
<div>
    <div class="singleQuesCreate">
        <div class="S-left">
            <h2>Q1</h2>
            <img src="/Public/img/DesignIcons/TopAngle.png" width="18" height="20">
            <br>
            <img src="/Public/img/DesignIcons/boAngle.png" width="18" height="20">
            <br>
            <img src="/Public/img/DesignIcons/garbage.png" width="20" height="20">
        </div>
        <div class="S-right dynamic">
            <input type="text" placeholder="单选题题目" required>
            <div>
                <img src="/Public/img/Icons/circleNone.png" style="margin-top: 20px;"><input type="text" placeholder="请填写选项" required>
                <br>
                <img src="/Public/img/Icons/circleNone.png"><input type="text" placeholder="请填写选项" required>
                <br>
                <img src="/Public/img/Icons/circleNone.png"><input type="text" placeholder="请填写选项" required>
            </div>
            <input type="checkbox"><img src="/Public/img/Icons/rectNone.png" width="20" height="20"><img src="/Public/img/Icons/rectChoose.PNG" width="20" height="20"><label>必填</label>
            <img src="/Public/img/DesignIcons/AddOne.png" width="22" height="22">
        </div>
    </div>
</div>

<!--多选题-->
<div>
    <div class="mutiplyChoose">
        <div class="S-left">
            <h2>Q2</h2>
            <img src="/Public/img/DesignIcons/TopAngle.png" width="18" height="20">
            <br>
            <img src="/Public/img/DesignIcons/boAngle.png" width="18" height="20">
            <br>
            <img src="/Public/img/DesignIcons/garbage.png" width="20" height="20">
        </div>
        <div class="S-right dynamic">
            <input type="text" placeholder="多选题题目" required>
            <div>
                <img src="/Public/img/Icons/rectNone.png" width="18" height="18" style="margin-top: 20px;"><input type="text" placeholder="请填写选项" required>
                <br>
                <img src="/Public/img/Icons/rectNone.png" width="18" height="18" ><input type="text" placeholder="请填写选项" required>
                <br>
                <img src="/Public/img/Icons/rectNone.png" width="18" height="18" ><input type="text" placeholder="请填写选项" required>
            </div>
            <input type="checkbox"><img src="/Public/img/Icons/rectNone.png" width="20" height="20"><img src="/Public/img/Icons/rectChoose.PNG" width="20" height="20"><label>必填</label>
            <img src="/Public/img/DesignIcons/AddOne.png" width="22" height="22">
        </div>
    </div>
</div>


<!--填空题-->
<div>
    <div class="FillQuesD">
        <div class="S-left">
            <h2>Q3</h2>
            <img src="/Public/img/DesignIcons/TopAngle.png" width="18" height="20">
            <br>
            <img src="/Public/img/DesignIcons/boAngle.png" width="18" height="20">
            <br>
            <img src="/Public/img/DesignIcons/garbage.png" width="20" height="20">
        </div>
        <div class="S-right dynamic">
            <input type="text" placeholder="填空题题目" required>
            <br><br>
            <textarea placeholder="请输入题目"></textarea>
            <input type="checkbox"><img src="/Public/img/Icons/rectNone.png" width="20" height="20"><img src="/Public/img/Icons/rectChoose.PNG" width="20" height="20"><label>必填</label>
            <div style="padding-bottom: 10px; height: 20px;"></div>
        </div>
    </div>
</div>