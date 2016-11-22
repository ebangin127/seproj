<?php
  require_once '../SQL/sql_account.php';
  class SQLConnector {
    private $Conn;
    function __construct() {
      $this->Connect();
    }
    
    function __destruct() {
      $this->Close();
    }
    
    private function Connect() {
      $this->Conn = new mysqli(
        "localhost",
        dbid(),
        dbpass(),
        dbname());

      if ($this->Conn->connect_error) {
        printf(
          "Failed 1 - MySQL connection Failed<br/>(Error: %d)",
          $this->Conn->connect_errno);
        return False;
      }
      return True;
    }
    
    private function Close() {
      $this->Conn->close();
    }

    function Escape($StringToEscape) {
      if(is_null($this->Conn)) {
          printf(
            "Failed 2 - No MySQL connection");
          return '';
      }
      return $this->Conn->real_escape_string($StringToEscape);
    }

    function BeginTransaction() {
      return $this->Query('BEGIN');
    }
    
    function CommitTransaction() {
      return $this->Query('COMMIT');
    }

    function RollbackTransaction() {
      return $this->Query('ROLLBACK');
    }

    function Query($Query) {
      if(is_null($this->Conn)) {
          printf(
            "Failed 2 - No MySQL connection");
          return False;
      }
      $Result = NULL;
      if (!$Result = $this->Conn->query($Query)) {  
        printf(
          "Failed 3 - Query failed<br/>(Error: %s)",
          $this->Conn->error);
        return NULL;
      }
      else {
        return $Result;
      }
    }
  }
?>
