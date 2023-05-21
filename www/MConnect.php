<?php 

namespace MagnitCLUB;

use Medoo\Medoo;

class MConnect
{
    public $mdb;

    public function connectMQL()
    {
        // mysql connection
        try {
            // Connect the database.
            $this->mdb = new Medoo([
                'database_type' => 'mysql',
                'server'        => MDB_HOST,
                'database_name' => MDB_NAMEDB,
                'username'      => MDB_USER,
                'password'      => MDB_PASS,
                'charset'       => 'utf8',
                'error'         => \PDO::ERRMODE_EXCEPTION,
                'option'        => array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_TIMEOUT => 15
                )
            ]);
        }
        catch(\PDOException $e) {
            // Logger::add_msg("ERR: MNT: [". __FUNCTION__ . "]: Error, catch: " . $e->getMessage() );
            echo($e);die();
            sleep(2);
        }

        return $this->mdb;
    }
}
