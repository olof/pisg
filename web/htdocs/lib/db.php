<?php

class db {
  var $dbfile='data/db.sqlite';
  var $debug=1;
  var $dbh;
  var $tables=array();
  var $fields=array();

  function db ($file=false) {
    if ($file) { $this->dbfile=$file; }
    try {
        $this->dbh = new PDO('sqlite:'.$this->dbfile);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        if ($this->debug) { die($e->getMessage().' ('.$this->dbfile.')'); }
    }
    return $this->dbh;
  }
  //functions
  function _debug($msg) {
    if ($this->debug) {echo $msg."\n";}
  }
  function setup ($sqlfile) {
    $sql=file_get_contents($sqlfile);
    $this->exec($sql);
  }
  function reset ($sqlfile) {
    $dbh=&$this->dbh;
    if (empty($this->tables)) { $this->showtables(); }
    foreach ($this->tables as $table) {
      $dbh->exec('DROP TABLE IF EXISTS '.$table);
    }
    $this->setup($sqlfile);
  }
  function showtables () {
    $dbh=&$this->dbh;
    $sql='SELECT name FROM sqlite_master WHERE type = "table"';
    $r=$dbh->query($sql)->fetchAll();
    foreach ($r as $k =>$v) { $this->tables[]=$v['name']; }
    return $this->tables;
  }
  function getfields () {
    $dbh=&$this->dbh;
    if (empty($this->tables)) { $this->showtables(); }
    foreach ($this->tables as $key => $table) {
      $sql=sprintf('PRAGMA table_info (%s)',$table);
      $r=$dbh->query($sql)->fetchAll();
      foreach ($r as $k =>$v) { $this->fields[$key][]=$v['name']; }
    }
    return $this->fields;
  }
  function quote($sql) {
    return $this->dbh->quote($sql);
  }
  function query($sql) {
    try {
        return $this->dbh->query($sql);
    } catch(PDOException $e) {
        if ($this->debug) { die($e->getMessage().' ('.$this->dbfile.')'); }
    }
  }
  function exec($sql) {
    try {
        $this->dbh->exec($sql);
    } catch(PDOException $e) {
        if ($this->debug) { die($e->getMessage().' ('.$this->dbfile.')'); }
    }
  }
  function error() {
      return $this->dbh->errorInfo();
  }
}//eof