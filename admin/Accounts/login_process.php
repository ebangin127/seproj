<?php

  function CheckForms() {
    //Check the form
    if((!isset($_GET['id'])) || (!isset($_GET['pw']))) {
      printf("Failed 0 - Fill the form properly");
      return 0;
    }

    $this->Model =
      $this->Conn->real_escape_string($_GET['Model']);
    $this->Firmware =
      $this->Conn->real_escape_string($_GET['Firmware']);
    return 1;
  }
?>