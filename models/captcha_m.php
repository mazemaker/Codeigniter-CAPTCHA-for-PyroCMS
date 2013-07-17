<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Codeigniter CAPTCHA for PyroCMS 2.2.1
 * 
 * @version    v1.0.0
 * @author     Kingsley Chan
 * @license    MIT License
 * @copyright  2013 Web Concept (http://wcept.com)
 */

class Captcha_m extends MY_Model
{
    public function insert_captcha($data = array()){
        if(!empty($data)){
            return $this->db->insert('wcept_captcha', $data);
        }
        
        return false;
    }
    
    public function captcha_exists($captcha = '', $ip = '', $time = 0){
        if($time == 0){
            $time = time();
        }
        
        $captcha_count = $this->db->where('word', $captcha)
                ->where('ip_address', $ip)
                ->where('captcha_time >', $time)
                ->count_all_results('wcept_captcha');
        
        return ($captcha_count == 1);
    }
    
    public function remove_captcha($time = 0){
        return $this->db->delete('wcept_captcha', array( 'captcha_time <' => $time));
    }
}