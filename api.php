<?php


require 'restful_api.php';

class api extends restful_api {

    function __construct(){
        parent::__construct();
    }

    function checkyear(){
        if ($this->method == 'GET'){
            $this->response(200, $this->getyear($this->params));
        }
    }

    function checkptbac2()
    {
        if($this->method == 'GET')
        {
            $this->response(200,$this->getptbac2($this->params));
        }
    }

    function getptbac2($params)
    {
        if(empty($params[0])||empty($params[1])||empty($params[2])||!empty($params[3]))
        {
            return array("status" => false, "data" => array());
        }
        else{
            $a=(double)$params[0];
            $b=(double)$params[1];
            $c=(double)$params[2];
            $denta = $b*$b - 4*$a*$c;
            if($a==0)
            {
                return array("status" => false, "data" => array());
            }
            elseif($denta<0)
            {
                $x1 = null;
                $x2 = null;
                $data = "Phuong trinh vo nghiem";
                return array("status" => true,"data" => array("x1"=>$x1,"x2"=>$x2,"result"=>$data));
            }
            elseif($denta==0)
            {
                $x1 = (double) round(-$b/(2*$a),2);
                $x2 = (double) round(-$b/(2*$a),2);
                $data = "Phuong trinh co nghiem kep";
                return array("status" => true,"data" => array("x1"=>$x1,"x2"=>$x2,"result"=>$data));
            }
            elseif ($denta>0)
            {
                $x1 = (double) round((-$b-sqrt($denta))/(2*$a),2);
                $x2 = (double) round((-$b+sqrt($denta))/(2*$a),2);
                $data = "Phuong trinh vo nghiem";
                return array("status" => true,"data" => array("x1"=>$x1,"x2"=>$x2,"result"=>$data));
            }
        }
    }

    function getyear($params)
    {
        if(empty($params[0])||!empty($params[1]))
        {
            $data = array("status" => false, "data" => array());
            return $data;
        }elseif((double)$params[0]-(int)$params[0]!=0||!(int)$params[0]>0)
        {
            $data = array("status" => false, "data" => array());
            return $data;
        }
        else
        {
            $x = (int)$params[0];
            if ($x % 400 == 0 || $x % 4 == 0 && $x % 100 != 0) {
                $data = array("status" => true, "data" => array("result" => "Nam " . $x . " la nam nhuan"));

            } else {
                $data = array("status" => true, "data" => array("result" => "Nam " . $x . " khong phai la nam nhuan"));
            }
            return $data;
        }
    }
}

$user_api = new api();
