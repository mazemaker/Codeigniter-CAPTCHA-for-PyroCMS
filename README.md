Codeigniter CAPTCHA for PyroCMS 2.2.1
=========

This module includes a Captcha Library (based on [Codeigniter Captcha](http://www.ellislab.com/codeigniter/user-guide/helpers/captcha_helper.html))


##1. Generate CAPTCHA
```php
    Captcha::get(); // returns [Array] create_captcha($data)

```

##2. Check if the CAPTCHA exists
```php
    Captcha::exists($captcha = '', $ip = '', $time = 0) // [boolean]
```

##3. Remove expired CAPTCHA rows in database
```php
    CAPTCHA::remove($expire = 0); // return [boolean] 
```

By [Web Concept](http://wcept.com)
