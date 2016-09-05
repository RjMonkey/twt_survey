<?php
namespace Home\Controller;
use Think\Controller;

header("content-type:text/html;charset=Utf-8");
 class PostJsonController extends Controller
 {

     public function index(){

         $this->display();
     }
     public function createQ(){
         $data['a'] = file_get_contents("php://input");
         if(!empty($data)){
             M('test')->add($data);
             echo $data = json_decode($data, TRUE);
         }


     }
 }
 ?>