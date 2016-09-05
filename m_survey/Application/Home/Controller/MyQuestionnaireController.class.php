<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
header("content-type:text/html;charset=Utf-8");
class MyQuestionnaireController extends Controller {
    //导出问卷
    public function index(){
        check_login();
       // cout($_SESSION);
        $link=M("Main");
        $userid=I('session.uid');


        $map['user_id'] = $userid;
        $map['survey_status'] = array('gt',0);

        $map2['user_id'] = $userid;
        $map2['survey_status'] = 0;


        $count1=$link->where($map)->order('update_time desc')->order('survey_status desc')->count();
        $pageNav = new Page($count1, 6);
        $count1;

        $count2=$link->where($map2)->order('survey_id desc')->count();
        $pageNav_nonPost = new Page($count2, 6);

        $p = I('get.p');
        $m = I('get.m');
        $last = ceil($count1 / 6);
        $last_nonPost = ceil($count2 / 6);


        if($p > $last && $m == 1 && $last > 0){
            $this->redirect("MyQuestionnaire/index",array('p'=>$last, 'm'=>1));
        }
        elseif($p > $last_nonPost && $m == 0 && $last_nonPost > 0){
            $this->redirect("MyQuestionnaire/index",array('p'=>$last_nonPost, 'm'=>0));
        }
        elseif($p < 1){
            $this->redirect("MyQuestionnaire/index",array('p'=>1, 'm'=>1));
        }
        else{
            $survey1=$link->where($map)->order('update_time desc')->order('survey_status desc')->limit($pageNav->firstRow.','.$pageNav->listRows)->select();
            foreach($survey1 as $i => $item){
                $id = $item['survey_id'];
                $survey1[$i]['survey_location'] = $_SERVER["HTTP_HOST"].U('Fill/index', array('survey_id'=> $id));
            }
            //not post
            $survey2=$link->where($map2)->order('survey_id desc')->limit($pageNav_nonPost->firstRow.','.$pageNav_nonPost->listRows)->select();
        }

        $this->assign('p', $p);
        $this->assign('pre', $p-1);
        $this->assign('after', $p+1);

        $this->assign('last', $last);
        $this->assign('last_nonPost', $last_nonPost);

        $this->assign('survey1', $survey1);
        $this->assign('survey2', $survey2);
        $this->display();
    }
    public function myQuestionnaire(){
        $this->display();
    }

    public function stop(){
        check_login();
        $status = I('get.status');
        if($status == 2)
            echo "<script language='javascript'>alert('该问卷已经结束发布！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab1'</script>";
        $link=M("Main");
        $id=I('get.survey_id');
        $map_survey['survey_id']=$id;
        $data['survey_status']=2;
        $data['end_time']=time();
        if($link->where($map_survey)->save($data)){
            echo "<script language='javascript'>alert('结束发布成功！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab1'</script>";
        }
        else{
            echo "<script language='javascript'>alert('结束发布失败！');javascript:window.location.href='".U('MyQuestionnaire/index')."'</script>";
        }
    }

    public function post()
    {
        //if(I('post.fabu') == 'fabu'){
        check_login();
        if (I('get.survey_id')) {
            $survey_id = I('get.survey_id');

            //判断是不是属于该用户
            $arra = M('Main')->where(array('wenjuan_main.survey_id' => $survey_id))->find();
            if ($arra['user_id'] == $_SESSION['uid']) {

               // $survey_location = "http://survey.twtstudio.com/index.php/Fill/index/survey_id/$survey_id";         //分享网址
                //$data['survey_location'] = $survey_location;
                $data['fabu_time'] = time();
                $data['survey_status'] = 1;                    //发布状态改为已发布
                if( M('Main')->where(array('wenjuan_main.survey_id' => $survey_id))->data($data)->save())
                    echo "<script language='javascript'>alert('发布成功！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab1'</script>";
                else
                    echo "<script language='javascript'>alert('数据库错误！');javascript:history.go(-1);</script>";

            } else {
                echo "<script language='javascript'>alert('您不能发布别人的问卷！');javascript:history.go(-1);</script>";
            }

        }

    }


