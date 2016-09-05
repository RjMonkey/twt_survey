<?php
namespace Home\Controller;
use Think\Controller;
use Think\FatherController;
use Think\Page;
use Think\Upload;
header("content-type:text/html;charset=utf-8");
class FillController extends Controller {

    public function fill()
    {
        //echo $this->getIp();
        $link = M('Main');
        $map['survey_status'] = 1;
        $survey = $link->order('hit desc')->where($map)->select();
        for ($i = 0; $i < count($survey); $i++) {
            $survey[$i]['num_of_answer'] = M('Result')->group('ip')->count();

            $survey[$i]['fabu_time'] = date("Y-m-d", $survey[$i]['fabu_time']);
        }
        $this->assign('survey', $survey);
        $this->display();
    }
    public function search_result(){
        $link=M('Main');
        $content = I('post.content');
        // echo $content;
        if($content)
        {
            $map['survey_status']=1;
            $map['title'] =array('like','%'.$content.'%');

            $count = $link->where($map)->count();
            $page = new Page($count, 8);
            $show = $page->show();
            $survey=$link->order('hit desc')->where($map)->select();
            for($i=0;$i<count($survey);$i++)
            {
                $survey[$i]['num_of_answer'] = M('Result')->group('ip')->count();
                $survey[$i]['fabu_time']=date("Y-m-d",$survey[$i]['fabu_time']);
            }
        }
        $this->assign('survey',$survey);

        $this->display('Statics/index');
    }
    public function index(){

        $survey = getSurvey();
        if($survey['survey_status'] != 1 && !$survey['survey_status']){
            echo "<script language='javascript'>alert('该问卷未找到或已经结束发布！');javascript:window.location.href='".U('MyQuestionnaire/index')."'</script>";
        }
        if($survey['anonymity'] == 0){
            check_login();
        }
        else{
            $ip = getIP();
            $map['ip'] = $ip;
            $map['survey_id'] = $survey['survey_id'];
            $map2['survey_id'] = $survey['survey_id'];
            $map2['user_id'] = I('session.uid');

            if(M('Result')->where($map)->find())
                echo "<script language='javascript'>alert('您已填写该问卷！');javascript:window.location.href='".U('MyQuestionnaire/index')."'</script>";
            if(M('Result')->where($map2)->find())
                echo "<script language='javascript'>alert('您已填写该问卷！');javascript:window.location.href='".U('MyQuestionnaire/index')."'</script>";
        }
        $this->assign('survey', $survey);
        $this->display();
    }

    public function add(){
        $result = I('post.q');
        foreach($result as $key => $info){
            $map['question_id'] = $key;
            $data = M('Question')->where($map)->field('question_id, question_type')->find();
            if($data['question_type'] == 1){
                $data['result_content'] = $info;
            }
            elseif($data['question_type'] == 2){
                $data['result_content'] = implode("@",$info);
                foreach($info as $k => $op){
                    $map_op['question_id'] = $key;
                    $map_op['option_num'] = $op;
                    M('Option')->where($map_op)->setInc('num');
                }
            }
            elseif($data['question_type'] == 3){
                $data['result_content'] = $info;
            }
            $data['survey_id'] = I('get.survey_id');
            $data['answer_user_id'] = I('session.uid');
            $data['ip'] = getIP();
            $judge = M('Result')->add($data);
            if($judge)
                echo "<script language='javascript'>alert('填写成功！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab1'</script>";
            else
                echo "<script language='javascript'>alert('数据库错误！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab1'</script>";
        }
    }





    //向数据库中插入答题信息
    public function insert(){
        $surveyid=I('post.survey_id',0);
        $surveyid = substr($surveyid,0,strlen($surveyid)-1);
        if($surveyid == 0) {
            $this->error('404 not found');
        }
        $content=I('post.content',0);
        $link_survey=M('Main');
        $map_survey['survey_id']=$surveyid;
        $status=$link_survey->where($map_survey)->getField('survey_status');
        $ip=$this->getIP();
        $link_result=M('Result');

        $arr=$link_result->where($map_survey)->group('ip')->select();
//        echo "<pre>";
//        print_r($arr);
//        echo "</pre>";
        $judge=1;
        for($i=0;$i<count($arr)&&$judge==1;$i++){
            if($ip==$arr[$i]['ip']){
                echo "<script>alert(\"您已经填写该问卷。\");javascript:history.back();</script>";
                $judge=0;
            }
        }
        if($judge==1){
            echo $status;
            if($status==0){
                echo "<script>alert(\"该问卷未发布\");javascript:history.back();</script>";
            }
            else if($status==2){
                echo "<script>alert(\"该问卷已经停止发布\");javascript:history.back();</script>";
            }
            else{
                $username=I('session.username',0);
                if($username){
                    $linkuser=M('User');
                    $mapuser['user_id']=I('session.user_id');
                    $answer_survey_id=$linkuser->where($mapuser)->getField('answer_survey_id');
                    $id=to_array($answer_survey_id);
                    for($i=1; $i<count($id); $i++){
                        if($surveyid==$id[$i]){
                            echo "<script language='javascript'>alert('您已填写问卷2');window.location.href='".U('Index/index')."';</script>";
                        }
                    }
                    $num=$link_survey->where($map_survey)->getField('datirenshu');
                    $num++;
                    $data['answer_survey_id']=$answer_survey_id."@".strval($surveyid);
                    $data['datirenshu']=$num;
                    $linkuser->where($mapuser)->save($data);
                    $link_survey->where($map_survey)->save($data);
                }
                $link=M('Question');
                $map['survey_id']=$surveyid;
                $question=$link->where($map)->order('question_id')->select();
                $content=to_array($content);
                for($i=1; $i<count($content); $i++){
                    $result['question_id']=$question[$i-1]['question_id'];
                    $result['question_type']=$question[$i-1]['question_type'];
                    $result['result_content']=$content[$i];
                    if($username){
                        $result['answer_id']=$_SESSION['user_id'];
                    }
                    $result['ip']=$ip;
                    $result['survey_id']=$surveyid;
                    $link_result->add($result);
                }

                echo "<script language='javascript'>alert('提交成功');window.location.href='".U('Index/index')."';</script>";
                $this->redirect("Index/index");
            }
        }
    }
}
?>