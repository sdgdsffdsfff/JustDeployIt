<?php
include_once 'BaseFtp.abstract.php';

class Ftp extends BaseFtp
{
    const MODE_AUTO = 4;
    /**
     * Ftp mode
     *
     * @var int
     */
    protected $_mode = self::MODE_AUTO;

    /**
     * Ftp resource when conection established
     * @var resource
     */
    protected $_resource;

    /**
     * ASCII file extensions
     *
     * @var array
     */
    protected $_ascii = array(
        'htm', 'html', 'shtml', 'php', 'txt', 'py', 'cgi', 'js', 'cnf',
        'css', 'forward', 'htaccess', 'map', 'pwd', 'pl', 'grp', 'ctl'
    );

    /**
     * Blacklist
     *
     * @var array
     */
    protected $_blackList = array();

    /**
     * Remote files
     *
     * @var array
     */
    protected $_remoteFiles = array();

    public function __construct(){}

    public function __destruct() {
        ftp_close($this->_resource);
    }

    /**
     * 连接并登录到服务器
     *
     * @param     $host
     * @param     $username
     * @param     $password
     * @param int $port
     *
     * @throws Exception
     */
    public function connect($host, $username, $password, $port=21)
    {
        if (!extension_loaded('ftp')) {
            throw new Exception('Ftp extension is not enabled for PHP.');
        }
        try{
            $this->_connect($host, $port)->_login($username, $password);
        } catch(Exception $e) {
            throw $e;
        }
        $this->_init();
    }

    /**
     * Initialization
     */
    protected function _init(){}

    /**
     * _getRemoteFileExt
     *
     * @param string $remoteFile
     * @return string|boolean
     */
    protected function _getRemoteFileExt($remoteFile)
    {
        for($i=strlen($remoteFile)-2; $i >= 0; $i--){
            if(substr($remoteFile, $i, 1) == '.'){
                $ext = substr($remoteFile, ++$i);
                return $ext;
            }
        }
        return false;
    }

    /**
     * Authenticates to the server
     *
     * @param $username
     * @param $password
     *
     * @return bool
     * @throws Exception
     */
    protected function _login($username, $password)
    {
        $login = ftp_login($this->_resource, $username, $password);

        if(!$login){
            throw new Exception("Could not login as $username");
        }
        return true;
    }

    /**
     * Connects to ftp server
     *
     * @access protected
     * @param  host
     * @param  int ftp port
     * @return Ftp
     * @throws Exception
     */
    protected function _connect($host, $port = 21)
    {
        if(is_null($this->_resource)){
            $ftp = ftp_connect($host, $port);//connect to ftp server
            if(!$ftp){
                throw new Exception("Unable to connect to ftp server");
            }else{
                $this->_resource = $ftp;
                //$this->setPassive(true);
            }
        }

        return $this;
    }

    /**
     * setMode
     *
     * @param  $mode
     * @return Ftp
     */
    public function setMode($mode)
    {
        if ($mode != FTP_BINARY && $mode != FTP_ASCII && $mode != self::MODE_AUTO) {
            throw new InvalidArgumentException(
                'Only FTP_ASCII, FTP_BINARY and Ftp::MODE_AUTO is valid'
            );
        }
        $this->_mode = $mode;
        return $this;
    }

    /**
     * Turn passive mode on/off
     *
     * @param $value
     *
     * @return $this
     * @throws Exception
     */
    public function setPassive($value)
    {
        $result = ftp_pasv($this->_resource, $value);
        if(!$result){
            throw new Exception("Passive mode can not be enabled");
        }
        return $this;
    }

    /**
     * Gets present working directory
     *
     * @access public
     * @return string current directory
     */
    public function pwd()
    {
        return ftp_pwd($this->_resource);
    }

    /**
     * Gets file modified time on the server
     *
     * @param mixed $remoteFile
     * @return int
     */
    public function mtime($remoteFile)
    {
        return ftp_mdtm($this->_resource, $remoteFile);
    }

    /**
     * Changes current directory
     *
     * @param $dirname
     * @access public
     * @return boolean
     */
    public function chdir($dirname)
    {
        return @ftp_chdir($this->_resource, $dirname);
    }

    /**
     * Closes FTP stream
     *
     * @access public
     * @return boolean
     */
    public function close()
    {
        return ftp_close($this->_resource);
    }

