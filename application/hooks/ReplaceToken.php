<?php
class ReplaceToken {



  public function replacePlaceholderCode()
  {
      // load the instance
      $this->CI =& get_instance();

      // get the actual output
      $contents = $this->CI->output->get_output();

      // replace the tokens
      $this->CI->load->helper('date');
      $contents = str_replace("[DATETIME]", standard_date(), $contents);

      // set the output
      echo $contents; 
      return;
  }
}
