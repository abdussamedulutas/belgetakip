<?php
    $dbname = $MVC_dbconfig->Database;
    $dbname2 = $MVC_dbconfig->Database;
    $table = [];
    $fields = [];
    function putValue($type,$value)
    {
        if(preg_match("/date/",$type) == 1 && strlen($value) == 0)
        {
            return "NULL";
        }else if(preg_match("/binary/",$type) == 0)
        {
            return textlikevalue($value);
        }else{
            return binarylikevalue($value);
        }
    };
    
    function textlikevalue($text)
    {
        if($text == "0000-00-00 00:00:00")
        {
            return "NULL";
        };
        return '\''.str_replace([
            "'",
            "\n",
            "\r"
        ],[
            "\\'",
            "\\n",
            "\\r"
        ],$text).'\'';
    }
    function binarylikevalue($text)
    {
        return "UNHEX('".bin2hex($text)."')";
    }
    function putData($dbname,$tablename,$fields,$row)
    {
        $di = "";
        foreach($fields as $name => $i)
        {
            if($name == "_INDEX_") continue;
            $di .= "`$name`,";
        };
        $di = substr($di,0,strlen($di) - 1);
        $sql = "INSERT INTO `$dbname`.`$tablename` ($di) VALUES (";
        foreach($fields as $name => $i)
        {
            if($name == "_INDEX_") continue;
            $sql .= putValue($i->type,$row->{$name}).",";
        };
        $sql = substr($sql,0,strlen($sql) - 1);
        $sql .= ");";
        return $sql;
    }

    function dropCreates()
    {
        global $fields,$db,$dbname,$dbname2;
        $sql = [];
        foreach($fields as $name => $columns)
        {
            $sql[] = "TRUNCATE TABLE `$dbname2`.`$name`;\n";
        };
        return implode('',$sql);
    };
      
    function putCreates()
    {
        global $fields,$db,$dbname,$dbname2;
        $sql = [];
        foreach($fields as $tname => $columns)
        {
            $rows[] = "CREATE TABLE IF NOT EXISTS `$dbname`.`$tname` (\n";
            foreach($columns as $name => $column)
            {
                if($name == "_INDEX_")
                {
                    $rows[] = "\tPRIMARY KEY(`$column`)";
                    $rows[] = ",\n";
                }else{
                    $rows[] = "\t`$name` $column->type";
                    if($column->charset != null) $rows[] = " COLLATE $column->collate";
                    if($column->nullable == "NO") $rows[] = " NOT NULL";
                    $rows[] = ",\n";
                }
            };
            $rows = array_slice($rows,0,count($rows)-1);
            $rows[] = "\n);\n\n";
        };
        return implode('',$rows);
    };
    function putInserts()
    {
        global $fields,$db,$dbname,$dbname2;
        $sql = [];
        foreach($fields as $tname => $columns)
        {
            $rows = $db->query("SELECT * FROM `$dbname`.`$tname`;")->fetchall(PDO::FETCH_OBJ);
            foreach($rows as $row)
            {
                $sql[] = putData($dbname2,$tname,$columns,$row)."\n";
            }
        };
        return implode('',$sql);
    };
    function ExportDatabase()
    {
        $filename = getRecoveryName();
        if(RecoveryExists())
        {
            return false;
        };

        $recoveryConfig = readConfig();
        $recoveryConfig->recoveries[] = date("Y-m-d",time());
        writeConfig($recoveryConfig);

        ConnectDatabase();
        global $table,$fields,$db,$dbname;
        $tables = $db->query("SHOW TABLES FROM `$dbname`;")->fetchall(PDO::FETCH_OBJ);
        foreach($tables as $i => $name)
        {
            foreach($name as $i => $tname)
            {
                $fields[$tname] = [];
                $columns = $db->query("SELECT `COLUMN_NAME` AS `name`,column_type AS type,collation_name AS `collate`,is_nullable AS nullable,character_set_name AS charset FROM  `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='$dbname' AND TABLE_NAME='$tname' ORDER BY ORDINAL_POSITION")->fetchall(PDO::FETCH_OBJ);
                $index = $db->query("SHOW INDEXES FROM `$tname` FROM `$dbname`")->fetch(PDO::FETCH_OBJ);
                foreach($columns as $column)
                {
                    $fields[$tname][$column->name] = $column;
                };
                if($index != false) $fields[$tname]["_INDEX_"] = $index->Column_name;
                $table[] = $tname;
            };
        };

        $bin=[];
        $bin[] = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";';
        $bin[] = 'SET AUTOCOMMIT = 0;';
        $bin[] = 'SET time_zone = "+00:00";';
        $bin[] = 'SET NAMES utf8mb4;';
        $bin[] = "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;";
        $bin[] = 'START TRANSACTION;';
        $bin[] = putCreates();
        $bin[] = dropCreates();
        $bin[] = "SET sql_notes = 1;";
        $bin[] = putInserts();
        $bin[] = "COMMIT;";
        $bin = implode("\n",$bin);
        //$bin = gzcompress($bin,9);
        
        $t = fopen($filename,"w");
        fwrite($t,$bin);
        fclose($t);

        return true;
    };
    function ImportDatabase($name)
    {
        $name = getRecoveryName($name);
        if(!RecoveryExists())
        {
            return false;
        };

        $recoveryConfig = readConfig();
        $recoveryConfig->status = "non-initial";
        writeConfig($recoveryConfig);
        ConnectDatabase();
        global $db;
        $t = fopen($name,"r");
        $sql = fread($t,filesize($name));
        //$sql = gzuncompress($sql);
        $db->query($sql);
        
        $recoveryConfig = readConfig();
        $recoveryConfig->status = "initial";
        writeConfig($recoveryConfig);
    }
    function RecoveryExists()
    {
        return file_exists(getRecoveryName());
    }
    function getRecoveryName($name = -1)
    {
        date_default_timezone_set('UTC');
        if($name == -1)
        {
            $name = date("Y-m-d",time());
        };
        return __DIR__."/../Recovery/SQL_$name.sql";
    }