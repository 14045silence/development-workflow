<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends Model_Main{

    protected function get_table_name() {
        return 'user';
    }
    protected function primary() {
        return 'id_user';
    }
    public function get_all_field() {
        $fields = array(                        
              'id_user ' => curtime(), 
              'id_school ' => '19', 
              'email ' => $this->input->post('email'), 
              'role ' => 'user', 
              // 'nama ' => 'HI19-19', 
              // 'dob ' => 'HI19-19', 
              // 'password ' => 'HI19-19', 
              // 'gender ' => 'HI19-19', 
              // 'profile ' => 'HI19-19', 
              
              // 'token_reg ' => 'HI19-19', 
              // 'token_forgot_pass ' => 'HI19-19', 
              // 'level ' => 'HI19-19', 
              // 'address ' => 'HI19-19', 
              // 'facebook_url ' => 'HI19-19', 
              // 'pict_name ' => 'HI19-19', 
              // 'is_subscribe ' => '1', 
              // 'is_valid ' => '1', 
                      
        );
        return $fields;
    }  

}
