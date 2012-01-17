<?php

class route {
  var $path;
  var $route;
  var $basepath;
  var $default;
  
  function route ($default='home') {
    $this->setdefault($default);
    $this->setpath();
    $this->setroute();
    $this->setbasepath();
  }

	function getpath() {
    $path=$this->default;
    if (isset($_SERVER['PATH_INFO'])) { $path=$_SERVER['PATH_INFO']; }
		elseif (isset($_SERVER['ORIG_PATH_INFO'])) { $path=$_SERVER['ORIG_PATH_INFO']; }
		if (isset($path)) { return trim($path,'/'); }
	}
	
	function setdefault($default) {
    $this->default=$default;
  }
	
	function setpath() {
    $this->path=$this->getpath();
  }

  function setroute() {
    if (strchr($this->path,'/')) { list($this->route,$this->path)=explode('/',$this->path,2); }
    else { $this->route=$this->path; }
  }
  
  function setbasepath() {
    $this->basepath=dirname(isset($_SERVER['ORIG_SCRIPT_NAME'])?$_SERVER['ORIG_SCRIPT_NAME']:$_SERVER['SCRIPT_NAME']);
    if ($this->basepath != '/') { $this->basepath.='/'; }
  }
  
  function redirect($location) {
    header('Location: '.$location); die();
  }

  function checkpath ($path,$locations=false) {
    $newpath=$path;
    //do we need to redirect?
    if ($locations) {
      $newpath=isset($locations[$newpath])?$locations[$newpath]:$newpath;
    }
    //set lookup
    $newpath=strtolower($newpath);
    //fix anything that isn't a normal chr
    $newpath=preg_replace('/[^\w-\.]/i','-',$newpath);
    //trim dashes
    $newpath=trim($newpath,'-');
		//trim underscores
		$newpath=trim($newpath,'_');
		//trim dots
		$newpath=trim($newpath,'.');
    //return the new path
    return $newpath;
  }
}//EOF