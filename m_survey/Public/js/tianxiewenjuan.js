$(document).ready(function () {
    var temp = $("#myQuestion").val();
    var shuzu = JSON.parse(temp);
    alert(shuzu);
    var Title = $("#myTitle").val();
    var Description = $("#myDescription").val();
    var Question_number = $("#myQuestion_numbe").val();
    var Question = shuzu;
    var Survey_Id = $("#myId").val();
    $("#showTitle").html(Title);
    $("#showDescription").html(Description);
    var tempQuestion = [];
    for (var i = 1; i <= Question.length; i++) {
        var me = Question[i];
        if (me["question_type"] == 1) {
            var block = $("<div></div>");
            block.addClass("danXuan");
            //
            tempQuestion.push(block);
            //
            var neiBuNum = $("<p></p>");
            neiBuNum.addClass("NeiBuNumber");
            var neiBuBiaoTi = $("<p></p>");
            neiBuBiaoTi.addClass("NeiBuBiaoTi");
            //
            neiBuBiaoTi.html(me["question_content"]);
            if (me["is_must"] == 1) {
                neiBuNum.html("*Q" + i + ".");
            } else {
                neiBuNum.html("Q" + i + ".");
            }

            //

            for (var k = 1; k <= me[xuanxiang].length; k++) {
                var temp = $("<input/>");
                temp.appendTo(block);
                temp.attr("type", "radio");
                temp.attr("name", me["question_content"]);
                temp.attr("value", me["xuanxiang"][k]);
                var lable = $("<p></p>");
                lable.html(me["xuanxiang"][k]);
                lable.after(temp);
            }
            block.appendTo($("#main"));
        } else if (me["question_type"] == 2) {

            var block = $("<div></div>");
            block.addClass("duoXuan");
            //
            tempQuestion.push(block);
            //
            var neiBuNum = $("<p></p>");
            neiBuNum.addClass("NeiBuNumber");
            var neiBuBiaoTi = $("<p></p>");
            neiBuBiaoTi.addClass("NeiBuBiaoTi");
            //
            neiBuBiaoTi.html(me["question_content"]);
            if (me["is_must"] == 1) {
                neiBuNum.html("*Q" + i + ".");
            } else {
                neiBuNum.html("Q" + i + ".");
            }
            //
            for (var k = 1; k <= me[xuanxiang].length; k++) {
                var temp = $("<input/>");
                temp.appendTo(block);
                temp.attr("type", "checkbox");
                temp.attr("name", me["question_content"] + k);
                temp.attr("value", me["xuanxiang"][k]);
                var lable = $("<p></p>");
                lable.html(me["xuanxiang"][k]);
                lable.after(temp);
            }
            block.appendTo($("#main"));
        } else if (me["question_type"] == 3) {
            var block = $("<div></div>");
            block.addClass("duoHang");
            //
            tempQuestion.push(block);
            //
            var neiBuNum = $("<p></p>");
            neiBuNum.addClass("NeiBuNumber");
            var neiBuBiaoTi = $("<p></p>");
            neiBuBiaoTi.addClass("NeiBuBiaoTi");

            neiBuBiaoTi.html(me["question_content"]);
            if (me["is_must"] == 1) {
                neiBuNum.html("*Q" + i + ".");
            } else {
                neiBuNum.html("Q" + i + ".");
            }
            //
            var temp = $("<textarea></textarea>").appendTo(block);
            block.appendTo($("#main"));
        }
    }
    var postString;
    $("#submitButton").click(function () {

        for (var i = 0; i < tempQuestion.length; i++) {
            var temp = tempQuestion[i];
            if (temp.attr("class") == "danXuan") {
                var all = temp.find("input");
                all.each(function () {
                    if ($(this).is(':checked') == true) {
                        postString = postString + "@" + $(this).val();
                    }
                });
            } else if (temp.attr("class") == "duoXuan") {
                var all = temp.find("input");
                all.each(function () {

                    if ($(this).is(':checked') == true) {
                        var tempString;
                        tempString = tempString + "|" + $(this).val();
                        postString = postString + "@" + tempString;
                    }
                });
            } else if (temp.attr("class") == "duoHang") {
                postString = postString + $(this).find("textarea").val();
            }
        }
        $("#submitButton").bind(function () {
            var cont = {
                content: postString,
                survey_id: Survey_Id,
            };
            $.post("aaa.php", cont, function (data) {
                alert("您已经成功提交问卷。");
            });
        });

    });

});
