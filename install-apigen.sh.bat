rem downloads the apigen distribution because installation via packagist turned out to be unreliable
rem going via %TEMP% because bitsadmin wants and absolute path.
bitsadmin /transfer apiGen /priority normal http://apigen.org/apigen.phar %TEMP%\apigen.phar
move /Y %TEMP%\apigen.phar ./
