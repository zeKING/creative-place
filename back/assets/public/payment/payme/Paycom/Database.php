<?php

namespace Paycom;

class Database
{
    public $config;

    protected static $db;

    public function __construct(array $config = null)
    {
        $this->config = $config;
    }

    public function new_connection()
    {
        $db = null;

        // connect to the database
        $db_options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // fetch rows as associative array
            \PDO::ATTR_PERSISTENT         => true // use existing connection if exists
        ];

       /* $db = new \PDO(
            'mysql:dbname=' . $this->config['db']['database'] . ';host=' . $this->config['db']['host'] . ';charset=utf8',
            $this->config['db']['username'],
            $this->config['db']['password'],
            $db_options
        );*/
        
        $db = new \PDO(            
			'mysql:dbname=uztobacco_db;host=localhost;charset=utf8', 'uztobacco_user', 'u123123O!',
            $db_options
        );
		
	

        return $db;
    }

    /**
     * Connects to the database
     * @return null|\PDO connection
     */
    public static function db()
    {
        if (!self::$db) {
            $config   = array(
                'host'     => 'localhost',              
				 'database' => 'uztobacco_db',
                'username' => 'uztobacco_user',
                'password' => 'u123123O!',
            );
            $instance = new self($config);
            self::$db = $instance->new_connection();
        }

        return self::$db;
    }
}