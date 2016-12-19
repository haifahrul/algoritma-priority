@TITLE Billing Veboo
@ECHO ---------------------------------------------------
@ECHO --- SEND SMS TO CUSTOMER FOR SERVICE MOTORCYCLE ---
@ECHO --- EVERY 1 MONTH ---------------------------------
@ECHO ---------------------------------------------------

@ECHO Sending SMS, Please wait...
@setlocal

@set YII_PATH=C:\server\www\topik\

@if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

@"%PHP_COMMAND%" "%YII_PATH%yii" %send-sms

@endlocal