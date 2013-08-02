<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Codeigniter CAPTCHA for PyroCMS 2.2.1
 * 
 * @version    v1.0.0
 * @author     Kingsley Chan
 * @license    MIT License
 * @copyright  2013 Web Concept (http://wcept.com)
 */

class Captcha {
    
	public function __construct()
	{
            ci()->load->helper('captcha');
            
            if(!ci()->db->table_exists('wcept_captcha')){
                self::_create_table();
            }
            
            if(is_dir(FCPATH.'tmp') && is_writable(FCPATH.'tmp')){
                define("_WCEPT_TEMP_PATH_", FCPATH.'tmp/');
                define("_WCEPT_TEMP_URL_", BASE_URL.'tmp/');
            }else if(!is_dir(FCPATH.'tmp')){
                mkdir(FCPATH.'tmp', 0777);
                
                define("_WCEPT_TEMP_PATH_", FCPATH.'tmp/');
                define("_WCEPT_TEMP_URL_", BASE_URL.'tmp/');
            }
            
            if(!is_dir(_WCEPT_TEMP_PATH_.'captcha')){
                mkdir(_WCEPT_TEMP_PATH_.'captcha', 0777);
            }
            
		//self::get_all();
	}
        
        public static function get(){
            $vals = array(
                'img_path' => _WCEPT_TEMP_PATH_.'captcha/',
                'img_url' => _WCEPT_TEMP_URL_.'captcha/',
                'img_width' => '180',
                'img_height' => '36'
                );

            $cap = create_captcha($vals);

            $data = array(
                'captcha_time' => $cap['time'],
                'ip_address' => trim(ci()->input->ip_address()),
                'word' => $cap['word']
                );
            
            self::_insert_captcha($data);

            return $cap;
        }
        
        public static function remove($expire = 0){
            return self::_remove_captcha($expire);
        }
        
        public static function exists($captcha = '', $ip = '', $time = 0){
            return self::_captcha_exists($captcha, trim($ip), $time);
        }
        
    public function _insert_captcha($data = array()){
        if(!empty($data)){
            return ci()->db->insert('wcept_captcha', $data);
        }
        
        return false;
    }
    
    public function _captcha_exists($captcha = '', $ip = '', $time = 0){
        if($time == 0){
            $time = time();
        }
        
        $captcha_count = ci()->db->where('word', $captcha)
                ->where('ip_address', $ip)
                ->where('captcha_time >', $time)
                ->count_all_results('wcept_captcha');
        
        return ($captcha_count == 1);
    }
    
    public function _remove_captcha($time = 0){
        return ci()->db->delete('wcept_captcha', array( 'captcha_time <' => $time));
    }
    
    function _create_table(){
        $columns = array(
            'captcha_id' => array('type' => 'BIGINT', 'constraint' => 13, 'auto_increment' => true, 'primary' => true,),
            'captcha_time' => array('type' => 'INT', 'constraint' => 11, 'default' => '0', 'null' => false),
            'ip_address' => array('type' => 'VARCHAR', 'constraint' => 16, 'default' => '0', 'null' => false),
            'word' => array('type' => 'VARCHAR', 'constraint' => 20, 'null' => false, 'key' => true)
        );
        
        ci()->load->dbforge();
        
        ci()->dbforge->add_field($columns);
        ci()->dbforge->add_key('captcha_id', TRUE);
        ci()->dbforge->create_table('wcept_captcha', TRUE);
    }
}

/* End of file Captcha.php */
