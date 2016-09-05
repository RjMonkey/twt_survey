<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class StaticsController extends Controller
{
    public function index()
    {
        $link = M('Main');
        $map['survey_status'] = 1;
        $map['user_id'] = I('session.uid');
        $survey = $link->order('hit desc')->where($map)->select();
        for ($i = 0; $i < count($survey); $i++) {
            $survey[$i]['num_of_answer'] = M('Result')->group('ip')->count();

            $survey[$i]['fabu_time'] = date("Y-m-d", $survey[$i]['fabu_time']);
        }
        $this->assign('survey', $survey);
        $this->display();
    }
    public function statisticsDetail(){
        $sid = I('get.survey_id');
        $this->assign('sid', $sid);
        $this->display();
    }
    public function statics(){
        $condition['survey_id'] = I('get.survey_id');
        $survey = M('Main')->where($condition)->find();
        $survey['num_of_people'] = count(M('Result')->where(array('survey_id' => I('get.survey_id')))->group('ip')->select());
        $question = M('Question')->where($condition)->select();
        foreach($question as $key => $item){
            $condition_option['question_id'] = $item['question_id'];
            $question[$key]['option'] = M('Option')->where($condition_option)->order('option_num')->select();
            $question[$key]['qid'] = $key+1;
        }
        $survey['question'] = $question;
        $survey = json_encode($survey,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        echo $survey;
    }
    public function fillInResult(){

        $sid = I('get.Sid');
        $qid = I('get.Qid');
        $this->assign('sid', $sid);
        $this->assign('qid', $qid);
        $this->display();
    }
    public function fill(){
        $sid = I('get.Sid');
        $qid = I('get.qid');
      //  $survey = M('Main')->where(array('survey_id' => $sid))->find();
        $question = M('Question')->where(array('question_id' => $qid))->find();
        $question['result'] = M('Result')->where(array('question_id' => $qid))->select();
        $question['sum'] = count($question['result']);

        $question = json_encode($question,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        echo $question;
    }

    public function search_result(){
        $link=M('Main');
        $content = I('post.content');
        // echo $content;
        if($content)
        {
            $map['survey_status']=1;
            $map['title'] =array('like','%'.$content.'%');
            $map['user_id'] = I('session.uid');
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
}