<?php

require_once 'CRM/Core/Page.php';

class CRM_Attentively_Page_AttentivelyRequest extends CRM_Core_Page {
  function run() {
    $redirect = CRM_Utils_Array::value('redirect', $_GET);
    $redirectUri = 'http://attentive.ly.jmaconsulting.biz/civicrm/attentively/callback';
    $url = CRM_Attentively_BAO_Attentively::checkEnvironment();
    $url = $url . 'connect?client_id='.CLIENT_ID.'&redirect_uri='.$redirectUri;
    CRM_Core_Session::singleton()->set('redirectDomain', $redirect);
    CRM_Utils_System::redirect($url);
    parent::run();
  }
}