    public function delete(){
        check_login();

        $survey_id = I('get.survey_id');
        $uid = I('session.uid');
        $condition['survey_id'] = $survey_id;
        $judge1 = M('Main')->where($condition)->delete();
        $judge2 = M('Question')->where($condition)->delete();
        $judge3 = M('Result')->where($condition)->delete();
        $judge4 = M('Option')->where($condition)->delete();
        $result = M('User')->where(array('user_id' => $uid))->find();
        $survey_arr = to_array($result['survey_id']);
        $key = array_search($survey_id, $survey_arr);
        $survey_arr[$key] = $survey_arr[count($survey_arr)-1];
        array_pop($survey_arr);
        $survey_str = to_string($survey_arr);
        $result['survey_id'] = $survey_str;
        $judge5 = M('User')->where(array('user_id' => $uid))->save($result);
        if($judge1){
            echo "<script language='javascript'>alert('删除成功！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab2'</script>";
        }
        else{
            echo "<script language='javascript'>alert('sorry，删除失败，请重试！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab2'</script>";
        }
    }

    public function look(){
        $survey = getSurvey();
        $m = I('get.m');
        $p = I('get.p');
        if($m == 1)
            $address = "#tab1";
        else
            $address = "#tab2";
        $this->assign('p', $p);
        $this->assign('address', $address);
        $this->assign('survey', $survey);
        $this->display();
    }






    public function download()
    {

        $title[0]='编号';
        $link=M('Question');
        $survey_id=I('get.survey_id');
        if($survey_id == '') {
            $this->error('404 not found');
        }
        $map['survey_id']=$survey_id;
        $filetitle=M('Main')->where($map)->getField('title');
        $filename=date('Y-m-d').$filetitle;
        $question=$link->where($map)->order('question_id')->select();
        for($i=1;$i<=count($question);$i++){
            $title[$i]="Q".($i).$question[$i-1]['question_content'];
        }
//        echo"<pre>";
//        echo print_r($title);
//        echo"</pre>";
        $result='';
        $linkresult=M('Result');
        //找到在一个主表id里有多少个不同ip
        $ip=$linkresult->where($map)->group('ip')->select();
        for($j=0; $j<count($ip); $j++){
            $result[$j][0]=$j+1;
            for($i=0; $i<count($question); $i++){
                $mapresult['question_id']=$question[$i]['question_id'];
                $mapresult['ip']=$ip[$j]['ip'];

                //如果是单选题
                if($question[$i]['question_type']=='1'){
                    $map_option['option_num'] = $linkresult->where($mapresult)->getField('result_content');
                    $map_option['question_id'] = $question[$i]['question_id'];
                    $result[$j][$i+1] = M('Option')->where($map_option)->getField('option_content');
                }
                //如果是多选题
                if($question[$i]['question_type']=='2'){
                    $op_arr = $linkresult->where($mapresult)->getField('result_content');
                    $op_arr = explode("@",$op_arr);
                    $op_str = array();
                    foreach($op_arr as $key => $info)
                    {
                        $map_option['option_num'] = $info;
                        $map_option['question_id'] = $question[$i]['question_id'];
                        $op_str[$key] = M('Option')->where($map_option)->getField('option_content');
                    }
                    $result[$j][$i+1] = implode("@", $op_str);
                }
                //填空
                if($question[$i]['question_type']=='3'){
                    $result[$j][$i+1]=$linkresult->where($mapresult)->getField('result_content');
                }
                //表格
                if($question[$i]['question_type']=='4'){
                    $biao=$linkresult->where($mapresult)->getField('result_content');
                }
            }
        }
//        echo"<pre>";
//        echo print_r($result);
//        echo"</pre>";
//        cout($filetitle);

        exportexcel($result,$title,$filename,$filetitle);
    }


