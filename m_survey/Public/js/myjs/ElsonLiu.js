/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */
// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

/*nav-left show and hide*/
$(function(){
    /*for load left part*/
    $("body").append("<section id='nav-1'></section>");
    $("#nav-1").load("template/Nav-left.html");

    /*for another stuff hide*/
    $(".ab").hide();
    $("#nv-left").click(function(){
        $(".nav-left").animate({marginLeft: "0px"});
        $(".ab").show(500);
        $(".cd").hide();
        $("#row-h2").css("visibility","hidden");
    });
    $(".ab").click(function(){
        $(".ab").hide();
        $(".cd").show();
        $(".nav-left").animate({marginLeft: "-240px"});
        $("#row-h2").css("visibility","visible");
    });
    $(".UnUpdate").hide();

})

/*
function showQues($scope,$http){
    $http({
        url:"../json/test.json",
        method:"GET"
    }).success(function(data){
        $scope.QuesTemp = data["QuestionUpdate"];
        $scope.length = data["length"];
    }).error(function(){
        alert("Not Found The JSON data");
    });
}
*/




