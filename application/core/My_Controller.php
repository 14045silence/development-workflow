<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Controller extends CI_Controller{
    public $size=0;
    public $site="Moeblo Furniture";
    public $get_lang="";
    function __construct(){
        parent::__construct();
        $this->load->model('Menu','menu');
        $this->load->model('Collection_model','collection');
        //$this->load->model('Socmed_model','sosmed');
        $this->load->model('Article','blog');
        $this->load->model('User_model','Auth');
        $sesi=$this->session->userdata('user');
        if ($sesi==TRUE) {
            if (!$this->Auth->isExist('id_user',$sesi)) {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }

        // $ip = $this->input->ip_address();
        // $this->db->insert('counting',array('ip' => "$ip", 'date' => date('Y-m-d')));

        $this->load->helper('cookie');
        $id=base_url(uri_string());
        //$check_visitor = $this->input->cookie(urldecode($id), FALSE);
        $ip = $this->input->ip_address();
        // if ($check_visitor == false) {
        //     $c = array(
        //         "name" => base_url(uri_string()),
        //         "value" => "$ip",
        //         "expire" => time() + 7200,
        //         "date_modified" => $this->timenow(),
        //         "browser" => $this->getBrowser(),
        //         );
        //     $this->input->set_cookie($c);

            
        //     $this->db->insert('counting',$c);          
        // }
        //$this->session->set_userdata('lang','id');
        $lang=$this->session->userdata('lang');
        if ($lang=="") {
            $lang='id';
            $this->get_lang=$lang;
        }
        else{
            $lang=$lang;
            $this->get_lang=$lang;
        }
        
    }
    function bahasa(){
        return $this->get_lang;
    }

    function unique(){

    }
    protected function _dir_img(){
      // local adi
      //return "http://localhost/src.moeblofurniture.com/uploads/";
      return "http://localhost/moeblo/uploads/";
      //return "http://192.168.43.203/moeblo/uploads/";
      //return "https://src.moeblofurniture.com/uploads/";
    }
    function is_connected(){
        $connected=@fsockopen("www.google.com",80);
        if ($connected) {
          $is_conn=TRUE;
          fclose($connected);
        }
        else{
          $is_conn=FALSE;
        }
        return $is_conn;
      }
    function set_title($param){
        $data['title']=$param;
        return $data;
    }
    protected function alert($msg,$stat=FALSE){
        $this->load->model('User_model','Auth');

        return "<div class='col-sm-12 alert alert-danger text-center' role='alert'>
                ".$msg."
                </div>";
    }
    protected function _is_activate(){
        if ($this->_get_session()) {
            $sesi=$this->session->userdata('user');
            if ($this->Auth->specific_view('is_confirm',$sesi)==='1') {
                return $this->alert("<div class='col-sm-12 alert alert-danger text-center' role='alert'>
                Lakukan aktivasi akun anda melalui email.
                </div>");
                //return TRUE;
            }
            else{
                return FALSE;
            }

        }
    }
    protected function information(){
        $lang=$this->session->userdata('lang');
        if ($lang==FALSE) {
            $lang='id';
        }
        else{
            $lang=$this->session->userdata('lang');
        }
        $this->lang->load('content',$lang==''? 'id' : $lang);
        $this->load->model('Product');
        $this->load->model('Menu','menu');
        $this->load->model('Socmed_model','sosmed');
        $this->load->model('Type_model','type');
        $this->load->model('Pages_model','page');
        $this->load->model('Product_collection_model','collection_product');
        $this->load->model('Promo_model');
        
        $title="";$alert="";$myorder="";

        if ($this->_get_session()) {
            $this->load->model('Order_model','order');
            $this->load->library('encrypt');
            $sesi=$this->session->userdata('user');
            $salt=$this->Auth->specific_view('salt',$this->user_session());
            if ($this->Auth->specific_view('is_confirm',$sesi)!=='1') {
                $alert="<div class='col-sm-12 alert alert-danger text-center navbar-inverse navbar-fixed-top' role='alert'>Lakukan aktivasi akun anda melalui email. <a href='".base_url()."account/resend?utm=reff&utf=".strtotime($this->timenow())."&id=".$this->user_session()."&s=".$this->encrypt->encode($salt)."'>Resend activation key</a></div>";

            }
            $myorder=$this->order->count_by('id_user',$this->user_session());
        }
        //echo $this->lang->line('message');
        $data = array(
            'lang'=> $lang,
            'title' => 'Moeblo Furniture',
            'og_title' => 'Moeblo, untuk anda yang mengutamakan kesempurnaan, menyediakan berbagai macam furniture dan aksesoris bergaya kontemporer dan elegan.',
            'alert' => $alert,
            'title_og' => 'Jual beli furniture Salatiga',
            'my_order' => $myorder,
            'url'=>base_url(uri_string()),
            'title_rekomendasi' => $title,
            'parent_menu' => $this->menu->get_parent_menu(),
            //'parent_menu' => $this->menu->get_parent_menu_tag(),
            'column' => $this->menu->header_column(),
            'socmed' => $this->sosmed->get_by('shows',1),
            'dir' => $this->_dir_img(),
            'koleksi' => $this->collection->get_collect(),
            'type' => $this->type->get_all(),
            'srcval' => $this->page->get_by('category','Category'),
            'blogs' => $this->blog->articles(),
            'phone' => $this->sosmed->specific_column('the_value_is','id',2),
            'email' => $this->sosmed->specific_column('the_value_is','id',5),
            'message' => $this->lang->line('message'),
            'popular_search' => $this->Product->popular_search(),
            'role'=>'home',
            );

        static $module = 0;
        $data['banners'] = array();
        $banners = $this->Product->product_and_media_res_array(0);
        foreach ($banners as $banner) {
                if ($banner['filename_thumb']=='') {
                    $src=$this->_dir_img()."default.jpg";
                }
                else{
                    $src=$this->_dir_img()."".$banner['filename_thumb'];
                }
                $data['banners'][] = array(
                    'id_product' => $banner['id_product'],
                    'src' => $src,
                    'url'=>$banner['url'],
                    'product' => subs($banner['product_name']),
                    'price' => "Rp ".pricing($banner['price']),
                );
        }
        $data['module'] = $module++;


        static $modules = 0;
        $data['banners'] = array();
        $banners = $this->Product->product_and_media_res_array(0);
        foreach ($banners as $banner) {
                if ($banner['filename_thumb']=='') {
                    $src=$this->_dir_img()."default.jpg";
                }
                else{
                    $src=$this->_dir_img()."".$banner['filename_thumb'];
                }
                $data['banners'][] = array(
                    'id_product' => $banner['id_product'],
                    'src' => $src,
                    'url'=>$banner['url'],
                    'product' => subs($banner['product_name']),
                    'price' => "Rp ".pricing($banner['price']),
                );
        }
        $data['modules'] = $modules++;
        return $data;
    }
    protected function user_session(){
        return $this->session->userdata('user');
    }
    function recomendation(){
        $this->load->model('Product');
        static $module = 0;

        $data['banners'] = array();

        $banners = $this->Product->product_and_media_res_array(0);

        foreach ($banners as $banner) {
                if ($banner['filename_thumb']=='') {
                    $src=$this->_dir_img()."default.jpg";
                }
                else{
                    $src=$this->_dir_img()."".$banner['filename_thumb'];
                }
                $data['banners'][] = array(
                    'src' => $src,
                    'product' => subs($banner['product_name']),
                    'price' => "Rp ".pricing($banner['price']),
                );
        }

        $data['module'] = $module++;
        return $data;
    }
    protected function _get_session(){
        if ($this->session->userdata('user')==TRUE) {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    protected function input($var){
        return $this->input->post($var,TRUE);
    }
    protected function timenow() {
        return date('Y-m-d H:i:s');
    }

    protected function _template(){
    	return "admin/template/core";
    }

    protected function _views($dir){
    	return $this->dir()."/".$dir;
    }

    function _dropdown_select($dropdown_array,$name,$array_values,$selected_value){
        $dropdown_array = form_dropdown($name, $array_values, $selected_value,array('class' =>'form-control' ));
        return $dropdown_array;
    }
    protected function notification($msg,$param){
        $data['message']=$msg;
        $data['param']=$param;
        return json_encode($this->load->view('admin/template/notification',$data));
    }
    protected function is_unique_address($id){
        $this->load->helper('cookie');
        $check_visitor = $this->input->cookie(urldecode($id), FALSE);
        $ip = $this->input->ip_address();
        if ($check_visitor == false) {
            $cookie = array(
                "name" => urldecode($id),
                "value" => "$ip",
                "expire" => time() + 7200,
                "date_modified" => $this->timenow(),
                "browser" => $this->getBrowser(),
                );
            $this->input->set_cookie($cookie);

            $this->db->insert('visitor_tracking',$cookie);
            $this->load->model('Product','product');
            $this->product->boost('page_views',$id);
        }
    }
    function getBrowser(){

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $name = 'NA';


        if (preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
            $name = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $agent)) {
            $name = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $agent)) {
            $name = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $agent)) {
            $name = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $agent)) {
            $name = 'Opera';
        } elseif (preg_match('/Netscape/i', $agent)) {
            $name = 'Netscape';
        }


        return $name;

    }
    function redirect($msg){
        echo "
            <link href='css/font-awesome.min.css' rel='stylesheet'>
            <style type='text/css'>
                .container {
                  padding-right: 15px;
                  padding-left: 15px;
                  margin-right: auto;
                  margin-left: auto;
              }
              .text-center {
                  text-align: center;
              }
              body {
                font-family: 'Roboto', sans-serif;
                background: ;
                position: relative;
                font-weight: 400px;
            }
            </style>
                <div class='container text-center'>
                    <div>
                     <br><br><br>
                     <a href='index.html'><img src='http://moeblofurniture.com/images/logo.png' alt=''></a>
                    </div>
                 <div><br><br>
                    ".$msg."
                    <i class='fa fa-5x fa-clock-o fa-fw fa-spin'></i><h3><br><b>Tunggu Sebentar.</b><br>Kami antar anda ke halaman selanjutnya.</h3>
                    <p>Klik tautan ini jika browser anda tidak mengantarkan anda ke <a href='htpps://moeblofurniture.com'>halaman selanjutnya.</a>
                    </p>
                </div>
            </div>
        ";
        echo "<script>";
        echo "setTimeout(function(){";
        echo 'window.location="';
        echo base_url();
        echo '"';
        echo "},2000)";
        echo "</script>";
    }

    protected function order_number($length = 12, $specialCharacters = true) {
        $digits = '';
        $chars = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        $date=date('yMd');
        $numb="23456789";

        if($specialCharacters === true)
            $chars .= $numb ;


        for($i = 0; $i < $length; $i++) {
            $x = mt_rand(0, strlen($chars) -1);
            $digits .= $chars{$x} ;
        }

        return $digits;
    }

    protected function cache_get($name=NULL,$value=NULL){
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        if ( ! $foo = $this->cache->get($name))
        {
                //echo 'Saving to the cache!<br />';
                $foo = $value;
                $this->cache->save($name, $foo, 0);
        }

        return $foo;
    }
    protected function cache_delete($name){
        return $this->output->delete_cache('/'.$name);
    }

    protected function sendmail($title,$subject,$to,$msg,$msgsuccess,$redir){
        $this->load->library('email');
        $this->email->from('info@moeblofurniture.com',$title);
        $this->email->subject($subject);
        $this->email->to($to);
        $this->email->message($msg);

        if ($this->email->send()) {
            $this->session->set_flashdata('success', $msgsuccess);
            redirect($redir);
        } else {
            $this->redirect("Email not sent.");
        }
    }

    protected function sendmailnored($title,$subject,$to,$msg){
        $this->load->library('email');
        $this->email->from('info@moeblofurniture.com',$title);
        $this->email->subject($subject);
        $this->email->to($to);
        $this->email->message($msg);

        if ($this->email->send()) {
            //$this->session->set_flashdata('success', $msgsuccess);
            //redirect($redir);
        } else {
            $this->redirect("Email not sent.");
        }
    }

    protected function sendmail_order($title,$subject,$to,$msg,$msgsuccess){
        $this->load->library('email');
        $this->email->from('info@moeblofurniture.com',$title);
        $this->email->subject($subject);
        $this->email->to($to);
        $this->email->message($msg);

        if ($this->email->send()) {
            return TRUE;
        } else {
            $this->redirect("Email not sent.");
        }
    }
    protected function pages(){
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        return $config;
    }
}
