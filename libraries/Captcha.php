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
            ci()->load->model('captcha/captcha_m');
            
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
            
            ci()->captcha_m->insert_captcha($data);

            return $cap;
        }
        
        public static function remove($expire = 0){
            return ci()->captcha_m->remove_captcha($expire);
        }
        
        public static function exists($captcha = '', $ip = '', $time = 0){
            return ci()->captcha_m->captcha_exists($captcha, trim($ip), $time);
        }

}

/* End of file Captcha.php */
