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

     public function insert(){
         check_login();
         $method = I('get.method');
         if($method == "qInfo"){
             $data['title'] = trim(I('post.title'));
             if($data['title'] == ""){
                 $data['title'] = "空";
             }
             $uid = I('session.uid');

             $data['description'] = I('post.description');
             if($data['description'] == ""){
                 $data['description'] = "空";
             }
             $data['create_time'] = time();
             $data['update_time'] = time();
             $data['user_id'] = $uid;
             $data['survey_status'] = 0;
             $data['hit'] = 0;
             if(I('post.niMing' == 1))
                 $data['anonymity'] = 1;
             else
                 $data['anonymity'] = 0;
             $new_id = M('Main')->add($data);
             $map['user_id'] = $uid;
             $result = M('User')->where($map)->find();
             $result['survey_id'] = $result['survey_id']."@".$new_id;
             M('User')->save($result);
             if($new_id)
                 echo "<script language='javascript'>alert('添加问卷信息成功！');javascript:window.location.href='".U("Design/modify", array('survey_id'=>$new_id))."'</script>";
             else
                 echo "<script language='javascript'>alert('添加问卷信息失败！');javascript:history.go(-1);</script>";

         }
         elseif($method = "choose"){

         }
     }

     public function modify(){
         check_login();
         $survey = getSurvey();
         $survey_id = I('get.survey_id');
         $status = I('get.status');
         $this->assign('status', $status);
         $this->assign('survey_id', $survey_id);
         $this->assign('survey', $survey);
         $this->display();
     }

     public function addQues(){
         check_login();
         $survey_id = I('get.survey_id');
         $a = M('Main')->where(array('survey_id' => $survey_id))->find();
         $status = $a['survey_status'];
         if($status != 0)
             echo "<script language='javascript'>alert('该问卷已发布或已已经结束发布！');javascript:history.go(-1);</script>";
         $this->assign('survey_id', $survey_id);
         $this->display();
     }

     public function addChooseQ(){
         check_login();
         $data = I('get.data');
         $survey_id = I('get.survey_id');
         $this->assign('type', $data);
         $this->assign('survey_id', $survey_id);
         $this->display();
     }

     public function addFillQues(){
         check_login();
         $data = I('get.data');
         $survey_id = I('get.survey_id');
         $this->assign('type', $data);
         $this->assign('survey_id', $survey_id);
         $this->display();
     }

     public function addQ(){
         check_login();
         $type = trim(I('get.data'));
         $survey_id = trim(I('get.survey_id'));
         if($type == "Fill")
         {
             $question['question_type']=3;
         }
         elseif($type == "Single" || $type == "Multiply")
         {
             $question['question_type'] = I('post.radio');
         }
        else{
             echo "<script language='javascript'>alert('这个题型我识别不出，sorry！');javascript:history.go(-1);</script>";
         }
         $question['survey_id']=$survey_id;
         $question['question_content']=I('post.content');
         if(I('post.must'))
             $question['is_must']=1;
         else
             $question['is_must']=0;

         if(I('post.max')=="不限")
              $question['max_num']=0;
         else
             $question['max_num']=I('post.max');

         $judge1 =  $question_id = M('Question')->add($question);
         //加入选项的第一道题
         $option['option_content'] = trim(I('post.option'));
         $option['question_id'] = $question_id;
         if($option['option_content'] == "其他")
             $option['is_other'] = 1;
         else
             $option['is_other'] = 0;
         $option['option_num'] = 0;
         $option['survey_id'] = $survey_id;
         $option['num'] = 0;
         if($judge1 && $option['option_content'])
             M('Option')->add($option);
         //加入选项的2和之后的题
         $option_arr = I('post.option2');
         foreach($option_arr as $i => $info ){
             if($info){
                 $option2['option_content'] = trim($info);
                 $option2['question_id'] = $question_id;
                 if(trim($info) == "其他")
                     $option2['is_other'] = 1;
                 else
                     $option2['is_other'] = 0;
                 $option2['option_num'] = $i+1;
                 $option2['survey_id'] = $survey_id;
                 if($judge1 && $option2['option_content'])
                    M('Option')->add($option2);
             }
         }
         if($judge1)
             echo "<script language='javascript'>alert('添加成功！');javascript:window.location.href='".U("Design/modify", array('survey_id'=>$survey_id))."'</script>";
         else
             echo "<script language='javascript'>alert('添加失败，sorry！');javascript:history.go(-1);</script>";

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