Codeigniter CAPTCHA Library for PyroCMS 2.2.1
=========

This library generates Captcha with Codeigniter Captcha Helper ([Codeigniter Captcha Helper](http://www.ellislab.com/codeigniter/user-guide/helpers/captcha_helper.html))

##1. Load the library
```php
    $this->load->library('captcha');
```

##2. Generate CAPTCHA
```php
    Captcha::get(); // return [Array] create_captcha($data)
```

##3. Check if the CAPTCHA exists
```php
    Captcha::exists($captcha = '', $ip = '', $time = 0) // return [boolean]
```

##4. Remove expired CAPTCHA rows in database
```php
    Captcha::remove($expire = 0); // return [boolean]
```


By [Web Concept](http://wcept.com)
