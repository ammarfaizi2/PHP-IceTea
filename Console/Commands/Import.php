<?php

namespace Console\Commands;

use mysqli;
use System\Crayner\Contracts\Console\Command;
use System\Crayner\ConfigHandler\Configer;
use Console\Exception\InvalidArgumentException;

class Import implements Command
{
    // EXAMPLE:   EXPORT_TABLES("localhost","user","pass","db_name" );
    //optional: 5th parameter - to backup specific tables only: array("mytable1","mytable2",...)
    //optional: 6th parameter - backup filename
    // IMPORTANT NOTE for people who try to change strings in SQL FILE before importing, MUST READ:  goo.gl/2fZDQL
                    
    // https://github.com/tazotodua/useful-php-scripts
    public function prepare($selection, $optional, $command)
    {
        /*$this->selection = $selection;
        $this->command   = strtolower($command);
        $this->optional  = $optional;*/
    }

    public function argument($argument)
    {
        /*try {
            if (count($argument) > 1) {
                throw new InvalidArgumentException("Invalid command argument !", 400);
            } else {
                $this->filename = $argument[0];
            }
        } catch (InvalidArgumentException $e) {
            print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
            die;
        } catch (\Exception $e) {
            print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
        }*/
    }

    public function showResult()
    {
        /*return $this->result;*/
    }

    public function execute()
    {
        error_reporting(0);
        $conf = Configer::database();
        $host = $conf['host'];
        $user = $conf['user'];
        $pass = $conf['pass'];
        $dbname = $conf['dbname'];
        $sql_file_OR_content = file_get_contents(BASEPATH."/database.sql");
        set_time_limit(3000);
        $SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content));
        $allLines = explode("\n", $SQL_CONTENT);
        $mysqli = new mysqli($host, $user, $pass, $dbname);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $zzzzzz = $mysqli->query('SET foreign_key_checks = 0');
        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables);
        foreach ($target_tables[2] as $table) {
            $mysqli->query('DROP TABLE IF EXISTS '.$table);
        }
        $zzzzzz = $mysqli->query('SET foreign_key_checks = 1');
        $mysqli->query("SET NAMES 'utf8'");
        $templine = '';    // Temporary variable, used to store current query
    foreach ($allLines as $line) {                                            // Loop through each line
        if (substr($line, 0, 2) != '--' && $line != '') {
            $templine .= $line;    // (if it is not a comment..) Add this line to the current segment
            if (substr(trim($line), -1, 1) == ';') {        // If it has a semicolon at the end, it's the end of the query
                if (!$mysqli->query($templine)) {
                    print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');
                }
                $templine = ''; // set variable to empty, to start picking up the lines after ";"
            }
        }
    }
        echo 'Importing finished. Now, Delete the import file.'.PHP_EOL.PHP_EOL;
        die;
    }
}
