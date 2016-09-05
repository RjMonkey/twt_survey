<?php
class TWTAPIHelper
{
    var $version="1.1.110829";
    var $domain,$api_key,$url;
    function __construct($config)
    {
        $this->url=$config['url'];
        $this->domain=$config['domain'];
        $this->api_key=$config['api_key'];
    }

    function query($method,$postquery,$ref=NULL)
    {
        $curl =curl_init();
        curl_setopt(
            $curl,CURLOPT_URL,
            $this->url."?domain=".$this->domain
        );
        curl_setopt($curl, CURLOPT_REFERER,(isset($ref)?$ref:"#")."<".$_SERVER["REQUEST_URI"]."<".$_SERVER['HTTP_REFERER']."@".$this->version);
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        if(is_array($postquery))
        {
            $tmp='';
            foreach($postquery as $k=>$v)
                $tmp.="&".$k."=".urlencode($v);
            $postquery=$tmp;
        }
        //	$postquery=http_build_query($postquery);
        $postquery.=($postquery==""?"":"&")
            ."api_key=".$this->api_key."&method=".$method;
        //echo $postquery;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postquery);
        $data=curl_exec($curl);
        curl_close($curl);

        //echo "<br>data:".$data;
        $this->last=json_decode($data );
        if($this->last->flag!='1')
            return false;
        return $this->last;
    }

    var $last;
}
?>