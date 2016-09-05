<?php
return array(
	//'配置项'=>'配置值'

   'DEFAULT_MODULE'       =>    'Home',
  
    //点语法默认解析
    //如果方法向模板传递的都是数组，
    //可以进行一下设置，加快运行速度：
    'TMPL_VAR_IDENTIFY' => 'array',

    

    //开发人员调试信息
   // "SHOW_ERROR_MSG"=>true,       //显示具体的错误信息了

    //'ERROR_MESSAGE' =>'发生错误！'    //设置之后，所有的异常页面只会显示“发生错误！”这样的提示信息

    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8





    //数据库连接信息
     'DB_TYPE'               =>  'mysql',     // 数据库类型
     'DB_HOST'               =>  'localhost', // 服务器地址
     'DB_NAME'               =>  'wenjuan',          // 数据库名
     'DB_USER'               =>  'root',      // 用户名
     'DB_PWD'                =>  '',          // 密码







      //设置全局过滤方法
     'DEFAULT_FILTER'        =>  'strip_tags,stripslashes,htmlspecialchars',

    //'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息



 //'TMPL_L_DELIM' => '<{', // 模板引擎普通标签开始标记
    //'TMPL_R_DELIM' => '}>', // 模板引擎普通标签结束标记


//'配置项'=>'配置值'
        // 'URL_MODEL' =>1,    //开启路由
        // 'URL_ROUTER_ON' => true,    //路由规则
        // 'URL_ROUTE_RULES' => array(
        // '/^index$/'           =>    'Index/index',
        // '/^about$/'           =>    'About/index', 
        // // feel 对应列表页
        // // feel/page/2 对应分页
        // // feel-2 对应详情
        // '/^feel$/'              =>  'Feel/index',
        // '/^feel\/page\/(\d{1,})$/'  =>  'Feel/index?page=:1',
        // '/^feel-(\d{1,})$/'     =>  'Feel/index?id=:1',
        // '/^gustbook$/'          =>  'Gustbook/index',
        // '/^gustbook\/(\d{1,})$/'    =>  'Gustbook/index?page=:1',
        // '/^album-(\d{1,5})$/'   =>  'Album/look?id=:1',
        // '/^album$/'             =>  'Album/index',
        // '/^class-(\d{1,})\/page\/(\d{1,})$/'        =>  'Class/index?id=:1&page=:2',
        // '/^class-(\d)$/'        =>  'Class/index?id=:1',
        // '/^fill-(\d{1,5})$/' =>  'Fill/index?id=:1',    //向FiLLController 传递参数

        // ),
//    'show_page_trace'=>false,
  );

