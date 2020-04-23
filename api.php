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

    function check()
    {
        if($this->method == 'GET')
        {
            switch($this->params[0])
            {
                case 'loaiTamGiac':{
                    $this->response(200,$this->gettamgiac($this->params));
                }break;
                case 'ngayKeTiep':{
                    $this->response(200,$this->getddmmyyyynext($this->params));
                }break;
                default:{
                    $this->response(200,array("status" => false, "data" => array()));
                }
            }
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
                $data = "Phương trình vô nghiệm";
                return array("status" => true,"data" => array("x1"=>$x1,"x2"=>$x2,"result"=>$data));
            }
            elseif($denta==0)
            {
                $x1 = (double) round(-$b/(2*$a),2);
                $x2 = (double) round(-$b/(2*$a),2);
                $data = "Phương trình nghiệm kép";
                return array("status" => true,"data" => array("x1"=>$x1,"x2"=>$x2,"result"=>$data));
            }
            elseif ($denta>0)
            {
                $x1 = (double) round((-$b-sqrt($denta))/(2*$a),2);
                $x2 = (double) round((-$b+sqrt($denta))/(2*$a),2);
                $data = "Phương trình 2 nghiệm phân biệt";
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
                $data = array("status" => true, "data" => array("result" => "Năm " . $x . " là năm nhuận"));

            } else {
                $data = array("status" => true, "data" => array("result" => "Năm " . $x . " không phải là năm nhuận"));
            }
            return $data;
        }
    }

    function gettamgiac($params)
    {
        if(empty($params[0])||!empty($params[1]))
        {
            $data = array("status" => false, "data" => array());
            return $data;
        }
        else
        {
            // $x = (int)$params[0];
            // if ($x % 400 == 0 || $x % 4 == 0 && $x % 100 != 0) {
            //     $data = array("status" => true, "data" => array("result" => "Năm " . $x . " là năm nhuận"));

            // } else {
            //     $data = array("status" => true, "data" => array("result" => "Năm " . $x . " không phải là năm nhuận"));
            // }
            $a = isset($_GET['a']) ? $_GET['a'] : die();
            $b = isset($_GET['b']) ? $_GET['b'] : die();
            $c = isset($_GET['c']) ? $_GET['c'] : die();
            if($a>0&&$b>0&&$c>0)
            {
                if($a+$b<=$c || $a+$c<=$b ||$c+$b<=$a)
                {
                    $data = array("status" => true, "data" => array("result" => "Đây không phải là tam giác"));
                    return $data;
                }
                else{
                    if((double)round($a*$a,2) == (double)round($b*$b + $c*$c,2))
                    {
                        if($b == $c)
                        {
                            $data = array("status" => true, "data" => array("result" => "Tam giác vuông cân tại a"));
                            return $data;
                        }
                        else{
                            $data = array("status" => true, "data" => array("result" => "Tam giác vuông tại a"));
                            return $data;
                        }
                    }
                    elseif((double)round($b*$b,2) == (double)round($a*$a + $c*$c,2))
                    {
                        if($a == $c)
                        {
                            $data = array("status" => true, "data" => array("result" => "Tam giác vuông cân tại b"));
                            return $data;
                        }
                        else{
                            $data = array("status" => true, "data" => array("result" => "Tam giác vuông tại b"));
                            return $data;
                        }
                    }
                    elseif((double)round($c*$c,2) == (double)round($a*$a + $b*$b,2))
                    {
                        if($a == $b)
                        {
                            $data = array("status" => true, "data" => array("result" => "Tam giác vuông cân tại c"));
                            return $data;
                        }
                        else{
                            $data = array("status" => true, "data" => array("result" => "Tam giác vuông tại c"));
                            return $data;
                        }
                    }
                    elseif($a == $b || $b == $c || $a == $c)
                    {
                        if($a == $b && $a == $c)
                        {
                            $data = array("status" => true, "data" => array("result" => "Tam giác đều"));
                            return $data;
                        }
                        elseif($a == $b){
                            $data = array("status" => true, "data" => array("result" => "Tam giác cân tại c"));
                            return $data;
                        }
                        elseif($a == $c){
                            $data = array("status" => true, "data" => array("result" => "Tam giác cân tại b"));
                            return $data;
                        }
                        elseif($c == $b){
                            $data = array("status" => true, "data" => array("result" => "Tam giác cân tại a"));
                            return $data;
                        }
                    }
                    else {
                        $data = array("status" => true, "data" => array("result" => "Tam giác thường"));
                            return $data;
                    }
                }
            }
            else{
                $data = array("status" => false, "data" => array());
                return $data;
            }
        }
    }

    function getddmmyyyynext($params)
    {
        if(empty($params[0])||!empty($params[1]))
        {
            $data = array("status" => false, "data" => array());
            return $data;
        }
        else
        {
            // $x = (int)$params[0];
            // if ($x % 400 == 0 || $x % 4 == 0 && $x % 100 != 0) {
            //     $data = array("status" => true, "data" => array("result" => "Năm " . $x . " là năm nhuận"));

            // } else {
            //     $data = array("status" => true, "data" => array("result" => "Năm " . $x . " không phải là năm nhuận"));
            // }
            $dd = isset($_GET['ngay']) ? $_GET['ngay'] : die();
            $mm = isset($_GET['thang']) ? $_GET['thang'] : die();
            $yyyy = isset($_GET['nam']) ? $_GET['nam'] : die();
            if((double)$dd -(int)$dd!=0||!(int)$dd>0 || (double)$mm -(int)$mm!=0||!(int)$mm>0 || (double)$yyyy -(int)$yyyy!=0||!(int)$yyyy>0)
            {
                $data = array("status" => false, "data" => array());
                return $data;
            }
            else{
                $checknhuan = false;
                if ($yyyy % 400 == 0 || $yyyy % 4 == 0 && $yyyy % 100 != 0) {
                    //nam nhuan
                    $checknhuan = true;
                } else {
                    //nam khong nhuan
                    $checknhuan = false;
                }
                if($mm == 1 || $mm == 3 || $mm == 5|| $mm == 7|| $mm == 8|| $mm == 10|| $mm == 12)
                {
                    if($dd > 0 && $dd <31)
                    {
                        $dd = $dd + 1;
                        $data = array("status" => true, "data" => array("result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    elseif($dd == 31)
                    {
                        if($mm == 12)
                        {
                            $yyyy = $yyyy+1;
                        }
                        $dd = 1;
                        $mm = $mm%12 + 1;
                        $data = array("status" => true, "data" => array("result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    else{
                        $data = array("status" => false, "data" => array());
                        return $data;
                    }
                }
                elseif($mm == 4 ||$mm == 6||$mm == 9 || $mm == 11)
                {
                    if($dd > 0 && $dd <30)
                    {
                        $dd = $dd + 1;
                        $data = array("status" => true, "data" => array("result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    elseif($dd == 30)
                    {
                        $dd = 1;
                        $mm = $mm%12 + 1;
                        $data = array("status" => true, "data" => array("result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    else{
                        $data = array("status" => false, "data" => array());
                        return $data;
                    }
                }
                elseif($mm == 2)
                {
                    if($checknhuan)
                    {
                        if($dd > 0 && $dd <29)
                    {
                        $dd = $dd + 1;
                        $data = array("status" => true, "data" => array("information" => "Năm " . $yyyy . " là năm nhuận",
                        "result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    elseif($dd == 29)
                    {
                        $dd = 1;
                        $mm = $mm%12 + 1;
                        $data = array("status" => true, "data" => array("information" => "Năm " . $yyyy . " là năm nhuận",
                        "result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    else{
                        $data = array("status" => false, "data" => array());
                        return $data;
                    }
                    }
                    else{
                        if($dd > 0 && $dd <28)
                    {
                        $dd = $dd + 1;
                        $data = array("status" => true, "data" => array("information" => "Năm " . $yyyy . " không phải là năm nhuận",
                        "result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    elseif($dd == 28)
                    {
                        $dd = 1;
                        $mm = $mm%12 + 1;
                        $data = array("status" => true, "data" => array("information" => "Năm " . $yyyy . " không phải là năm nhuận",
                        "result" => "Ngày kế tiếp là ngày ".$dd." tháng ".$mm." năm ".$yyyy));
                        return $data;
                    }
                    else{
                        $data = array("status" => false, "data" => array());
                        return $data;
                    }
                    }
                }
            }
        }
    }
}

$user_api = new api();
