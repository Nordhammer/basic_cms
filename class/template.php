<?php

class Template {

  private $assignedValues = array();
  private $partialBuffer  = '';
  private $tpl            = '';

  public function __construct($_path = '') {
    if (!empty($_path)) {
      if (file_exists($_path)) {
        $this->tpl = file_get_contents($_path);
      } else {
        echo "<div class='container tpl_error'><strong>Template Error:</strong> Base file '{$_path}' Inclusion Error.<br /><br /></div>";
      }
    }
  }

  public function assign($_searchString, $_replaceString = '') {
    if (!empty($_searchString)) {
      $this->assignedValues[strtoupper($_searchString)] = $_replaceString;
    }
  }

  public function renderPartial($_searchString, $_path, $_assignedValues = array()) {
    if (!empty($_searchString)) {
      if (file_exists($_path)) {
        $this->partialBuffer = file_get_contents($_path);
        if (count($_assignedValues) > 0) {
          foreach ($_assignedValues as $key => $value) {
            $this->partialBuffer = str_replace('{'.strtoupper($key).'}', $value, $this->partialBuffer);
          }
        }
        $this->tpl = str_replace('['.strtoupper($_searchString).']', $this->partialBuffer, $this->tpl);
        $this->partialBuffer = '';
      } else {
        echo "<div class='container tpl_error'><strong>Template Error:</strong> Partial file '{$_path}' Inclusion Error.</div>";
      }
    }
  }

  public function show($debug = false) {
    if (count($this->assignedValues) > 0) {
      foreach ($this->assignedValues as $key => $value) {
        $this->tpl = str_replace('{'.$key.'}', $value, $this->tpl);
      }
    }
    if ($debug) {
      $this->tpl .= '<!-- '.date('d.m.Y H:i:s').' -->';
    }
    return $this->tpl;
  }

}