    public function cha_kan_yi_tian_wen_juan(){
        $surveyid=I('get.survey_id',0);
        if($surveyid == '') {
            $this->error('404 not found');
        }
        $userid=$_SESSION['user_id'];
        $link=M('Main');
        $map['survey_id']=$surveyid;
        $survey=$link->where($map)->field('survey_id','survey_name', 'survey_title', 'survey_description')->find();
        $link_question=M('Question');
        $question=$link_question->where($map)->order('question_id')->select();
        $link_result=M('Result');
        for($i=0; $i<count($question); $i++){
            $map_result['answer_people_id']=$userid;
            $map_result['question_id']=$question[$i]['question_id'];
            $result=$link_result->where($map_result)->find();
            //选择
            if($question[$i]['type']==1){
                $question['result']=$result['content'];
            }
            //填空
            if($question[$i]['type']==2){
                $question['result']=$result['content'];
            }
            //表格
            if($question[$i]['type']==3){
                $question['result']=$result['content'];
            }
        }
        $survey['question']=$question;
        $this->assign('survey',$survey);
        $this->display();
    }

    public function info1()
    {

        $link = M("Main");
        $userid = I('session.uid');
        $survey_id = I('get.SID');
      //  echo $survey_id;

        $map['user_id'] = $userid;
        $map['survey_status'] = array('gt', 0);

        $map2['user_id'] = $userid;
        $map2['survey_status'] = 0;


        $survey1 = $link->where($map)->order('update_time desc')->order('survey_status desc')->select();
        foreach ($survey1 as $i => $item) {
            $id = $item['survey_id'];
         // $survey1[$i]['survey_id'] =$i + 1;
            $survey1[$i]['create_time'] = date("Y-m-d h:i:sa", $survey1[$i]['create_time']);
            $survey1[$i]['update_time'] = date("Y-m-d h:i:sa", $survey1[$i]['update_time']);
            if($survey1[$i]['status'] = 2)
                $survey1[$i]['status'] = "已结束发布";
            else
                $survey1[$i]['status'] = "是";
            $survey1[$i]['post_time'] = date("Y-m-d h:i:sa", $survey1[$i]['update_time']);
            $survey1[$i]['num_of_question'] = M('question')->where(array('survey_id' => $id))->count();
            if($item['anonymity'] == 0)
                $survey1[$i]['is_login'] = "是";
            else
                $survey1[$i]['is_login'] = "否";
            $survey1[$i]['num_of_answerer'] = M('Result')->where(array('survey_id' => $id))->count();

            $survey1[$i]['survey_location'] =  $_SERVER["SERVER_ADDR"] . U('Fill/index', array('survey_id' => $id));
        }
        foreach($survey1 as $key => $info){
            $survey1[$key]['title'] = urldecode( $survey1[$key]['title']);
        }
        $survey1 = urldecode(json_encode($survey1));

        echo $survey1;
    }
    public function info2()
    {

        $survey_id = I('get.survey_id');
        echo $survey_id;
        $link = M("Main");
        $userid = I('session.uid');


        $map['user_id'] = $userid;
        $map['survey_status'] = array('gt', 0);

        $map2['user_id'] = $userid;
        $map2['survey_status'] = 0;



        $survey2 = $link->where($map2)->order('survey_id desc')->select();
        foreach ($survey2 as $i => $item) {
            $id = $item['survey_id'];
          //  $survey2[$i]['survey_id'] = $i + 1;
            $survey2[$i]['create_time'] = date("Y-m-d h:i:sa", $survey2[$i]['create_time']);
            $survey2[$i]['update_time'] = date("Y-m-d h:i:sa", $survey2[$i]['update_time']);
            $survey2[$i]['status'] = "否";
            $survey2[$i]['post_time'] = 0;
            $survey2[$i]['num_of_question'] = M('question')->where(array('survey_id' => $id))->count();
            if($item['anonymity'] == 0)
                $survey2[$i]['is_login'] = "是";
            else
                $survey2[$i]['is_login'] = "否";
            $survey2[$i]['num_of_answerer'] = 0;
            $survey2[$i]['survey_location'] = $_SERVER["SERVER_ADDR"] . U('Fill/index', array('survey_id' => $id));
        }
        $survey2 = json_encode($survey2);
        echo $survey2;
    }


}
?>