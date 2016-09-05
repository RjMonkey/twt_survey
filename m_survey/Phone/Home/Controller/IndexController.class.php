<?php
namespace Home\Controller;
use Think\Controller;
header("content-type:text/html;charset=Utf-8");
class IndexController extends Controller {

    public function  index(){
        $token = I('get.token');
        if($token){
            $user_info = get_sso_object()->getUserInfo($token);
        }
        if($user_info && $user_info->message == "请求成功" && $user_info->status == 1){

            $result = $user_info->result;
            $map['user'] = $result->twt_name;
            $data = "";
            if(!(M('User')->where($map)->find())){
                $Model = M('User');
                $data['user']=$result->twt_name;
                $data['ip']=getIP();
                $Model->add($data);
            }
            $data_user = M('User')->where($map)->find();
            //cout($result);
            session("realname",$result->user_info->username);
            session("uid",$data_user['user_id']);
            session("user_id", $data_user['user_id']);
            session("username",$result->twt_name);
        }
        //cout($_SESSION);
        if(I('session.uid')){
            echo "<script language='javascript'>alert('登录成功');window.location.href='".U('MyQuestionnaire/index')."#tab1';</script>";
        }
        $this->display();
    }
    public function sso_jump(){
        $user_obj = get_sso_object();
        $app_id="8";
        $app_key="xVNxrf0yMuy7Cgs3pqdB";
        // $sso=new TwTSSO($app_id,$app_key,false,true);

        // $sso_login=$sso->getLoginUrl("http://www.twt.edu.cn/shijian/login_action.php");


        $time=time();

        $link="\"http://survey.twtstudio.com/\"";
        $source=base64_encode($link);
        $signString='app_id='.$app_id.'&time='.$time.'&source='.$source;
        $sign=hash_hmac('sha1',$signString,$app_key);
        $url='http://account.dev.twtapps.net/sso/login?time='.$time.'&sign='.$sign.'&app_id='.$app_id.'&source='.$source;
        header("Location:".$url);
    }
    public function login(){
        $this->display();
    }
    public function check_login(){
        $result=log_in();
        if($result){
            $username=trim(I('post.username'));
            //检测该用户是否为第一次登录到问卷网,若是第一次则在问卷的数据库中插入该用户
            if(!$this->checkUser($username)){
                $Model = M('User');
                $Model->user=$username;
                $Model->add();
            }
            $User=M('User');
            // $data=$User->where("user=$username")->find();   //find()返回一维数组，而select()返回二维数组
            $data=$User->where(array('user'=>$username))->find();
            // where(array('wenjuan_main.question_id'=>$question_id[$j]))

            $realname=$result->realname;
            session("realname",$realname);
            session("uid",$data['user_id']);
            session("user_id", $data['user_id']);
            session("username",$data['user']);
            echo "<script language='javascript'>alert('登录成功');window.location.href='".U('MyQuestionnaire/index')."#tab1';</script>";
           // $this->redirect('Myqsnaire/index');

        }
        else{
            echo"<script language='javascript'>alert('账号或密码错误，请重试!');javascript:history.go(-1);</script>";
        }
    }
    public function logout(){
        session(null);
        echo "<script language='javascript'>alert('注销成功');window.location.href='".U('Index/index')."';</script>";
    }

    private function checkUser($account){
        $arr['user']=$account;
        $data=M("User")->where($arr);
        if($data->select()){
            return true;
        }
        else{
            return false;
        }
    }
    //我的问卷

    public function test(){
        $this->display();
    }
    public function test1(){
        $result = I('post.name');
        $result1 = I('get.method');
        echo "<pre>";
        print_r($result[0]);
       // print_r($result1);

        echo "</pre>";
    }


}