/**
 * Created by Xindi on 2016/5/1.
 */
$(function(){
    $("label[for='checkbox']").click(function(){
        setTimeout(function(){
            var s = $(".sect");
            if($("#checkbox").is(":checked")){
                s.addClass("selectedtrue");
                s.removeClass("selectedfalse");
            }else{
                s.addClass("selectedfalse");
                s.removeClass("selectedtrue");
            }
        },1);
    });
})