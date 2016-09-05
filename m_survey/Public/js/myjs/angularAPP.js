/**
 * Created by Xindi on 2016/4/16.
 */
    /*问卷标题创建CreateQ.html POST*/
    var CreateQURL = post_createQ;

    /*问卷信息QInfo.html GET*/
    var QInfoURL = get_myqs;

    /*个人信息图片URL*/
    var PersonalImgURL = "";

    var template = template;


var app = angular.module('myApp', ['ui.router']);

/*定义路由*/
app.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when("", "/myQuestionnaire");
    $stateProvider
        .state("QInfo", {
            url: "/QInfo",
            params: {'Qid': ''},
            templateUrl: template+"/QInfo.html",
            controller : "QInfo"
        })
        .state("myQuestionnaire",{
            url:"/myQuestionnaire",
            templateUrl :"myQuestionnaire.html"
        }
    )
});

    /*For Checkbox*/
app.directive('checkbox',function(){
    return {
        restrict : 'EA',
        replace : true,
        transclude : true,
        templateUrl : template+'checkbox.html',
        link : function(scope, element, attrs) {
            scope.selected = true;
            scope.changeSelected = function(){
                scope.selected = !scope.selected;
            }
        }
    }
});

/*For navBar in the Top*/
app.directive('navBarTop',function(){
    return {
        restrict : 'EA',
        replace : true,
        transclude : true,
        templateUrl : template+'/navbarTop.html'
    }
});

/*For SingleChoose or MutiChoose*/
app.directive('choose',function(){
    return {
        restrict : 'EA',
        replace : true,
        transclude : true,
        templateUrl : template+'/ChooseTem.html',
        link : function(scope, element, attrs) {
            scope.selected = true;
            scope.changeSelected = function(){
                scope.selected = !scope.selected;
            }
        },
        controller: function($scope){
            document.getElementById("r1").setAttribute("checked", "checked");
        }
    }
});

app.directive('mutiChoose',function(){
    return {
        restrict : 'EAC',
        replace : true,
        transclude : true,
        templateUrl : template+'/ChooseTem.html',
        link : function(scope, element, attrs) {
            scope.selected = true;
            scope.changeSelected = function(){
                scope.selected = !scope.selected;
            }
        },
        controller: function($scope){
            document.getElementById("r2").setAttribute("checked", "checked");
        }
    }
});

app.controller('aclick',function($scope){
    $scope.showT = true;
    $scope.showY = false;
    $scope.aclick1 = function(){
        $scope.showT = true;
        $scope.showY = false;
    }
    $scope.aclick2 = function(){
        $scope.showT = false;
        $scope.showY = true;
    }
})

/*for myQuestionnaire json transfer*/
app.controller('left-that',function($scope){
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

    $scope.address = PersonalImgURL;
})

/*json处理分为已发布和未发布*/
function that(json,s, num){
    for(var i = 0; i < num; i++){
        if(json[i]["Qid"].substring(0,1) != s){
            delete json[i];
        }
    }
    return json;
}

app.controller('showQ', function($scope,$state,$http) {
    $http.get(QInfoURL)
        .success(function(data) {
            var json = data["Ques"];
            var num = json.length;
            $scope.names = that(json,"1",num);
            $scope.temp = false;
            $scope.showchange = function($scope){
                this.temp = !this.temp;
            }
            $scope.QidShow = function(Qid){
                $state.go('QInfo', {Qid: Qid});
            }
        });
});

app.controller('showQ2', function($scope, $http, $state) {
    $http.get(QInfoURL)
        .success(function(data) {
            var json = data["Ques"];
            var num = json.length;
            $scope.names = that(json,"2",num);
            $scope.temp = false;
            $scope.showchange = function($scope){
                this.temp = !this.temp;
            }
            $scope.QidShow = function(Qid){
                $state.go('QInfo', {Qid: Qid});
            }
        });
});


/*for 填空题*/
app.controller('fillInQues',function($scope){
    $scope.address = "AddQues.html";
});

/*for 单选题*/
app.controller('singleQues',function($scope,addOneS){
    $scope.address = "AddQues.html";
    $scope.mutiClick = function(){
        location.href = "AddMutiChoose.html";
    }
    $scope.addOne = function(){
        addOneS.clic();
    }
})

/*for 多选题*/
app.controller('mutiQues',function($scope, addOneS){
    $scope.address = "AddQues.html";
    $scope.singleClick = function(){
        location.href = "AddSingleChooseQ.html";
    }
    $scope.addOne = function(){
        addOneS.clic();
    }
})

app.service('addOneS',function(){
    return{
        clic: function(){
            $(".Q3:last-child").after("<input class='Qtitle-input Q2 Q3' placeholder='请输入选项名称'>");
        }
    }
})


app.controller('createQ',function($scope, $http){
    $scope.address = "myQuestionnaire.html";
    $scope.saveCreateQ = function(){
        var temp = {};
        temp["Qtype"] = $scope.CreateQ;
        temp["Qcontent"] = $scope.Create;
        $http.post(CreateQURL, temp).success(function (data, status, headers, config) {

        }).error(function (data, status, headers, config){
            alert("Error");
        });
        window.location.href = "myQuestionnaire.html";
    }
})

app.controller('QInfo',function($scope, $http, $stateParams, httpQInfo){
/*    $scope.address = "myQuestionnaire.html"*/
    httpQInfo.httpS($stateParams,$scope);
})


/*http连接对于问卷信息*/
app.service('httpQInfo',function($http){
    return{
        httpS : function($stateParams,$scope){
            $http.get(QInfoURL).success(function(data){
                var temp = data["Ques"];
                var len = temp.length;
                var Qid = $stateParams.Qid;
                for(var i = 0; i < len; i++){
                    if(Qid == temp[i]["Qid"]){
                        var j = temp[i]["QContent"].length;
                        for(var s = 0 ; s < j; s++){
                            switch(temp[i]["QContent"][s]["type"]){
                                case "1":
                                    temp[i]["QContent"][s]["type"] = "单选题";
                                    break;
                                case "2":
                                    temp[i]["QContent"][s]["type"] = "多选题";
                                    break;
                                case "3":
                                    temp[i]["QContent"][s]["type"] = "填空题";
                                    break;
                                default:
                                    temp[i]["QContent"][s]["type"] = "题目类型错误"
                                    break;
                            }
                        }

                        $scope.Qnums = temp[i]["QContent"];
                        $scope.QTName = temp[i]["QName"];
                    }
                }
            });
        }
    }
})
