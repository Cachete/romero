<?php
class Spdo extends PDO {
    private static $instance = null;
    protected  $host = '10.184.104.4';
    protected $port = '1433';
    protected $dbname='BiosShanusi';
    protected $user='sa';
    protected $password='shanusi';

	public function __construct()
	{            
            $dns='mssql:dbname='.$this->dbname.';host='.$this->host.';port='.$this->port;
            $user = $this->user;
            $pass = $this->password;
            parent::__construct($dns,$user,$pass);
	}

	public static function singleton()
	{
            if( self::$instance == null )
                {
                    self::$instance = new self();
                }
             return self::$instance;
            	
	}

}
?>