    /**
     * Uploads a file to the server
     *
     * @param string $remoteFile
     * @param string $localFile
     * @return boolean
     */
    public function put($remoteFile, $localFile)
    {
        if ($this->_mode === self::MODE_AUTO) {
            $info = pathinfo($localFile);
            if (in_array($info['extension'], $this->_ascii)) {
                $mode = FTP_ASCII;
            }else{
                $mode = FTP_BINARY;
            }
        }else{
            $mode = $this->_mode;
        }
        return @ftp_put($this->_resource, $remoteFile, $localFile, $mode);
    }

    /**
     * Downloads a file from the server
     *
     * @param string $localFile
     * @param string $remoteFile
     * @return boolean
     */
    public function get($localFile, $remoteFile)
    {
        if ($this->_mode === self::MODE_AUTO) {
            $remExt = $this->_getRemoteFileExt($remoteFile);
            if (in_array($remExt, $this->_ascii)) {
                $mode = FTP_ASCII;
            }else{
                $mode = FTP_BINARY;
            }
        }else{
            $mode = $this->_mode;
        }
        return @ftp_get($this->_resource, $localFile, $remoteFile, $mode);
    }

    /**
     * Gets the remote file's size
     *
     * @param string $remoteFile
     * @return int
     */
    public function size($remoteFile)
    {
        return ftp_size($this->_resource, $remoteFile);
    }

    /**
     * Mkdir
     *
     * @param string $dirname
     * @return string
     */
    public function mkdir($dirname)
    {
        return @ftp_mkdir($this->_resource, $dirname);
    }

    /**
     * Removes directory from the server
     *
     * @param string $dirname
     * @return boolean
     */
    public function rmdir($dirname)
    {
        return ftp_rmdir($this->_resource, $dirname);
    }

    /**
     * Removes a file from the server
     *
     * @param string $remoteFile
     * @return boolean
     */
    public function delete($remoteFile)
    {
        return ftp_delete($this->_resource, $remoteFile);
    }

    /**
     * Returns the system type identifier of the FTP server
     *
     * @return string
     */
    public function systype()
    {
        return ftp_systype($this->_resource);
    }

    /**
     * Gets all remote files
     *
     * @access public
     * @param  string directory to get its child
     * @return array list of remote files and directories
     */
    public function getRemoteFiles($dir=".")
    {
        return ftp_nlist($this->_resource, $dir);
    }

    /**
     * Checks whether given path is file or directory
     *
     * @param string $dir
     * @return boolean
     */
    protected function _isDir($dir)
    {
        $pwd = $this->pwd();
        //check if something is a dir by trying to open it
        if ($this->chdir($dir)) {
            //if it does open we want to go back to our own dir, 
            //else we'll get an error on checking the next thing
            $this->chdir($pwd);
            return true;
        }else{
            return false;
        }
    }


    /**
     * Traverses remote directory recursively
     *
     * @access public
     * @param string $dir directory that should be traversed
     * @return array
     */
    public function getRemoteFilesRecursive($dir)
    {
        $remoteFiles = $this->getRemoteFiles($dir);
        if (is_array($remoteFiles)) {
            foreach($remoteFiles as $f) {
                if(!$this->_isInBlackList($f)) {
                    if($this->_isDir($f)) {
                        $this->getRemoteFilesRecursive($f);
                    }else {
                        $this->_remoteFiles[] = $f;
                    }
                }
            }
        }
        return $this->_remoteFiles;
    }
    /**
     * Checks whether a file is in blacklist or not
     *
     * @param string $filepath
     * @return boolean
     */
    protected function _isInBlackList($filepath)
    {
        foreach ($this->_blackList as $item) {
            if (preg_match('/'.$item.'/', $filepath)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 返回文件的尺寸和修改时间
     *
     * @param $fileName
     *
     * @return array
     */
    public function getFileSizeAndMdtm($fileName) {

        $fileBaseInfo = array();
        //  get the last modified time
        $fileBaseInfo['mdtm'] = ftp_mdtm($this->_resource, $fileName);
        // get the size of $file
        $fileBaseInfo['size'] = ftp_size($this->_resource, $fileName);

        return $fileBaseInfo;
    }
}
