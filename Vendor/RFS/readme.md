# RFS #

FS == RemoteFileSystem

处理远端文件系统，目前支持FTP、SFTP。

[工厂模式参考][1]

[FTP类参考][2]
[FTP类参考][6]

## How to use ##

In order to use the new system, you hit up the factory for an instance and go from there

```php
// get an instance of the Ftp class
$ftp  = PhpFtpFactory::create('ftp');

// get an instance of the Sftp class 
$sftp = PhpFtpFactory::create('sftp');
```

Either of these instances support all the PhpFtp functions because they implement the interface! This also gives you the ability to write polymorphic code as well. Consider a function that type-hints against the interface

```php
// This is polymorphic code
function doFtpStuff(PhpFtp $oFtp) {
   // As mentioned above $oFtp can be an instance of any class that implements PhpFtp
   $oFtp->connect();
   $oFtp->pwd();
}
```



[1]: http://stackoverflow.com/questions/14328299/php-ftp-sftp-switch-class
[2]: https://github.com/emeth-/php-ftp
[3]: https://github.com/Mahlstrom/Remote
[4]: https://github.com/touki653/php-ftp-wrapper
[5]: http://www.phpclasses.org/package/5601-PHP-Synchronize-two-hosts-via-FTP.html
