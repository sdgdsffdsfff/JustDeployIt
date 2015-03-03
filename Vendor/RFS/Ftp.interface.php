<?php

interface FtpInterface
{
    public function __construct();

    public function connect($host, $username, $password, $port = false);
}
