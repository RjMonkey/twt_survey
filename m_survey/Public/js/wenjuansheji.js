window.onload = function(){
    $("#tempedit").hide();



    $("#isSave").val("false");
    $("#zheZhao").hide();
    $("#sureToExit").hide();
    $("#sureToPublish").hide();
    $("#canvas").hide();
    //biaoti
    var biaoTiQu = $("<div></div>").prependTo($("form"));
    biaoTiQu.addClass("biaoTiClass");
    var work = $("<div></div>").appendTo(biaoTiQu);
    work.addClass("workClass");
    var biaoTiShow = $("<p>点击添加标题</p>").appendTo(work);
    var biaoTi = $("<input/>").appendTo(work);
    biaoTi.attr("type","text");
    var theBiaoTi = biaoTi.val();
    biaoTi.attr("name", "biaoti");
    var leftTag = $("<div></div>").appendTo(biaoTiQu);
    var rightTag = $("<div></div>").appendTo(biaoTiQu);
    leftTag.addClass("leftTag");
    var descriptShow = $("<p>点击此处添加问卷描述</p>").appendTo(rightTag);
    var descriptInput = $("<input/>").appendTo(rightTag);
    descriptInput.addClass("descriptInput");
    descriptShow.addClass("descriptShow");
    descriptInput.hide();
    descriptShow.show();
    descriptShow.click(function () {
        descriptShow.hide();
        descriptInput.show();
        descriptInput.focus();
    });
    descriptInput.blur(function () {
        descriptShow.html(descriptInput.val());
        if (descriptInput.val() == "") {
            descriptShow.html("点击此处添加问卷描述");
        }
        descriptShow.show();
        descriptInput.hide();
    });
    //
    rightTag.addClass("rightTag");
    biaoTiShow.show();
    biaoTi.hide();
    work.click(function () {
        biaoTiShow.hide();
        biaoTi.show();
        biaoTi.focus();
    });
    biaoTi.blur(function () {
        biaoTiShow.html(biaoTi.val());
        if (biaoTi.val() == "") {
            biaoTiShow.html("点击添加标题");
        }
        biaoTiShow.show();
        biaoTi.hide();
    });
    //danxiang
    /*$("#danXiangButton").click(function () {
        var ground = $("<div></div>").appendTo($("form"));
        var smallbar = $("<div></div>").appendTo(ground);
        var main = $("<div></div>").appendTo(ground);
        var tag = $("<div></div>").appendTo(main);
        var tagShow = $("<p>单选题</p>").appendTo(tag);
        var tagInput = $("<input/>").appendTo(tag);
        tagInput.attr("type","text");
        tagInput.attr("style","display: block;");
        var addButton = $("<button><button/>").appendTo(main);
        var requiredBox = $("<input/>").appendTo(main);
        ground.css("")
        requiredBox.attr("type","checkbox");
        requiredBox.text = "必填";
        //tag change
        tagShow.show();
        tagInput.hide();
        tag.click(function () {
            tagInput.show();
            tagShow.hide();
            tagInput.focus();
        });
        tagInput.blur(function () {
            tagShow.html(tagInput.val());
            if (tagInput.val() == "") {
                tagShow.html("单选题");
            }
            tagShow.show();
            tagInput.hide();
        });
        //end tag
*/
    $(".neiBuBiaoTi p").show();
    $(".neiBuBiaoTi input").hide();
    //
    $(".neiBuBiaoTi p").show();
    $(".neiBuBiaoTi input").hide();
    //
    $(".neiBuBiaoTi p").show();
    $(".neiBuBiaoTi input").hide();
    //测试使用
    /*$(".duoXuan").hide();
    $(".duoHang").hide();*/
    //end
    var theQuestion = new Array();
    var xuanXiangNum = new Array();
    var index = 0;
    /*var xuanXiangIndex = 0;*/
    $("#ordinaryDanXuan").hide();
    $("#danXiangButton").bind("click",function () {
        index++;
        //
        /*xuanXiangIndex++;
        xuanXiangNum[xuanXiangNum] = 0;*/
        //
        var myIndex = index;
        theQuestion[index] = $("#ordinaryDanXuan").clone(true,true);
        xuanXiangNum[$(this).parents(".danXuan")] = 0;
        var me = theQuestion[myIndex];
        me.find(".numOfXuanXiang").hide();

        //改变Q的值
        theQuestion[myIndex].find(".smallBar").find("p").html("Q"+myIndex);
        //end 改变Q的值
        //下面为标题添加事件
        var titleShow = theQuestion[myIndex].find(".neiBuBiaoTi").find("p");
        var titleInput = theQuestion[myIndex].find(".neiBuBiaoTi").find("input");
        titleShow.show();
        titleInput.hide();
        titleShow.bind("click", function () {
            titleShow.hide();
            titleInput.show();
            titleInput.focus();
        });
        //下面这一段还要为内部的每个选项改NAME添加解决方案
        titleInput.bind("blur", function () {
            titleShow.html(titleInput.val());
            me.find(".mainBoard").find("input").attr("name",titleInput.val());

            if (titleInput.val() == ""){
                titleShow.html("单选题");
                me.find(".mainBoard").find("input").attr("name","单选题");
            }
            titleShow.show();
            titleInput.hide();
        });
        //标题事件添加完毕

        //下面是改变工具栏的显示和出现

        /*me.click("click", function () {
         var danJiCiShu = parseInt($(this).find("span").html());
         //alert($(this).find("span").html());
         if (danJiCiShu % 2 == 1) {

         $(this).find(".smallBar").find("button").show();
         $(this).find(".downBoard").find("button").show();
         danJiCiShu++;
         $(this).find("span").html(danJiCiShu);
         }else {

         $(this).find(".smallBar").find("button").hide();
         $(this).find(".downBoard").find("button").hide();
         $(this).find("span").html(danJiCiShu);
         }
         });*/
        /*var nowId = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        var innerTemp = $(".danXuan");
        */

        // end 下面是改变工具栏的显示和出现
        //下面为各个选项的添加和改名添加事件
        me.hover(function () {
            me.find(".smallBar").find("button").show();
            me.find(".downBoard").find("button").show();
        },function () {
            me.find(".smallBar").find("button").hide();
            me.find(".downBoard").find("button").hide();
        });

        me.find(".downBoard").find("button").bind("click",function () {
            var myNum = parseInt(me.find(".numOfXuanXiang").html());
            myNum++;
            me.find(".numOfXuanXiang").html(myNum);
            myNum = parseInt(myNum);
            var myRadio = $("<input/>").appendTo($(this).parents(".danXuan").find(".mainBoard"));
            myRadio.attr("type","radio");
            myRadio.attr("name",$(this).parents(".danXuan").find(".neiBuBiaoTi").find("p").html());
            myRadio.attr("value",myNum);
            var myLabel = $("<label></label>");
            myLabel.html("选项" + myNum);
            myRadio.after(myLabel);
            var myInput = $("<input/>");
            myInput.attr("type", "text");
            myLabel.after(myInput);
            myInput.after($("<br/>"));
            //下面是为多选项后超出格子范围添加解决方案
            //下面为label添加改名函数
            myLabel.show();
            myInput.hide();
            myLabel.bind("click", function () {
                myLabel.hide();
                myInput.show();
                myInput.focus();
            });
            myInput.bind("blur",function () {
                myLabel.html(myInput.val());
                if (myInput.val() == ""){
                    myLabel.html("选项" + myNum);
                }
                myLabel.show();
                myInput.hide();
            });
        });
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        //end下面为各个选项的添加和改名添加事件
        $(".foot").before(theQuestion[myIndex]);
        theQuestion[myIndex].show();
        $("span").hide();
        me.find(".smallBar").find("button").hide();
        me.find(".downBoard").find("button").hide();
    });

    var tempIndex;
    var tempIndex2;
    var temp;
    var temp2;
    $(".danXuan").find(".smallBar").find(".delete").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        theQuestion[tempIndex].remove();
        for (var i = tempIndex; i < index;i++){
            theQuestion[i] = theQuestion[i + 1];
            theQuestion[i].find(".smallBar").find("p").html("Q"+i);
        }
        index--;
    });



    $(".danXuan").find(".smallBar").find(".up").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex > 1) {
            tempIndex2 = tempIndex -1;
            temp = theQuestion[tempIndex - 1];
            theQuestion[tempIndex - 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex].before(theQuestion[tempIndex - 1]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex - 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });

    $(".danXuan").find(".smallBar").find(".down").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex < index) {
            tempIndex2 = tempIndex +1;
            temp = theQuestion[tempIndex + 1];
            theQuestion[tempIndex + 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex + 1].before(theQuestion[tempIndex]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex + 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });

    //下面是处理多选的一系列解决方案
    $("#ordinaryDuoXuan").hide();
    $("#duoXiangButton").bind("click",function () {
        index++;
        //
        /*xuanXiangIndex++;
         xuanXiangNum[xuanXiangNum] = 0;*/
        //
        var myIndex = index;
        theQuestion[index] = $("#ordinaryDuoXuan").clone(true,true);
        //xuanXiangNum[$(this).parents(".duoXuan")] = 0;
        var me = theQuestion[myIndex];
        me.find(".numOfXuanXiang").hide();
        //改变Q的值
        theQuestion[myIndex].find(".smallBar").find("p").html("Q"+myIndex);
        //end 改变Q的值
        //下面为标题添加事件
        var titleShow = theQuestion[myIndex].find(".neiBuBiaoTi").find("p");
        var titleInput = theQuestion[myIndex].find(".neiBuBiaoTi").find("input");
        titleShow.show();
        titleInput.hide();
        titleShow.bind("click", function () {
            titleShow.hide();
            titleInput.show();
            titleInput.focus();
        });
        //下面这一段还要为内部的每个选项改NAME添加解决方案
        titleInput.bind("blur", function () {
            titleShow.html(titleInput.val());
            me.find(".mainBoard").find("input").attr("name",titleInput.val());

            if (titleInput.val() == ""){
                titleShow.html("多选题");
                me.find(".mainBoard").find("input").attr("name","多选题");
            }
            titleShow.show();
            titleInput.hide();
        });
        //标题事件添加完毕
        //下面为各个选项的添加和改名添加事件
        me.hover(function () {
            me.find(".smallBar").find("button").show();
            me.find(".downBoard").find("button").show();
        },function () {
            me.find(".smallBar").find("button").hide();
            me.find(".downBoard").find("button").hide();
        });

        me.find(".downBoard").find("button").bind("click",function () {
            var myNum = parseInt(me.find(".numOfXuanXiang").html());
            myNum++;
            me.find(".numOfXuanXiang").html(myNum);
            myNum = parseInt(myNum);
            var myRadio = $("<input/>").appendTo($(this).parents(".duoXuan").find(".mainBoard"));
            myRadio.attr("type","checkbox");
            myRadio.attr("name",$(this).parents(".danXuan").find(".neiBuBiaoTi").find("p").html());
            myRadio.attr("value",myNum);
            var myLabel = $("<label></label>");
            myLabel.html("选项" + myNum);
            myRadio.after(myLabel);
            var myInput = $("<input/>");
            myInput.attr("type", "text");
            myLabel.after(myInput);
            myInput.after($("<br/>"));
            //下面是为多选项后超出格子范围添加解决方案
            //下面为label添加改名函数
            myLabel.show();
            myInput.hide();
            myLabel.bind("click", function () {
                myLabel.hide();
                myInput.show();
                myInput.focus();
            });
            myInput.bind("blur",function () {
                myLabel.html(myInput.val());
                if (myInput.val() == ""){
                    myLabel.html("选项" + myNum);
                }
                myLabel.show();
                myInput.hide();
            });
        });
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        //end下面为各个选项的添加和改名添加事件
        $(".foot").before(theQuestion[myIndex]);
        theQuestion[myIndex].show();

        me.find(".smallBar").find("button").show();
        me.find(".downBoard").find("button").show();

    });
    $(".duoXuan").find(".smallBar").find(".delete").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        theQuestion[tempIndex].remove();
        for (var i = tempIndex; i < index;i++){
            theQuestion[i] = theQuestion[i + 1];
            theQuestion[i].find(".smallBar").find("p").html("Q"+i);
        }
        index--;
    });



    $(".duoXuan").find(".smallBar").find(".up").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex > 1) {
            tempIndex2 = tempIndex -1;
            temp = theQuestion[tempIndex - 1];
            theQuestion[tempIndex - 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex].before(theQuestion[tempIndex - 1]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex - 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });

    $(".duoXuan").find(".smallBar").find(".down").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex < index) {
            tempIndex2 = tempIndex +1;
            temp = theQuestion[tempIndex + 1];
            theQuestion[tempIndex + 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex + 1].before(theQuestion[tempIndex]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex + 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });

    //下面是为多行添加解决方案
    $("#ordinaryDuoHang").hide();
    $("#duoHangButton").bind("click",function () {
        index++;
        //
        /*xuanXiangIndex++;
         xuanXiangNum[xuanXiangNum] = 0;*/
        //
        var myIndex = index;
        theQuestion[index] = $("#ordinaryDuoHang").clone(true,true);
        //xuanXiangNum[$(this).parents(".duoXuan")] = 0;
        var me = theQuestion[myIndex];
        //me.find(".numOfXuanXiang").hide();
        //改变Q的值
        theQuestion[myIndex].find(".smallBar").find("p").html("Q"+myIndex);
        //end 改变Q的值
        //下面为标题添加事件
        var titleShow = theQuestion[myIndex].find(".neiBuBiaoTi").find("p");
        var titleInput = theQuestion[myIndex].find(".neiBuBiaoTi").find("input");
        titleShow.show();
        titleInput.hide();
        titleShow.bind("click", function () {
            titleShow.hide();
            titleInput.show();
            titleInput.focus();
        });
        //下面这一段还要为内部的每个选项改NAME添加解决方案
        titleInput.bind("blur", function () {
            titleShow.html(titleInput.val());
            me.find(".mainBoard").find("textarea").attr("name",titleInput.val());

            if (titleInput.val() == ""){
                titleShow.html("多选题");
                me.find(".mainBoard").find("textarea").attr("name","多行题");
            }
            titleShow.show();
            titleInput.hide();
        });
        me.hover(function () {
            me.find(".smallBar").find("button").show();
            //me.find(".downBoard").find("button").show();
        },function () {
            me.find(".smallBar").find("button").hide();
            //me.find(".downBoard").find("button").hide();
        });
        //标题事件添加完毕
        //下面为各个选项的添加和改名添加事件

        /*me.find(".downBoard").find("button").bind("click",function () {
            var myNum = parseInt(me.find(".numOfXuanXiang").html());
            myNum++;
            me.find(".numOfXuanXiang").html(myNum);
            myNum = parseInt(myNum);
            var myRadio = $("<input/>").appendTo($(this).parents(".duoXuan").find(".mainBoard"));
            myRadio.attr("type","checkbox");
            myRadio.attr("name",$(this).parents(".danXuan").find(".neiBuBiaoTi").find("p").html());
            myRadio.attr("value",myNum);
            var myLabel = $("<label></label>");
            myLabel.html("选项" + myNum);
            myRadio.after(myLabel);
            var myInput = $("<input/>");
            myLabel.after(myInput);
            myInput.after($("<br/>"));
            //下面是为多选项后超出格子范围添加解决方案
            //下面为label添加改名函数
            myLabel.show();
            myInput.hide();
            myLabel.bind("click", function () {
                myLabel.hide();
                myInput.show();
                myInput.focus();
            });
            myInput.bind("blur",function () {
                myLabel.html(myInput.val());
                if (myInput.val() == ""){
                    myLabel.html("选项" + myNum);
                }
                myLabel.show();
                myInput.hide();
            });
        });*/
        /*me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();*/
        //end下面为各个选项的添加和改名添加事件
        $(".foot").before(theQuestion[myIndex]);
        me.find(".smallBar").find("button").show();
        theQuestion[myIndex].show();

    });
    $(".duoHang").find(".smallBar").find(".delete").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        theQuestion[tempIndex].remove();
        for (var i = tempIndex; i < index;i++){
            theQuestion[i] = theQuestion[i + 1];
            theQuestion[i].find(".smallBar").find("p").html("Q"+i);
        }
        index--;
    });



    $(".duoHang").find(".smallBar").find(".up").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex > 1) {
            tempIndex2 = tempIndex -1;
            temp = theQuestion[tempIndex - 1];
            theQuestion[tempIndex - 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex].before(theQuestion[tempIndex - 1]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex - 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });

    $(".duoHang").find(".smallBar").find(".down").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex < index) {
            tempIndex2 = tempIndex +1;
            temp = theQuestion[tempIndex + 1];
            theQuestion[tempIndex + 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex + 1].before(theQuestion[tempIndex]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex + 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });
    //518-650


     /*titleShow.show();
            titleInput.hide();
        });$("#ordinaryXiaLa").hide();
        $("#xiaLaButton").bind("click",function () {
            index++;
            //
            /!*xuanXiangIndex++;
             xuanXiangNum[xuanXiangNum] = 0;*!/
            //
            var myIndex = index;
            theQuestion[index] = $("#ordinaryXiaLa").clone(true,true);
            //xuanXiangNum[$(this).parents(".duoXuan")] = 0;
            var me = theQuestion[myIndex];
            me.find(".numOfXuanXiang").hide();
            //改变Q的值
            theQuestion[myIndex].find(".smallBar").find("p").html("Q"+myIndex);
            //end 改变Q的值
            //下面为标题添加事件
            var titleShow = theQuestion[myIndex].find(".neiBuBiaoTi").find("p");
            var titleInput = theQuestion[myIndex].find(".neiBuBiaoTi").find("input");
            titleShow.show();
            titleInput.hide();
            titleShow.bind("click", function () {
                titleShow.hide();
                titleInput.show();
                titleInput.focus();
            });
            //下面这一段还要为内部的每个选项改NAME添加解决方案
            titleInput.bind("blur", function () {
                titleShow.html(titleInput.val());
                me.find(".mainBoard").find("input").attr("name",titleInput.val());

                if (titleInput.val() == ""){
                    titleShow.html("多选题");
                    me.find(".mainBoard").find("input").attr("name","多选题");
                }

                //标题事件添加完毕
        //下面为各个选项的添加和改名添加事件
        me.hover(function () {
            me.find(".smallBar").find("button").show();
            me.find(".downBoard").find("button").show();
        },function () {
            me.find(".smallBar").find("button").hide();
            me.find(".downBoard").find("button").hide();
        });

        me.find(".downBoard").find("button").bind("click",function () {
            var myNum = parseInt(me.find(".numOfXuanXiang").html());
            myNum++;
            me.find(".numOfXuanXiang").html(myNum);
            myNum = parseInt(myNum);
            var myRadio = $("<option></option>").appendTo($(this).parents(".xiaLa").find(".mainBoard").find("select"));
           /!* myRadio.attr("type","checkbox");*!/
            myRadio.attr("value",$(this).parents(".xiaLa").find(".neiBuBiaoTi").find("p").html());
            /!*myRadio.attr("value",myNum);*!/
            var myLabel = $("<p></p>").appendTo(myRadio);
            myLabel.html("选项" + myNum);
           /!* myRadio.after(myLabel);*!/
            var myInput = $("<input/>");
            myInput.attr("type", "text");
            myInput.after(myLabel);
            //下面是为多选项后超出格子范围添加解决方案
            //下面为label添加改名函数
            myLabel.show();
            myInput.hide();
            myLabel.bind("click", function () {
                myLabel.hide();
                myInput.show();
                myInput.focus();
            });
            myInput.bind("blur",function () {
                myLabel.html(myInput.val());
                if (myInput.val() == ""){
                    myLabel.html("选项" + myNum);
                }
                myLabel.show();
                myInput.hide();
            });
        });
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        me.find(".downBoard").find("button").click();
        //end下面为各个选项的添加和改名添加事件
        $(".foot").before(theQuestion[myIndex]);
        theQuestion[myIndex].show();

        me.find(".smallBar").find("button").show();
        me.find(".downBoard").find("button").show();

    });
    $(".duoXuan").find(".smallBar").find(".delete").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        theQuestion[tempIndex].remove();
        for (var i = tempIndex; i < index;i++){
            theQuestion[i] = theQuestion[i + 1];
            theQuestion[i].find(".smallBar").find("p").html("Q"+i);
        }
        index--;
    });



    $(".duoXuan").find(".smallBar").find(".up").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex > 1) {
            tempIndex2 = tempIndex -1;
            temp = theQuestion[tempIndex - 1];
            theQuestion[tempIndex - 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex].before(theQuestion[tempIndex - 1]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex - 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });

    $(".duoXuan").find(".smallBar").find(".down").bind("click", function () {
        tempIndex = parseInt($(this).parents(".smallBar").find("p").html().substr(1));
        if (tempIndex < index) {
            tempIndex2 = tempIndex +1;
            temp = theQuestion[tempIndex + 1];
            theQuestion[tempIndex + 1] = theQuestion[tempIndex];
            theQuestion[tempIndex] = temp;
            theQuestion[tempIndex + 1].before(theQuestion[tempIndex]);
            theQuestion[tempIndex].find(".smallBar").find("p").html("Q"+tempIndex);
            theQuestion[tempIndex + 1].find(".smallBar").find("p").html("Q"+tempIndex2);
        }
    });
*/




    //
    //下面是全局处理函数
    /*var onLoad = new Array();*/
    /*for (var i = 0; i < 100; i++) {
        onLoad[i] = new Array();
    }*/
    /*$("#save").bind("click", function () {
        for (var i = 1; i <= index; i++) {
            onLoad[i] = new Array();
            var me = theQuestion[i];
            if (me.attr("class") == "danXuan") {
                onLoad[i][1] = 1;
                var numOfXuanXiang = parseInt(me.find(".numOfXuanXiang").html());
                var postString = "";
                me.find(".mainBoard").find("input").each(function () {
                    if ($(this).attr("type") == "text") {
                        postString = postString + $(this).val().toString() + "`";
                    }
                });
                postString = postString.substring(0,postString.length -1);
                onLoad[i][2] = postString;
                /!*alert(onLoad[i][2]);*!/
            }else if (me.attr("class") == "duoXuan") {
                onLoad[i][1] = 2;
                var numOfXuanXiang = parseInt(me.find(".numOfXuanXiang").html());
                var postString = "";
                me.find(".mainBoard").find("input").each(function () {
                    if ($(this).attr("type") == "text") {
                        postString = postString + $(this).val().toString() + "`";
                    }
                });
                postString = postString.substring(0,postString.length -1);
                onLoad[i][2] = postString;
                /!*alert(onLoad[i][2]);*!/
            }
        }
    });*/
    /*$("#preload").bind("click", function () {
        alert("he");
        for (var i = 1; i <= index;i++) {
            var addTo = $("#myHtml");
            var me = theQuestion[i];
            if (me.attr("class") == "danXuan") {
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][1]";
                temp.attr("name",theName);
                temp.value = 1;
                //
                temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                theName = "arr[" + i + "][2]";
                temp.attr("name",theName);
                var postString = "";
                me.find(".mainBoard").find("input").each(function () {
                    if ($(this).attr("type") == "text") {
                        postString = postString + $(this).val().toString() + "`";
                    }
                });
                postString = postString.substring(0,postString.length -1);
                temp.value = postString;
            }
        }
    });*/
    $("#save").bind("click",function () {
        //
        if(biaoTi.val() == "") {
            alert("请为问卷添加一个标题。");
            return false;
        }
        // //
        // for (var i = 1; i <= index ; i++) {
        //     me = theQuestion[i].find("input");
        //     if ((me.attr("type") == "text") && (me.val() == "")) {
        //         alert("你还没有完成问卷设计。");
        //         return false;
        //     }
        // }
        var addTo = $("<div></div>");
        var myForm = $("<form></form>").appendTo($(".foot"));
        myForm.attr("method","post");
        myForm.attr("action","/index.php/Design/save");//把这个php改成你的
        myForm.attr("enctype","multipart/form-data");
        //
        // var img=new Image();
        // img.src=$("#thepicture").val();
        // alert(img.fileSize);
        // if (img.fileSize>1*1024) alert("sdfasf");
        //
        var mytemp = $("#thepicture").val();
        if (mytemp != "") {
            var me = document.getElementById("thepicture").files[0].size;
            //alert(me);
            if (me > 1024*1536) {
                alert("您上传的封面图片大小超过了1.5M，请重新上传.");
                return false;
            }

            $("#is_upload").val(1);
        } else {
            $("#is_upload").val(0);
        }
        $("#is_upload").appendTo(myForm);
        //alert($("#is_upload").val());
        $("#thepicture").appendTo(myForm);

        //alert(myForm.find("#thepicture").val());
        var myTitle = $("<input/>");
        myTitle.attr("type","hidden");
        myTitle.attr("name","title");
        myTitle.attr("value", biaoTi.val());
        myTitle.appendTo(myForm);
        //
        var mydescription = $("<input/>");
        mydescription.attr("type","hidden");
        mydescription.attr("name","description");
        mydescription.attr("value",descriptInput.val());
        mydescription.appendTo(myForm);
        //
        var queNum = $("<input/>");
        queNum.attr("type","hidden");
        queNum.attr("name","question_number");
        queNum.attr("value",index);
        queNum.appendTo(myForm);
        //
        for (var i = 1; i <= index;i++) {
            var me = theQuestion[i];
            if (me.attr("class") == "danXuan") {
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][0]";
                temp.attr("name",theName);
                temp.attr("value",1);
                //
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][1]";
                temp.attr("name",theName);
                var theValue = me.find(".neiBuBiaoTi").find("input").val();
                temp.attr("value",theValue);
                //
                temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                theName = "arr[" + i + "][2]";
                temp.attr("name",theName);
                var postString = "@";
                me.find(".mainBoard").find("input").each(function () {
                    if ($(this).attr("type") == "text") {
                        postString = postString + $(this).val().toString() + "@";
                    }
                });
                postString = postString.substring(0,postString.length -1);
                temp.attr("value",postString);


                //
                temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                theName = "arr[" + i + "][3]";
                temp.attr("name",theName);
                var postString;
                if (me.find(".downBoard").find("input").is(':checked') == true) {
                    postString = 1;
                }else {
                    postString = 0;
                }

                temp.attr("value",postString);
                //


            } else if (me.attr("class") == "duoXuan") {
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][0]";
                temp.attr("name",theName);
                temp.attr("value",2);
                //
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][1]";
                temp.attr("name",theName);
                var theValue = me.find(".neiBuBiaoTi").find("input").val();
                temp.attr("value",theValue);
                //
                temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                theName = "arr[" + i + "][2]";
                temp.attr("name",theName);
                var postString = "@";
                me.find(".mainBoard").find("input").each(function () {
                    if ($(this).attr("type") == "text") {
                        postString = postString + $(this).val().toString() + "@";
                    }
                });
                postString = postString.substring(0,postString.length -1);
                temp.attr("value",postString);

                //
                temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                theName = "arr[" + i + "][3]";
                temp.attr("name",theName);
                var postString;
                if (me.find(".downBoard").find("input").is(':checked') == true) {
                    postString = 1;
                }else {
                    postString = 0;
                }

                temp.attr("value",postString);
                //


            } else if (me.attr("class") == "duoHang") {
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][0]";
                temp.attr("name",theName);
                temp.attr("value",3);
                //
                var temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                var theName = "arr[" + i + "][1]";
                temp.attr("name",theName);
                var theValue = me.find(".neiBuBiaoTi").find("input").val();
                temp.attr("value",theValue);

                //
                temp = $("<input/>").appendTo(addTo);
                temp.attr("type","hidden");
                theName = "arr[" + i + "][3]";
                temp.attr("name",theName);
                var postString;
                if (me.find(".downBoard").find("input").is(':checked') == true) {
                    postString = 1;
                }else {
                    postString = 0;
                }

                temp.attr("value",postString);
                //
            }
        }
        $("#isSave").val("true");
        addTo.appendTo(myForm);
        var id = $("<input/>").appendTo(myForm);
        id.attr("name","survey_id");
        id.hide();
        id.val($("#myId").val());
        //alert(id.val());
        //var picture = $(".thepicture").clone(true,true);
        //picture.appendTo(myForm);
        //var isreedit = $("<input/>").appendTo(myForm);
        //isreedit.hide();
        //isreedit.val($("#isreedit").val());

        myForm.submit();
        //$.post("/wenjuan/index.php/Design/save",myForm,function (data) {
        //    $("#myId").val(data.replace(/[^0-9]/ig,""));
        //    alert("您已经成功保存问卷");
        //});

    });
    // $("#preload").bind("click", function () {
    //     if ($("#isSave").val() == "true") {
    //
    //     }else {
    //         alert("请先保存问卷。");
    //     }
    // });
    //
    $("#inLeave1").bind("click", function () {
        $("#zheZhao").fadeOut();
        $("#sureToExit").fadeOut();
    });
    $("#inExit").bind("click", function() {
        $("#inLeave1").click();
    });
    //
    $("#inSave").bind("click", function () {
        $("#save").click();
        $("#inLeave1").click();
    });
    //
    $("#exitButton").bind("click",function () {
        if ($("#isSave").val() == "true") {
            //登出事件1
        }else {
            $("#zheZhao").fadeIn();
            $("#sureToExit").fadeIn();
        }
    });
    //
    $("#inLeave2, #inExit2").bind("click", function () {
        $("#zheZhao").fadeOut();
        $("#sureToPublish").fadeOut();
    });
    //
    $("#publish").bind("click", function () {
        if ($("#isSave").val() == "true") {
            $("#zheZhao").fadeIn();
            $("#sureToPublish").fadeIn();
        }else {
            alert("请先保存问卷。");
        }
    });
    $("#preload").bind("click", function () {
      if((biaoTi.val() == "") || (descriptInput.val() == "") || (index == 0)) {
          alert("你还没有完成问卷设计。");
          return false;
      }
      //
      for (var i = 1; i <= index ; i++) {
          me = theQuestion[i].find("input");
          if ((me.attr("type") == "text") && (me.val() == "")) {
              alert("你还没有完成问卷设计。");
              return false;
          }
      }
        var me = $("#canvas");
        me.html("");
        var title = $("<p></p>").appendTo(me);
        title.addClass("canvaBiaoTi");
        title.html(biaoTi.val());
        var smallTalk = $("<p></p>").appendTo(me);
        smallTalk.html("*为必答题。");
        smallTalk.addClass("canvaSmallTalk");
        var description2 = $("<p></p>").appendTo(me);
        description2.addClass("canvaDescription");
        description2.html(descriptInput.val());
        for (var i = 1; i <= index; i++) {
            var x = theQuestion[i];
            //
            var block = $("<div></div>").appendTo(me);
            block.addClass("canvaBlock");
            var blockNum = $("<p></p>").appendTo(block);
            blockNum.html("Q" + i + ".");
            if (x.find(".downBoard").find("input").is(':checked') == true) {
                blockNum.html("*" + blockNum.html());
            }
            blockNum.addClass("canvaBlockNum");
            var blockBiaoTi = $("<p></p>").appendTo(block);
            blockBiaoTi.html(x.find(".neiBuBiaoTi").find("input").val());
            blockBiaoTi.addClass("canvaBlockBiaoTi");
            var blockMain = $("<div></div>").appendTo(block);
            blockMain.html(x.find(".mainBoard").html());
            blockMain.addClass("canvaBlockMain");
            me.css("height", 1.5*window.screen.height);
        }
        //css
        var exitButton = $("<input/>").appendTo(me);
        exitButton.attr("type","button");
        exitButton.val("提交");
        exitButton.addClass("canvaButton");
        exitButton.bind("click", function () {
          me.fadeOut();
        });
        me.fadeIn();

    });
    var i = 0;
    if($("#isreedit").val() == 1){

        //下面是田间问卷的标题和描述
        $(".workClass").find("p").click();
        $(".workClass").find("input").val($("#showTitle").html());
        //$("body").click();

        $(".rightTag").find("p").click();
        $(".rightTag").find("input").val($("#showDescription").html());
        //$("body").click();

        $.each($(".block"), function () {
            var tempBlock = $(this);
            //alert("efef");
            i++;
            //下面判断问题类型
            if($(this).find("input").attr("type") == "radio") {

                //下面模拟每个单选的点击事件
                //alert("efef");
                var k = 0;//k shi dan xuan de xia biao
                $("#danXiangButton").click();
                var theQuestionNow = theQuestion[i];


                theQuestionNow.find(".neiBuBiaoTi").find("p").click();
                theQuestionNow.find(".neiBuBiaoTi").find("input").val($(this).find(".title").html());
                $("body").click();


                $.each($(this).find("input"), function () {
                    //alert("asdfas");
                    k++;
                    if (k > 3) {
                        theQuestionNow.find(".downBoard").find("button").click();
                    }
                    //theQuestionNow.find(".downBoard").find("button").click();
                    //alert("asdfas");

                });
                k = 0;
                $.each($(this).find("input"), function () {
                    var temp = $(this);
                    //alert("adf");
                    k++;
                    var i = 0;
                    $.each(theQuestionNow.find(".mainBoard").find("input"), function () {
                        i++;

                        if (i == k * 2) {
                            $(this).prev().click();
                            $(this).val(temp.next().html());
                            $("body").click();
                            //alert(temp.next().html());
                            //$(this).click();
                            //$(this).val(temp.next().html());
                        }
                    });
                    //if (theQuestionNow.find(".mainBoard").find("input").attr("type") == "radio" && theQuestionNow.find(".mainBoard").find("input").attr("value") == k) {
                    //    alert("adfasf");
                    //    //theQuestionNow.find(".mainBoard").find("input").click();
                    //    //theQuestionNow.find(".mainBoard").find("input").next("input").val(tempBlock.find(""));
                    //    //$("body").click();
                    //}
                });
            } else if ($(this).find("input").attr("type") == "checkbox") {
                //下面模拟每个单选的点击事件
                //alert("efef");
                var k = 0;//k shi dan xuan de xia biao
                $("#duoXiangButton").click();
                var theQuestionNow = theQuestion[i];


                theQuestionNow.find(".neiBuBiaoTi").find("p").click();
                theQuestionNow.find(".neiBuBiaoTi").find("input").val($(this).find(".title").html());
                $("body").click();


                $.each($(this).find("input"), function () {
                    //alert("asdfas");
                    k++;
                    if (k > 3) {
                        theQuestionNow.find(".downBoard").find("button").click();
                    }
                    //theQuestionNow.find(".downBoard").find("button").click();
                    //alert("asdfas");

                });
                k = 0;
                $.each($(this).find("input"), function () {
                    var temp = $(this);
                    //alert("adf");
                    k++;
                    var i = 0;
                    $.each(theQuestionNow.find(".mainBoard").find("input"), function () {
                        i++;

                        if (i == k * 2) {
                            $(this).prev().click();
                            $(this).val(temp.next().html());
                            $("body").click();
                            //alert(temp.next().html());
                            //$(this).click();
                            //$(this).val(temp.next().html());
                        }
                    });
                    //if (theQuestionNow.find(".mainBoard").find("input").attr("type") == "radio" && theQuestionNow.find(".mainBoard").find("input").attr("value") == k) {
                    //    alert("adfasf");
                    //    //theQuestionNow.find(".mainBoard").find("input").click();
                    //    //theQuestionNow.find(".mainBoard").find("input").next("input").val(tempBlock.find(""));
                    //    //$("body").click();
                    //}
                });
            } else {
                var k = 0;//k shi dan xuan de xia biao
                $("#duoHangButton").click();
                var theQuestionNow = theQuestion[i];


                theQuestionNow.find(".neiBuBiaoTi").find("p").click();
                theQuestionNow.find(".neiBuBiaoTi").find("input").val($(this).find(".title").html());
                $("body").click();
            }
            if ($(this).find(".must").html() == "*Q") {
                theQuestion[i].find(".downBoard").find("input").attr("checked",true);
            }
        });
    }
    $("#inSure").click(function () {
        $("#save").click();
        alert("/index.php/Design/fabu?survey_id=" + $("#myId").val());
        window.location.href = "/index.php/Design/fabu?survey_id=" + $("#myId").val();
    });

}
