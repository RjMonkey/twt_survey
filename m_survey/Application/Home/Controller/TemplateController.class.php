<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
header("content-type:text/html;charset=Utf-8");
 class TemplateController extends Controller
 {
     public function checkbox(){
         $this->display();
     }
     public function items(){
         $this->display();
     }
     public function ChooseTem(){
         $this->display();
     }
     public function Nav_left(){
         $this->display();
     }
     public function navbarTop(){
         $this->display();
     }
     public function QInfo(){
         $this->display();
     }
     public function test(){
         $data = file_get_contents("php://input");
         if(!empty($data)){
             $l['a']=$data;
             M('Test')->add($l);
         }

         echo $data = json_decode($data, TRUE);
     }
 }
 ?>