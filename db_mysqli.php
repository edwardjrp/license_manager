<?php

//DB MySQLi Class @0-8D47C692

/*
 * Database Management for PHP
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 * Derived from db_mysql.php
 *
 * db_mysqli.php
 *
 */ 

class DB_MySQLi {
  
  /* public: connection parameters */
  public $DBHost     = "";
  public $DBPort     = 0;
  public $DBSocket   = "";
  public $DBDatabase = "";
  public $DBUser     = "";
  public $DBPassword = "";
  public $Persistent = false;

  /* public: configuration parameters */
  public $Auto_Free     = 1;     ## Set to 1 for automatic mysqli_free_result()
  public $Debug         = 0;     ## Set to 1 for debugging messages.
  public $Seq_Table     = "db_sequence";

  /* public: result array and current row number */
  public $Record   = array();
  public $Row;

  /* public: current error number and error text */
  public $Errno    = 0;
  public $Error    = "";

  /* public: this is an api revision, not a CVS revision. */
  public $type     = "mysql";
  public $revision = "1.2";

  /* private: link and query handles */
  public $Link_ID  = 0;
  public $Query_ID = 0;
  public $Connected = false;

  public $Encoding = "";
  


  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  /* public: some trivial reporting */
  function link_id() {
    return $this->Link_ID;
  }

  function query_id() {
    return $this->Query_ID;
  }

  function try_connect($DBDatabase = "", $DBHost = "", $DBPort = 0, $DBSocket = "", $DBUser = "", $DBPassword = "") {
    $this->Query_ID  = 0;
    /* Handle defaults */
    if ("" == $DBDatabase)   $DBDatabase = $this->DBDatabase;
    if (0 == $DBPort)        $DBPort     = $this->DBPort;
    if ("" == $DBSocket)     $DBSocket   = $this->DBSocket;
    if ("" == $DBHost)       $DBHost     = $this->DBHost;
    if ("" == $DBUser)       $DBUser     = $this->DBUser;
    if ("" == $DBPassword)   $DBPassword = $this->DBPassword;
      
    $this->Link_ID = @mysqli_connect($DBHost, $DBUser, $DBPassword, $DBDatabase, $DBPort, $DBSocket);
    $this->Connected = $this->Link_ID ? true : false;
    return $this->Connected;
  }

  /* public: connection management */
  function connect($DBDatabase = "", $DBHost = "", $DBPort = 0, $DBSocket="", $DBUser = "", $DBPassword = "") {
    /* Handle defaults */
    if ("" == $DBDatabase)   $DBDatabase = $this->DBDatabase;
    if (0 == $DBPort)        $DBPort     = $this->DBPort;
    if ("" == $DBSocket)     $DBSocket   = $this->DBSocket;
    if ("" == $DBHost)       $DBHost     = $this->DBHost;
    if ("" == $DBUser)       $DBUser     = $this->DBUser;
    if ("" == $DBPassword)   $DBPassword = $this->DBPassword;
      

    /* establish connection, select database */
    if (!$this->Connected) {
      $this->Query_ID  = 0;    
      $this->Link_ID = @mysqli_connect($DBHost, $DBUser, $DBPassword, $DBDatabase, $DBPort, $DBSocket);

      if (!$this->Link_ID) {
        $this->halt("mysqli_connect($DBHost, $DBUser, \$DBPassword, $DBDatabase, $DBPort, $DBSocket) failed.");
        return 0;
      }
      $server_info = @mysqli_get_server_info($this->Link_ID);
      preg_match("/\d+\.\d+(\.\d+)?/", $server_info, $matches);
      $version_str = $matches[0];
      $version = explode(".", $version_str);
      if ($version[0] >= 4) {
        if (($version[0] > 4 || $version[1] >= 1) && is_array($this->Encoding) && $this->Encoding[1])
          @mysqli_query($this->Link_ID, "set character set '" . $this->Encoding[1] . "'");
        elseif (is_array($this->Encoding) && $this->Encoding[0])
          @mysqli_query($this->Link_ID, "set character set '" . $this->Encoding[0] . "'");
      }

      $this->Connected = true;
    }
    
    return $this->Link_ID;
  }



  /* public: discard the query result */
  function free_result() {
    if (is_resource($this->Query_ID)) {
      @mysqli_free_result($this->Query_ID);
    }
    $this->Query_ID = 0;
  }

  /* public: perform a query */
  function query($Query_String) {
    /* No empty queries, please, since PHP4 chokes on them. */
    if ($Query_String == "")
      /* The empty query string is passed on from the constructor,
       * when calling the class without a query, e.g. in situations
       * like these: '$db = new DB_Sql_Subclass;'
       */
      return 0;

    if (!$this->connect()) {
      return 0; /* we already complained in connect() about that. */
    };

    # New query, discard previous result.
    if ($this->Query_ID) {
      $this->free_result();
    }

    if ($this->Debug)
      printf("Debug: query = %s<br>\n", $Query_String);

    $this->Query_ID = @mysqli_query($this->Link_ID, $Query_String);
    $this->Row   = 0;
    $this->Errno = mysqli_errno($this->Link_ID);
    $this->Error = mysqli_error($this->Link_ID);
    if (!$this->Query_ID) {
      $this->Errors->addError("Database Error: " . mysqli_error($this->Link_ID));
    }

    # Will return nada if it fails. That's fine.
    return $this->Query_ID;
  }

