$(document).ready(function () {
    var danXuanList = new Array();
    var numOfDanXuan = 0;
    var totalQuestion = 0;
//下面这个是一个按钮，之后再添加到html里面,之后再这个函数里面添加有关的插入删除函数
    $("#danxuanadd").click(function () {
        numOfDanXuan++;
        totalQuestion++;
        $('#board').append(
            '<div class="danxuan"'+'id='+'"'+'danxuan'+ numOfDanXuan + '"'+'>'+    //字符串拼接ID
            '    <div class="smallbar">' +
            '        <h1>'+'Q'+totalQuestion+'</h1>'+
            '        <button onclick="return false">删除该问题</button>'+
            '    </div>' +
            '    <div class="biaoti">' +
            '        <h1 class="biaotishow">单选题</h1><input class="biaotiinput" type="text">' +
            '        <!--这里的name以后要用数组统一标记-->' +
            '    </div>' +
            '    <div class="wentizhuti">' +

            '    </div>' +
            '    <button class="addbutton" onclick="return false">添加一个选项</button><!--这里的图像之后添加-->' +
            '    <input type="checkbox" />必填' +
            '</div>'
        );
        var idNow = '#danxuanbutton' + numOfDanXuan;
        $('#danxuan' + numOfDanXuan + ' .smallbar button').click(function() {
            $('#danxuan'+numOfDanXuan).remove();
            numOfDanXuan--;
        });
    });
});
