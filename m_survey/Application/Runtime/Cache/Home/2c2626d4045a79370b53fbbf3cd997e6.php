<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天外天问卷中心</title>
    <link href="/Public/css/PCStyle.css" rel="stylesheet">
    <link rel="icon" href="/Public/img/PageIcon.jpg">
    <style>
        input{
            outline:medium;
        }
    </style>
</head>
<body>
<script src="/Public/js/jquery.min.js"></script>
<!--绑定事件-->
<script>
    var items = "<?php echo U('Template/items');?>";
    function createSingleQues(){

        $.get(items, function(data){
            var tmp = $(data)[6].innerHTML;
            $(".DynamicPart").append(tmp);
            SingleClick()
        })
    }

    function createMutiQues(){
        $.get(items, function(data){
            var tmp = $(data)[10].innerHTML;
            $(".DynamicPart").append(tmp);
            MutiClick();
        })
    }

    function createFillQues(){
        $.get(items, function(data){
            var tmp = $(data)[14].innerHTML;
            $(".DynamicPart").append(tmp);
        })
    }

    function createSingleItem(that){
        $.get(items, function (data) {
                    var tmp = $(data)[0].innerHTML;
                    that.parent().children("div").append("<div>" + tmp + "</div>");
                }.bind(this)
        )
    }

    function createMutiItem(that){
        $.get(items, function(data){
                    var tmp = $(data)[2].innerHTML;
                    that.parent().children("div").append("<div>" + tmp + "</div>");
                }.bind(this)
        )
    }

    /*单选题添加选项*/
    function SingleClick() {
        $(".singleQuesCreate .S-right img:last-child").click(function() {
            createSingleItem($(this));
        });
    }

    /*多选题添加选项*/
    function MutiClick(){
        $(".mutiplyChoose .S-right img:last-child").click(function(){
            createMutiItem($(this));
        });
    }

    $(function(){
        $("body").prepend("<header class='PC-header'></header>");
        $(".PC-header").load("<?php echo U('Template/header');?>", function(){
            $(".PC-header ul li:eq(2)").append("<div class='triangleTop'></div>");
        })


        /*添加单选题*/
        $(".rightPart ul li:eq(0) a").click(function(){
            createSingleQues()
        })
        /*添加多选题*/
        $(".rightPart ul li:eq(1) a").click(function(){
            createMutiQues();
        })

        /*添加填空题*/
        $(".rightPart ul li:eq(2) a").click(function(){
            createFillQues();
        })

        /*其他题目*/
        $(".rightPart ul li:eq(3) a").click(function(){
            tempClick();
        })
        $(".rightPart ul li:eq(4) a").click(function(){
            tempClick();
        })
        function tempClick(){
            alert("功能正在实现中，敬请稍后");
        }


        /*事件委托删除选项和题目*/
        $(".DynamicPart").delegate(".S-right .reduceBtn","click",function(){
            $(this).parent().remove();
        })
        /*        $(".DynamicPart").delegate(".S-left img","click",function(event){
         var tmp = event.target.getAttribute("src");
         var s =  $(this).parent().parent();
         var arr = ["singleQuesCreate","mutiplyChoose","FillQuesD"];
         switch(tmp){
         case "/Public/img/DesignIcons/TopAngle.png":
         if($.inArray(s.before().attr("class"),arr)){
         s.prev().before(s);
         }
         break;
         case "/Public/img/DesignIcons/boAngle.png":
         if($.inArray(s.next().attr("class"),arr)){
         s.next().after(s);
         }
         break;
         case "/Public/img/DesignIcons/garbage.png":
         s.remove();
         break;
         }

         })*/
        $(".DynamicPart").delegate(".S-left img","click",function(event){
            var tmp = event.target.getAttribute("src");
            var s =  $(this).parent().parent();
            var arr = ["singleQuesCreate","mutiplyChoose","FillQuesD"];
            switch(tmp){
                case "/Public/img/DesignIcons/TopAngle.png":
                    break;
                case "/Public/img/DesignIcons/boAngle.png":
                    break;
                case "/Public/img/DesignIcons/garbage.png":
                    s.remove();
                    break;
            }

        })

    })
</script>

<!--Post操作-->
<script>
    /*传给后台的JSON地址*/
    var URL = "/index.php/Design/modifyAdd/survey_id/<?php echo ($survey_id); ?>";

    /*json格式*/
    var JsonObj = [];


    var QuestionObj = function(Qid, type, content, option, is_must){
        this.Qid = Qid;
        this.type = type;
        this.content = content;
        this.option = option;
        this.is_must = is_must;
    }

    $(function(){
        $(".btnArr input:first-child").click(function(){
            //问题数目
            var Qnum = $(".DynamicPart>div").length;

            var QTitle = {QTitle: $("input.FirstInput").val() };
            var QInfo = {QInfo: $(".InputMiddle > input").val()};
            var Niming = {Niming: $("#niming").is(":checked")?"1":"0"};
            JsonObj.push(QTitle);
            JsonObj.push(QInfo);
            JsonObj.push(Niming);
            /*var type = $(".DynamicPart>div:eq("+i+")").find(".S-left h2").html()[1];*/
            var i;
            var arr = ["singleQuesCreate","mutiplyChoose","FillQuesD"];
            for(i=0; i<Qnum; i++){
                var tmp = $(".DynamicPart>div:eq("+i+")");

                /*Qid获取*/
                var Qid = i+1;
                /*获取题目类型*/
                var type = tmp.attr("class");
                switch(type){
                    case "singleQuesCreate":
                        type = "1";
                        break;
                    case "mutiplyChoose":
                        type = "2";
                        break;
                    case "FillQuesD":
                        type = "3";
                        break;
                }
                /*获取题目*/
                var content = tmp.find(".S-right input:first-child").val();

                /*获取是否必须填写*/
                var is_must = tmp.find(".S-right>input[type=checkbox]");
                if(is_must.is(":checked")){
                    is_must = "1";
                }else{
                    is_must = "0"
                }

                if(type == 1 || type == 2){
                    /*获取option选项*/
                    var option = [];
                    var optionNum = tmp.find(".S-right>div input").length;
                    var j;
                    for(j=0; j<optionNum; j++){
                        var F = tmp.find(".S-right>div input:eq("+j+")").val();
                        option.push(F);
                    }
                    option = option.join("@");
                    var tempObj = new QuestionObj(Qid, type, content, option, is_must);
                    JsonObj.push(tempObj);
                }
                else{
                    var tempObj = new QuestionObj(Qid, type, content, "", is_must);
                    JsonObj.push(tempObj);
                }
            }
            JsonObj = JSON.stringify(JsonObj)
            $.ajax({
                type: "POST",
                url: URL,
                data : JsonObj,
                success: function(){
                    alert("您已成功保存");
                },
                error : function(data,data2,data3){
                    alert("您失败了" + data);
                }, beforeSend:function(){
                    alert("开始传输");
                }
            })
        })
    })
