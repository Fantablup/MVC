<?php
class Template {
  private $file = null;
  private $data = null;

	public function __construct($pFile)
{
    $this->file = $pFile;
  }

 public function __set($key, $value) {
   $this->data[$key] = $value;
 }

 public function __get($key) {
    return $this->data[$key];
 }

 public function __toString() {
	 if (isset($this->data)){
    extract ($this->data);
	//print_r( $this->data);
	 }
    ob_start ();
    include ($this->file);
    $contents = ob_get_contents ();
    ob_end_clean ();
    return $contents;
 }
}
?>