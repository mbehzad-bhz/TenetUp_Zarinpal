# TenetUp-Zarinpal

In this package, it is easily connected to ZarinPal gateway and you can validate your transactions.

> **NOTE:** These instructions are for the latest version of Laravel.


[![Total Downloads](http://poser.pugx.org/tenetup/zarinpal/downloads)](https://packagist.org/packages/tenetup/zarinpal)
[![License](http://poser.pugx.org/tenetup/zarinpal/license)](https://packagist.org/packages/tenetup/zarinpal)




* [Installation](#installation)
* [Request](#Request)
* [Verification](#Verification)
* [Configuration](#Configuration)
* [Copyright and License](#copyright-and-license)


[![JetBrains](https://tenetup.com/tenetup.png)](https://tenetup.com)
## Installation



1. Install the package via Composer:

    ```sh
    $ composer require tenetup/zarinpal
    ```

3. Register The package in your config/app.php

   A. set in Providers -> TenetUp\Zarinpal\ZarinpalServiceProvider::class,

   B. set in Aliases -> 'zarinpal' => \TenetUp\Zarinpal\ZarinpalFacade::class,

2. Optionally, publish the configuration file if you want to change any defaults:

    ```sh
    php artisan vendor:publish --provider="TenetUp\Zarinpal\ZarinpalServiceProvider"
    ```
> **NOTE:** the configuration filename is "zarinpal.php"

## Request

to make request and send to the zarrinpal

```php
return \zarinpal::createRequest(20000);
```
> **NOTE:** price is required (you must to set your price as toman standard)

full command
```php
return \zarinpal::createRequest(20000 , '091232145687' , 'example@email.com' , 'description');
```
sample response
```php
{
  "Node": "sandbox",
  "Method": "SOAP",
  "Status": 100,
  "Message": "عمليات با موفقيت انجام گرديده است.",
  "StartPay": "https://sandbox.zarinpal.com/pg/StartPay/000000000000000000000000000000592872",
  "Authority": "000000000000000000000000000000592872"
}
```


## Verification

after transaction success or not in your backPaymentURL you must to verify your transaction
>be default zarinpal gateway send you Autority unique code and simply we authorize by this


```php
return \zarinpal::verifyTransAction(20000);
```
> **NOTE:**
> in this method just set the price
> we check your $_GET['authority'] , price and your merchantID with zarinpal
> after that in the response you can handle your proccess


Sample Response
```php
verification success
{
  "Node": "sandbox",
  "Method": "SOAP",
  "Status": 100,
  "Message": "عمليات با موفقيت انجام گرديده است.",
  "Amount": 20000,
  "RefID": 12345678,
  "Authority": "000000000000000000000000000000592907"
}
```
```php
verification failed
{
  "Node": "sandbox",
  "Method": "SOAP",
  "Status": -54,
  "Message": "اتوریتی نامعتبر است",
  "Amount": 20000,
  "RefID": "",
  "Authority": ""
}
```



## Configuration

in the `config/zarinpal` your must to change your merchantID and you can
change your every thing you need, you can set your callBackUrl simply to `route('backPayment')`
```php
return [
    'merchantID' => 'xxxx-xxxx-xxxx-xxx-xxxxx',
    'sandBox' => true,
    'callBackUrl' => 'https://example.com/backPayment',
    'zarinGate' => false,



    'errorList' => [
        "-1" 	=> "اطلاعات ارسال شده ناقص است.",
        "-2" 	=> "IP و يا مرچنت كد پذيرنده صحيح نيست",
        "-3" 	=> "با توجه به محدوديت هاي شاپرك امكان پرداخت با رقم درخواست شده ميسر نمي باشد",
        "-4" 	=> "سطح تاييد پذيرنده پايين تر از سطح نقره اي است.",
        "-9" 	=> "خطای اعتبار سنجی",
        "-10" 	=> "ای پی و يا مرچنت كد پذيرنده صحيح نيست",
        "-11" 	=> "مرچنت کد فعال نیست لطفا با تیم پشتیبانی ما تماس بگیرید",
        "-12" 	=> "تلاش بیش از حد در یک بازه زمانی کوتاه.",
        "-15" 	=> "ترمینال شما به حالت تعلیق در آمده با تیم پشتیبانی تماس بگیرید",
        "-16" 	=> "سطح تاييد پذيرنده پايين تر از سطح نقره اي است.",
        "-21" 	=> "هيچ نوع عمليات مالي براي اين تراكنش يافت نشد",
        "-22" 	=> "تراكنش ناموفق ميباشد",
        "-30" 	=> "اجازه دسترسی به تسویه اشتراکی شناور ندارید",
        "-31" 	=> "حساب بانکی تسویه را به پنل اضافه کنید مقادیر وارد شده واسه تسهیم درست نیست",
        "-32" 	=> "Wages is not valid, Total wages(floating) has been overload max amount.	",
        "-33" 	=> "رقم تراكنش با رقم پرداخت شده مطابقت ندارد",
        "-34" 	=> "سقف تقسيم تراكنش از لحاظ تعداد يا رقم عبور نموده است",
        "-35" 	=> "تعداد افراد دریافت کننده تسهیم بیش از حد مجاز است",
        "-40" 	=> "اجازه دسترسي به متد مربوطه وجود ندارد.",
        "-41" 	=> "اطلاعات ارسال شده مربوط به AdditionalData غيرمعتبر ميباشد.",
        "-42" 	=> "مدت زمان معتبر طول عمر شناسه پرداخت بايد بين 30 دقيه تا 45 روز مي باشد.",
        "-50" 	=> "مبلغ پرداخت شده با مقدار مبلغ در وریفای متفاوت است",
        "-51" 	=> "تراكنش نا موفق ميباشد",
        "-52" 	=> "خطای غیر منتظره با پشتیبانی تماس بگیرید",
        "-53" 	=> "اتوریتی برای این مرچنت کد نیست",
        "-54" 	=> "اتوریتی نامعتبر است",
        "100" 	=> "عمليات با موفقيت انجام گرديده است.",
        "101" 	=> "عمليات پرداخت موفق بوده و قبلا این تراكنش انجام شده است.",
    ]
];
```

by default package set to sandbox and just for testing
if you want to publish your project you must to change `sanbox => false`


## Copyright and License

[tenetup-zarinpal](https://github.com/mbehzad-bhz/tenetup_zarinpal)
was written by [majid behzadnasab](https://github.com/mbehzad-bhz) and [pooria noruzi](https://github.com/pooria-noruzi) and is released under the
[MIT License](LICENSE.md).

Copyright (c) 2021 TenetUp Company
