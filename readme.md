# Settings.json for Laravel
## Installation instructions
1) Install with composer
    ```
    composer require zakhayko/settings
    ```
2) Artisan commands
    ```
    php artisan settings:get
    php artisan settings:get {key}
    php artisan settings:set {key} {value?} (--bool?, --int, --null)
    php artisan settings:forget {key}
    php artisan settings:flush    
    ```
3) Helper functions
    ```php
    settings($key, $default); //Get attribute
    settings([$key1=>$value1]); //Set attribute
    settings(); //Returns Valuestore object
    ```