</script>

<!--Get操作-->
<script>
    var GETURL = "/index.php/Design/modify/survey_id/<?php echo ($survey_id); ?>";
    var addContent = function(index,data){
        var sin = $(".DynamicPart > div").eq(index);
        var t = sin.find("div.S-left>h2");
        var tmp = data[index];
        t.text("Q" + data[index].question_id);
        sin.find("div.S-right>input:first-child").val(tmp.question_content);
        if(tmp.is_must == 1){
            sin.find("div.S-right>input[type=checkbox]").attr("checked","checked");
        }
        if(tmp.question_type == 1 || tmp.question_type == 2){
            var Snum = data[index].option.length;
            var j;
            for(j = 0; j < Snum; j++){
                sin.find("div.S-right>div>input").eq(j).val(tmp.option[j].option_content);
            }
        }else if(tmp.question_type == 3){
            sin.find("div.S-right textarea").val(tmp.question_content);
        }else{
            alert("题目导入错误，请联系天外天后台君");
        }
    }

    $(function(){
        $(".DynamicPart").delegate(".dynamic input[type=checkbox]+img+img+label","click",function(){
            var tmp = $(this).parent().find("input[type=checkbox]");
            if(tmp.prop("checked")){
                tmp.removeAttr("checked");
            }else{
                tmp.prop("checked","checked");
            }
        })

        var Qid = null;
        var Qtitle = null;
        var Qdesc = null;

        $.ajax({
            url :GETURL,
            type:"GET",
            async:false,
            dataType: "json",
            success:function(data){
                Qid = data.survey_id;
                Qtitle = data.title
                Qdesc = data.description;
                var question = data.question;
                var i;
                for(i = 0; i < question.length; i++){
                    switch(question[i].question_type){
                        case "1":
                            createSingleQues();
                            break;
                        case "2":
                            createMutiQues();
                            break;
                        case "3":
                            createFillQues();
                            break;
                        default:
                            alert("题目导入错误，请联系天外天后台君");
                    }
                }
                setTimeout(function(){
                    for(i = 0; i < question.length; i++){
                        addContent(i,question);
                    }
                },600)
            },
            error:function(){alert("获取失败")}
            /*        , complete:function(data){
             var d = JSON.parse(data.responseText);

             }*/

        })

        $("#survey_id").val(Qid);
        if(!Qid){
            $("input.FirstInput").val("未命名");
        }
        $("input.FirstInput").val(Qtitle);
        $(".InputMiddle input").val(Qdesc);
    })
</script>




<!--隐藏的问卷ID位置-->
<input type="text" style="display: none" id="survey_id">

<form class="DesignContent">
    <div class="DesignTitle">
        <input class="FirstInput" type="text" placeholder="点击添加问卷标题" required>
        <br>
        <div class="InputMiddle">
            <input type="text" placeholder="欢迎参加本次答题，点击添加问卷介绍" required>
        </div>
    </div>

    <div class="DynamicPart">

    </div>

    <!--右侧导航栏-->
    <div class="rightPart">
        <div class="sideNavTop">
            <a><img src="/Public/img/back.png" width="48" height="48"></a>
        </div>
        <ul>
            <li><a><img src="/Public/img/DesignIcons/single.png">单项选择题</a></li>
            <li><a><img src="/Public/img/DesignIcons/Muti.png">多项选择题</a></li>
            <li><a><img src="/Public/img/DesignIcons/Mutiply.png">多行填空题</a></li>
            <li><a><img src="/Public/img/DesignIcons/downMenu.png">下拉选项题</a></li>
            <li><a><img src="/Public/img/Icons/export.png">附件上传题</a></li>
        </ul>
    </div>

    <div class="part">
        <h1>感谢您的配合</h1>
        <input type="checkbox" id="niming"><img src="/Public/img/Icons/rectNone.png" width="20" height="20"><img src="/Public/img/Icons/rectChoose.PNG" width="20" height="20"><label for="niming">允许匿名填写</label>
        <div class="btnArr">
            <a href="/index.php/myQuestionnaire/index"><input type="button" class="D-submit" value="保存"></a>
            <!--<input type="button" class="D-submit" value="预览">-->
            <!--<input type="button" class="D-submit" value="发布">-->
        </div>
    </div>
</form>


</body>
</html>