<?php

class view {
	var $content;
	var $page;
	var $viewpath;
	var $defaultview='notfound.html';
	var $data = array();

	function view ($data=false) {
    if ($data) { $this->data=$data; }
  }

  function set($key, $value=NULL, $append=FALSE) {
    if (!is_array($key)) {
      if ($append) {
        $this->data[$key] .= $value;
      } else {
        $this->data[$key] = $value;
      }
    } else {
      if ($append) {
        $this->data .= array_merge($this->data, $key);
      } else {
        $this->data = array_merge($this->data, $key);	
      }
    }
  }
  
  function get($key) {
    return $this->data($key);
	}

	function render($file) {
		if (is_array($this->data)) { extract($this->data); }
		ob_start();
		include($file);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
  }
  function getcontents($path) {
    if ($this->page=$this->findfile($path)) {
      if (pathinfo($this->page,PATHINFO_EXTENSION) == 'html') {
        $this->content=file_get_contents($this->page);
      } else {
        $this->data['page']=$this->page;
        $this->content=$this->render($this->page,$this->data);
      }
    } else {
      return false;
    }
    return $this->content;
  }

  function findfile ($path,$exts=array('html','html.php')) {
    //echo "$path<br>\n";
    foreach ($exts as $ext) {
      $file=$this->viewpath.$path.'.'.$ext;
      //echo "$file<br>\n";
      if (file_exists($file)) { return $file; }
    }
    foreach ($exts as $ext) {
      if (strchr($path,'-')) {
        $file=$this->viewpath.substr($path,0,strrpos($path,'-')).'.'.$ext;
        //echo "$file<br>\n";
        if (file_exists($file)) { return $file; }
      }
    }
    return false;
  }
}