  /* public: walk result set */
  function next_record() {
    if (!$this->Query_ID) 
      return 0;

    $this->Record = @mysqli_fetch_array($this->Query_ID, MYSQLI_BOTH);
    $this->Row   += 1;
    $this->Errno  = mysqli_errno($this->Link_ID);
    $this->Error  = mysqli_error($this->Link_ID);

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_Free) {
      $this->free_result();
    }
    return $stat;
  }

  /* public: position in result set */
  function seek($pos = 0) {
    $status = @mysqli_data_seek($this->Query_ID, $pos);
    if ($status) {
      $this->Row = $pos;
    } else {
      $this->Errors->addError("Database error: seek($pos) failed -  result has ".$this->num_rows()." rows");

      /* half assed attempt to save the day, 
       * but do not consider this documented or even
       * desireable behaviour.
       */
      @mysqli_data_seek($this->Query_ID, $this->num_rows());
      $this->Row = $this->num_rows();
    }
    return true;
  }

  /* public: table locking */
  function lock($table, $mode="write") {
    $this->connect();
    
    $query="lock tables ";
    if (is_array($table)) {
      while (list($key,$value)=each($table)) {
        if ($key=="read" && $key!=0) {
          $query.="$value read, ";
        } else {
          $query.="$value $mode, ";
        }
      }
      $query=substr($query,0,-2);
    } else {
      $query.="$table $mode";
    }
    $res = @mysqli_query($this->Link_ID, $query);
    if (!$res) {
      $this->Errors->addError("Database error: Cannot lock tables - " . mysqli_error($this->Link_ID));
      return 0;
    }
    return $res;
  }
  
  function unlock() {
    $this->connect();

    $res = @mysqli_query("unlock tables");
    if (!$res) {
      $this->Errors->addError("Database error: cannot unlock tables - " . mysqli_error($this->Link_ID));
      return 0;
    }
    return $res;
  }


  /* public: evaluate the result (size, width) */
  function affected_rows() {
    return @mysqli_affected_rows($this->Link_ID);
  }

  function num_rows() {
    return @mysqli_num_rows($this->Query_ID);
  }

  function num_fields() {
    return @mysqli_num_fields($this->Query_ID);
  }

  /* public: shorthand notation */
  function nf() {
    return $this->num_rows();
  }

  function np() {
    print $this->num_rows();
  }

  function f($Name) {
    return $this->Record && array_key_exists($Name, $this->Record) ? $this->Record[$Name] : "";
  }

  function p($Name) {
    print $this->Record[$Name];
  }

  /* public: sequence numbers */
  function nextid($seq_name) {
    $this->connect();
    
    if ($this->lock($this->Seq_Table)) {
      /* get sequence number (locked) and increment */
      $q  = sprintf("select nextid from %s where seq_name = '%s' LIMIT 1",
                $this->Seq_Table,
                $seq_name);
      $id  = @mysqli_query($this->Link_ID, $q);
      $res = @mysqli_fetch_array($id);
      
      /* No current value, make one */
      if (!is_array($res)) {
        $currentid = 0;
        $q = sprintf("insert into %s values('%s', %s)",
                 $this->Seq_Table,
                 $seq_name,
                 $currentid);
        $id = @mysqli_query($this->Link_ID, $q);
      } else {
        $currentid = $res["nextid"];
      }
      $nextid = $currentid + 1;
      $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'",
               $this->Seq_Table,
               $nextid,
               $seq_name);
      $id = @mysqli_query($this->Link_ID, $q);
      $this->unlock();
    } else {
      $this->Errors->addError("Database Error: " . mysqli_error($this->Link_ID));
      return 0;
    }
    return $nextid;
  }

  function close()
  {
    if ($this->Query_ID) {
      $this->free_result();
    }
    if ($this->Connected && !$this->Persistent) {
      mysqli_close($this->Link_ID);
      $this->Connected = false;
    }
  }  

  /* private: error handling */
  function halt($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>MySQL Error</b><br>\n");
    die("Session halted.");
  }

  function table_names() {
    $this->query("SHOW TABLES");
    $i=0;
    while ($info=mysqli_fetch_row($this->Query_ID))
     {
      $return[$i]["table_name"]= $info[0];
      $return[$i]["tablespace_name"]=$this->DBDatabase;
      $return[$i]["database"]=$this->DBDatabase;
      $i++;
     }
   return $return;
  }
  
  function esc($value) {
    if ($this->Connected) {
      return mysqli_real_escape_string($this->Link_ID, $value);
    } elseif (function_exists("mysql_escape_string")) {
      return mysql_escape_string($value);
    } else {
      return addslashes($value);
    } 
  }

}

//End DB MySQLi Class


?>
