<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
header("content-type:text/html;charset=Utf-8");
 class DesignController extends Controller
 {
     public function index(){
         check_login();
         $this->display();
     }
     public function quesDesign(){
         check_login();
         $this->display();
     }

     public function modifyAdd(){
         check_login();
         $sid = I('get.survey_id');
         $map_del['survey_id'] = $sid;
         //abc判断是否删除
         $a = M('Main')->where($map_del)->delete();
         $b = M('Question')->where($map_del)->delete();
         $c = M('Option')->where($map_del)->delete();
         if($a && $b && $c){
             $json = trim(file_get_contents("php://input"));
             $arr = json_decode($json, true);

             //     cout($arr);
             $survey['title'] = trim($arr[0]['QTitle']);
             $survey['description'] = trim($arr[1]['QInfo']);
             $survey['anonymity'] = $arr[2]['Niming'];
             $survey['create_time'] = time();
             $survey['update_time'] = time();
             $survey['user_id'] = I('session.uid');
             $survey['survey_status'] = 0;
             $survey['hit'] = 0;
             $question = array();
             $option = array();
             //插入问卷
             $survey_id = M('Main')->add($survey);
             if($survey_id){
                 for($i = 3; $i < count($arr); $i++){
                     $question['question_type'] = $arr[$i]['type'];
                     $question['survey_id'] = $survey_id;
                     $question['question_content'] = $arr[$i]['content'];
                     if($question['question_content'] == "")
                         $question['question_content'] = "空";
                     $question['is_must'] = $arr[$i]['is_must'];
                     //插入题目
                     $qid = M('Question')->add($question);
                     if($qid && $arr[$i]['type'] != 3){
                         $temp = explode("@",$arr[$i][option]);
                         foreach ($temp as $key => $info) {
                             $option['option_content'] = trim($info);
                             if($option['option_content'] == "")
                                 $option['option_content'] = "空";
                             $option['question_id'] = $qid;
                             if(trim($info) != "其他")
                                 $option['is_other'] = 0;
                             else
                                 $option['is_other'] = 1;
                             $option['option_num'] = $key;
                             $option['survey_id'] = $survey_id;
                             $option['sum'] = 0;
                             //插入选项
                             M('Option')->add($option);
                         }
                     }
                 }
             }

             if(!$survey_id)
                 echo "<script language='javascript'>alert('添加问卷信息失败！');javascript:history.go(-1);</script>";
         }
         else{
             echo "<script language='javascript'>alert('数据库错误！');javascript:history.go(-1);</script>";

         }

 }

     public function insert(){
         check_login();
         $json = trim(file_get_contents("php://input"));
         $arr = json_decode($json, true);

       //     cout($arr);
         $survey['title'] = trim($arr[0]['QTitle']);
         $survey['description'] = trim($arr[1]['QInfo']);
         $survey['anonymity'] = $arr[2]['Niming'];
         $survey['create_time'] = time();
         $survey['update_time'] = time();
         $survey['user_id'] = I('session.uid');
         $survey['survey_status'] = 0;
         $survey['hit'] = 0;
         $question = array();
         $option = array();
         //插入问卷
         $survey_id = M('Main')->add($survey);
         if($survey_id){
             for($i = 3; $i < count($arr); $i++){
                 $question['question_type'] = $arr[$i]['type'];
                 $question['survey_id'] = $survey_id;
                 $question['question_content'] = $arr[$i]['content'];
                 if($question['question_content'] == "")
                     $question['question_content'] = "空";
                 $question['is_must'] = $arr[$i]['is_must'];
                 //插入题目
                 $qid = M('Question')->add($question);
                 if($qid && $arr[$i]['type'] != 3){
                     $temp = explode("@",$arr[$i][option]);
                     foreach ($temp as $key => $info) {
                         $option['option_content'] = trim($info);
                         if($option['option_content'] == "")
                             $option['option_content'] = "空";
                         $option['question_id'] = $qid;
                         if(trim($info) != "其他")
                            $option['is_other'] = 0;
                         else
                            $option['is_other'] = 1;
                         $option['option_num'] = $key;
                         $option['survey_id'] = $survey_id;
                         $option['sum'] = 0;
                         //插入选项
                         M('Option')->add($option);
                     }
                 }
             }
         }

         if(!$survey_id)
             echo "<script language='javascript'>alert('添加问卷信息失败！');javascript:history.go(-1);</script>";

     }

     public function modifyQues(){
         //check_login();


         $survey_id = I('get.survey_id');
         $this->assign('survey_id', $survey_id);

         $this->display();
     }
     public function modify(){
         $survey = getSurvey();
         $survey = json_encode($survey);
         echo $survey;
     }


     public function get_json(){
         $input = file_get_contents("php://input",true);
         echo $input;

         if(!empty($input)){
             $data['a']=1;
             M('test')->add($data);
         }
     }

 }
 ?>