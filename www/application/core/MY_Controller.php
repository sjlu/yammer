<?php

class MY_Controller extends CI_Controller {

  function __construct() {
    parent::__construct();

    /**
     * Makes sure our database is of
     * the current migration.
     */
    $this->load->library('migration');
    if (!$this->migration->current()) {
      show_error($this->migration->error_string());
    }
  }

}