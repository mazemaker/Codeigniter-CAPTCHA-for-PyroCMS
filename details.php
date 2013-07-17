<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Codeigniter CAPTCHA for PyroCMS
 * 
 * @version    v1.0.0
 * @author     Kingsley Chan
 * @license    MIT License
 * @copyright  2013 Web Concept (http://wcept.com)
 */

class Module_Captcha extends Module
{
	public $version = '1.0.0';

	public function info()
	{
		$info = array(
                    'name' => array(
                        'en' => 'CAPTCHA',
                    ),
                    'description' => array(
                        'en' => 'CAPTCHA module',
                    ),
                    'frontend' => false,
                    'backend' => false,
                    'menu' => false,
		);
	
		return $info;
	}

	public function install()
	{
            $this->dbforge->drop_table('wcept_captcha');
            
            $tables = array(
                'wcept_captcha' => array(
                    'captcha_id' => array('type' => 'BIGINT', 'constraint' => 13, 'auto_increment' => true, 'primary' => true,),
                    'captcha_time' => array('type' => 'INT', 'constraint' => 11, 'default' => '0', 'null' => false),
                    'ip_address' => array('type' => 'VARCHAR', 'constraint' => 16, 'default' => '0', 'null' => false),
                    'word' => array('type' => 'VARCHAR', 'constraint' => 20, 'null' => false, 'key' => true)
                ),
            );

            if ( ! $this->install_tables($tables))
            {
                    return false;
            }
            
            return true;
	}

	public function uninstall()
	{
            return true;
	}

	public function upgrade($old_version)
	{
		return true;
	}

}
