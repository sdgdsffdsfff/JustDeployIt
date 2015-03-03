<?php
include_once 'Ftp.php';

class FtpFactory
{
    public static function create($connection_type)
    {
        switch($connection_type) {
        case 'ftp':
            $oFtp = new Ftp();
            break;
        case 'sftp':
            $oFtp = new Sftp();
            break;
        default:
            throw new Exception(
                'No connection type set cannot choose a method to connect');
        }

        // Potential follow-up construction steps
        return $oFtp;
    }
}
?>
