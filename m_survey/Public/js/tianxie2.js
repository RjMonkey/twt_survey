$(document).ready(function () {
  var Title = $("#myTitle").val();
  var Description = $("#myDescription").val();
  var Question_number = $("#myQuestion_numbe").val();
  //var Question = shuzu;
  var Survey_Id = $("#myId").val();
  $("#showTitle").html(Title);
  $("#showDescription").html(Description.substring(0,Description.length-1));


  //var alldanxuan = $(".danXuanList");
  //var allduoxuan = $(".duoXuanList");

  //$("Button").bind("click", function () {
  //  alert("你已经成功提交问卷");
  //  var biglist = $(".allList");
  //  $.each(biglist, function () {
  //    if ($(this).attr("class") == "danXuanList") {
  //
  //      var temp = $(this);
  //
  //      $.each(temp.find("input"),function () {
  //
  //        if ($(this).is(':checked') == true){
  //          poststring = poststring + "@" + temp.find("p").html();
  //        }
  //
  //      });
  //
  //    }else if ($(this).attr("class") == "duoXuanList") {
  //
  //      var temp = $(this);
  //      var tempstring = "";
  //
  //      $.each(temp.find("input"),function () {
  //
  //        if ($(this).is(':checked') == true){
  //          tempstring = tempstring + "|" + temp.find("p").html();
  //        }
  //
  //      });
  //
  //      poststring = poststring + tempstring;
  //    }else if ($(this).attr("class") == "duoHangList") {
  //      poststring = poststring + $(this).find("textarea").val();
  //    }
  //
  //  });
  //
  //
  //  var cont = {content: poststring, survey_id: Survey_Id};
  //  $.post("insert", cont, function (){
  //    alert("你已经成功提交问卷");
  //  });
  //});
});


