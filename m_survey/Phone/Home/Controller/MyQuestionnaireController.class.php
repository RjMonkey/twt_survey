<?php
namespace Home\Controller;
use Think\Controller;
header("content-type:text/html;charset=Utf-8");
class MyQuestionnaireController extends Controller {
    //导出问卷
    public function index(){
        check_login();
        $link=M("Main");
        $userid=I('session.uid');
        $map['user_id']=$userid;
        $map['survey_status']=array('gt',0);
        $survey1=$link->where($map)->order('update_time desc')->select();
        foreach($survey1 as $i => $item){
            $id = $item['survey_id'];
            $survey1[$i]['survey_location'] = $_SERVER["HTTP_HOST"].U('Fill/index', array('survey_id'=> $id));
        }
        $map2['user_id'] = $userid;
        $map2['survey_status'] = 0;
        $survey2=$link->where($map2)->order('survey_id desc')->select();

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
        $data['end_time'] = time();
        $data['update_time'] = time();
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
                $data['update_time'] = time();
                $data['survey_status'] = 1;                    //发布状态改为已发布
                $data['update_time'] = time();
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
        if($judge1 && $judge5){
            echo "<script language='javascript'>alert('删除成功！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab2'</script>";
        }
        else{
            echo "<script language='javascript'>alert('sorry，删除失败，请重试！');javascript:window.location.href='".U('MyQuestionnaire/index')."#tab2'</script>";
        }
    }

    public function look(){
        $survey = getSurvey();
        if($survey['survey_status'] != 1 && !$survey['survey_status']){
            echo "<script language='javascript'>alert('该问卷未找到或已经结束发布！');javascript:window.location.href='".U('MyQuestionnaire/index')."'</script>";
        }
        $this->assign('survey', $survey);
        $this->display();
    }

    public function tongji(){
        check_login(); 
        $survey = getSurvey();
        foreach($survey['question'] as $key => $info){
            $result = M('Result')->where(array( 'question_id' =>  $info['question_id']))->select();
            foreach($result as $i => $detail){
                if($detail['question_type'] == 1){
                    $option_num = $detail['result_content'];
                    
                }
            }
        }
        cout($survey);
    }

    public function xinxi(){
        check_login();
        $survey_id=I('get.survey_id');
        if($survey_id == '') {
            $this->error('404 not found');
        }
        $map['survey_id']=$survey_id;
        $link=M('Main');
        $map['survey_id']=$survey_id;
        $survey=$link->where($map)->find();
        $this->assign('survey',$survey);
        $this->display();
    }



    public function Download()
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

                //如果是选择题
                if($question[$i]['question_type']=='1'){
                    $result[$j][$i+1]=$linkresult->where($mapresult)->getField('result_content');
                }
                //填空
                if($question[$i]['question_type']=='2'){
                    $result[$j][$i+1]=$linkresult->where($mapresult)->getField('result_content');
                }
                //表格
                if($question[$i]['question_type']=='3'){
                    $biao=$linkresult->where($mapresult)->getField('result_content');
                }
            }
        }
//        echo"<pre>";
//        echo print_r($result);
//        echo"</pre>";

        exportexcel($result,$title,$filename,$filetitle);
    }



    public function Yaoqing(){
        $link=M('Main');
        $survey_id=I('get.survey_id');
        if($survey_id == '') {
            $this->error('404 not found');
        }
        $map['survey_id']=$survey_id;
        $location=$link->where($map)->getField('survey_location');
        $this->assign('location',$location);
        $this->display();
    }
    public function Add(){
        $link=M('Main');
        $survey_id=I('get.survey_id');
        if($survey_id == '') {
            $this->error('404 not found');
        }
        $map['survey_id']=$survey_id;
        $content=$link->where($map)->getField('survey_location');
        $mail=I('post.mail');
        $title=I('post.mail','最近我刚发了一个问卷，来填一填吧');
        if(SendMail($mail,$title,$content))
            $this->success('发送成功！');
        else
            $this->error('发送失败');
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


    public function chakan(){
        $survey_id = I('get.survey_id');
        if($survey_id == '') {
            $this->error('404 not found');
        }
        $link_survey=M('Main');
        $map_survey=$survey_id;
        $status=$link_survey->where($map_survey)->getField('survey_status');
        //$cleanvalue = new CleanValueclass();
        //检测是否存在此问卷
        if(!M('Main')->where(array('survey_id'=>$survey_id))->select())
        {
            $this->error('404 not found');
        }

        $this->Fill = M('Main')->where(array('wenjuan_main.survey_id'=>$survey_id))->find();


        //检测问卷允不允许匿名
        if($this->Fill['anonymity'] == 1 && !check_login()){
            $this->error("因该问卷设置为不能匿名回答，请登录后再试");
            exit();
        }


        //获取点击量
        $hit = $this->Fill['hit'];
        $data = array(
            'hit' => $hit+1,
        );
        M('Main')->where(array('survey_id'=>$survey_id))->save($data);
        //获取选项
        $j=1;
        $question="";
        $question_id=to_array($this->Fill['question_id']);
        while($j <= $this->Fill['question_number']){
            $question[$j] = M('Question')->order('question_id')->where(array('wenjuan_question.question_id'=>$question_id[$j]))->find();
            $question[$j]['xuanxiang'] = to_array($question[$j]['xuanxiang']);
            /*for($k=1;$k<count($question[$j]['xuanxiang']);$k++){
                $cleanvalue->unCleanValue($question[$j]['xuanxiang'][$k]);
            }*/
            //表格题处理
            if($question[$j]['row']!=null){
                $question[$j]['row'] = to_array($question[$j]['row']);
            }
            if($question[$j]['cols']!=null){
                $question[$j]['cols'] = to_array($question[$j]['cols']);
            }
            $j++;
        }
        $temp = json_encode($question);
        //echo $temp;
//        $temp = '{"data":'.$temp2.'}';
        $this->assign('temp',$temp);
        /*echo "<pre>";
        print_r($question);
        echo"</pre>";*/
        //
        $this->assign('status', $status);
        $this->assign('question',$question);
        $this->assign('survey_id',$survey_id);
        $this->display();
    }

    public function info(){
        $survey = getSurvey();

    }
}
?>