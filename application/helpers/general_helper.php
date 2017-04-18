<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function pricing($var)
    {
    	$var = str_replace(',', '', $var);
        if (is_numeric($var)) {
            return number_format($var,0,",",".");
        }
        throw new \Exception("Invalid number to format: $var");
    } 
    function curtime(){
        $no=date('Y-m-d-H-i-s');
        list($y,$m,$d,$h,$i,$s)=explode('-', $no);
        return $d."".$i."".$s;
    }  
    function tanggal($var){
        $no=date('Y-m-d-H-i-s');
        list($y,$m,$d,$h,$i,$s)=explode('-', $no);
        return $d."".$m."".$s;
    }  
    function dates($param){
        list($tanggal,$jam)=explode(' ', $param);
        $newDate = date("d-m-Y", strtotime($tanggal));
        return $newDate." Jam ".$jam;
    }
    function pajak($value){
        $percentage=5;
        $total=$value;
        $calculate=($percentage/100)*$value;
        return $calculate;
    }
    function subs($value){
        $word=strlen($value);
        if ($word > 15) {
            return substr($value,0,15)."..";
        }
        else{
            return $value;
        }
    }
    function form_bootstrap($identifier,$label,$name,$value=""){        
        $sprint='';
        if ($identifier==='text') {
            $type="text";
            $sprint='t';
        }
        elseif ($identifier==='email') {
            $type="email";
            $sprint='t';
        }
        elseif ($identifier==='password') {
            $type="password";
            $sprint='p';
        }
        elseif ($identifier==='hidden') {
            $type="hidden";
            $sprint='h';
        }
        elseif ($identifier==='area') {
            $type="";
            $sprint='a';
        }
        $data = array(
            'type'  => $type,
            'name'  => $name,
            //'id'    => 'hiddenemail',
            'value' => $value,
            'class' => 'form-control'
        );

        if ($sprint=='t') {
            return
            "
            <div class='form-group'>
                <label class='control-label col-md-3'>".$label."</label>
                    <div class='col-md-9'>
                        ".form_input($data)."              
                        <span class='help-block'></span>
                    </div>                            
            </div>
            ";
        }
        elseif ($sprint=='a') {
            return
            "
            <div class='form-group'>
                <label class='control-label col-md-3'>".$label."</label>
                    <div class='col-md-9'>
                        ".form_textarea($data)."              
                        <span class='help-block'></span>
                    </div>                            
            </div>
            ";
        }
        elseif ($sprint=='p') {
            return
            "
            <div class='form-group'>
                <label class='control-label col-md-3'>".$label."</label>
                    <div class='col-md-9'>
                        ".form_password($data)."              
                        <span class='help-block'></span>
                    </div>                            
            </div>
            ";
        }
        elseif ($sprint=='h') {
            return
            "
            <div class='form-group'>
                <label class='control-label col-md-3'>".$label."</label>
                    <div class='col-md-9'>
                        <input type='hidden' name='".$name."' value=".$value.">
                        <span class='help-block'></span>
                    </div>                            
            </div>
            ";
        }
    }
    
    function kelamin(){
        $option = array(
            'L' => 'Laki-laki', 
            'P' => 'Perempuan', 
        );
        return $option;
    }

    function drop_bootstrap($label,$name,$option=array()){        
        $x='class="form-control"';
        return
            "
            <div class='form-group'>
                <label class='control-label col-md-3'>".$label."</label>
                    <div class='col-md-9'>
                        ".form_dropdown($name, $option,'',$x)."              
                        <span class='help-block'></span>
                    </div>                            
            </div>
            ";
    }
    

}