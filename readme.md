# Api Response

## نصب
برای نصب پکیج ابتدا کد زیر را در فایل composer.json و در بخش require قرار دهید:
```json
"require": {
    "comma/api-response": "dev-master"
},
```

در مرحله بعد این خط کد را در فایل composer.json و در بخش repositories قرار دهید.

```json
"repositories": [
    {
        "type": "vcs",
        "url":  "https://gitlab.aanplatform.com/comma/api-response.git"
    }
],
```

در نهایت پس از اعمال تغییرات در فایل composer.json ، از دستور زیر برای نصب پکیج استفاده کنید.

```bash
composer update
```
یا 
```bash
composer install
```


پس از نصب کامل پکیج، با استفاده از دستور زیر فایل های پکیج را نصب کنید.

```bash
php artisan vendor:publish
```

نصب پکیج با موفقیت انجام شد.


حال در فایل Handler.php کد زیر را اضافه کنید:

```php
<?php

    namespace App\Exceptions;

    public function render($request, Throwable $e)
    {
        if ($request->wantsJson()) {   //add Accept: application/json in request
            return ApiResponse::render($request,$e);
        } else {
            $retval = parent::render($request, $e);
        }
        return $retval;
    }

```

و برای خروجی های وب سرویس خود از کد زیر استفاده کنید:

```php
<?php

    use Raahin\ApiResponse\Facade\ApiResponse;
    
    return ApiResponse::BaseAnswer(data,status_code);
```


