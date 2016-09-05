$(document).ready(function () {
  
  $("#yifabu").show();
  $("#weifabu").hide();
  //$("#ordinaryYifabu").hide();
  //$("#ordinaryWeifabu").hide();
  $("#weifabuTag").bind("click", function () {
    $("#yifabu").hide();
    $("#weifabu").show();
    $("#weifabuTag").css("background-color", "gray");
    $("#weifabuTag").css("color", "#f7f7f7");
    $("#yifabuTag").css("background-color", "#f7f7f7");
    $("#yifabuTag").css("color", "gray");
    //$("#weifabu").attr($("#weifabu").attr("src").substring(0,$("#weifabu").attr("src").length - 4) + "black.png");
    //$("#ordinaryYifabu").hide();
    //$("#ordinaryWeifabu").hide();
  });
  $("#yifabuTag").bind("click", function () {
    $("#yifabu").show();
    $("#weifabu").hide();
    $("#yifabuTag").css("background-color", "gray");
    $("#yifabuTag").css("color", "#f7f7f7");
    $("#weifabuTag").css("background-color", "#f7f7f7");
    $("#weifabuTag").css("color", "gray");
    //$("#ordinaryYifabu").hide();
    //$("#ordinaryWeifabu").hide();
  });
  $(".yaoQingHuiDaClass").bind("click",function() {
    prompt("以下是该问卷的链接，请复制：", $(this).parent().find("input").val());

  });
  //var yifabuQuestion = [];
  //var weifabuQuestion = [];
  //var yifabuTotal = 0;
  //var weifabuTotal = 0;
  ////var cont = {xxx: 1};
  //$.post('post.php',function(data) {
  //  var res = eval('('+data+')');
  //  var total = res.length;
  //
  //  for (var i = 1; i <= total; i++) {
  //    var temp = res[i];
  //    if(temp['survey_status'] != 0) {
  //      var inTemp = $("#ordinaryYifabu").clone(true,true);
  //
  //      yifabuTotal++;
  //      yifabuQuestion[yifabuTotal] = inTemp;
  //
  //      inTemp.find(".wenJuanTitle").html(temp['survey_name']);
  //      inTemp.find(".wenJuanNum").html(yifabuTotal);
  //      inTemp.appendTo($("#yifabu"));
  //    } else {
  //      var inTemp = $("#ordinaryWeifabu").clone(true,true);
  //
  //      weifabuTotal++;
  //      weifabuQuestion[weifabuTotal] = inTemp;
  //
  //      inTemp.find(".wenJuanTitle").html(temp['survey_name']);
  //      inTemp.find(".wenJuanNum").html(weifabuTotal);
  //      inTemp.appendTo($("#weifabu"));
  //    }
  //  }
  //});
});
