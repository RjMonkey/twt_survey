<?php
namespace Home\Controller;
use Think\Controller;

header("content-type:text/html;charset=Utf-8");
 class GetJsonController extends Controller
 {

     public function index(){

         $this->display();
     }

     public function myQuestionnaire(){
         $uid = I('session.uid');
         $map['user_id'] = $uid;
         $survey = M('Main')->where($map)->select();
         $result = array();
         for($i = 0; $i < count($survey); $i++){
             $result['Ques'][$i]['Qid'] = $survey[$i]['survey_id'];
             $result['Ques'][$i]['QName'] = $survey[$i]['title'];
             $result['Ques'][$i]['State'] = $survey[$i]['survey_status'];
             $id = to_array($survey[$i]['question_id']);

             for($j = 1; $j < count($id); $j++){
                 $condition['question_id'] = $id[$j];
                 $question = M('Question')->where($condition)->find();

                 $result['Ques'][$i]['QContent'][$j-1]['id'] = $j-1;
                 $result['Ques'][$i]['QContent'][$j-1]['type'] = $question['question_type'];
                 $result['Ques'][$i]['QContent'][$j-1]['content'] = $question['question_content'];
                 $result['Ques'][$i]['QContent'][$j-1]['option'] = $question['xuanxiang'];
                 $result['Ques'][$i]['QContent'][$j-1]['is_must'] = $question['is_must'];
             }

         }
         $result = json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
         //$this->ajaxReturn($result, 'json');
         echo $result;
     }
     public function published(){
         check_login();
         $link=M("Main");
         $userid=I('session.user_id');
         $map['user_id']=$userid;
         $map['survey_status']=array('gt',0);
         $survey1=$link->field('survey_id as Qid, title as name')->where($map)->order('survey_id desc')->select();
         $survey1_jason_arr = array();
         $survey1_jason_arr['length'] = count($survey1);
         $survey1_jason_arr['QuestionUpdate'] = $survey1;
         echo $obj1 = json_encode($survey1_jason_arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
     }
     public function unpublished(){
         check_login();
         $link=M("Main");
         $userid=I('session.user_id');
         $map2['user_id']=$userid;
         $map2['survey_status']=0;
         $survey2=$link->field('survey_id as Qid, title as name')->where($map2)->order('survey_id desc')->select();
         //转换未发布的问卷的jason格式
         $survey2_jason_arr = array();
         $survey2_jason_arr['length'] = count($survey2);
         $survey2_jason_arr['QuestionUnupdate'] = $survey2;

         echo $obj2 = json_encode($survey2_jason_arr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
         //$this->display();

     }
 }
 ?>