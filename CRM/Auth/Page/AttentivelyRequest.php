<?php

require_once 'CRM/Core/Page.php';

class CRM_Auth_Page_AttentivelyRequest extends CRM_Core_Page {
  function run() {
    $redirect = CRM_Utils_Array::value('redirect', $_GET);
    $redirectUri = 'http://attentive.ly.jmaconsulting.biz/civicrm/attentively/authcallback';
    $url = CRM_Auth_BAO_AttentivelyAuth::checkEnvironment();
    $url = $url . 'connect?client_id='.CLIENT_ID.'&redirect_uri='.$redirectUri;
    CRM_Core_Session::singleton()->set('redirectDomain', $redirect);
    civicrm_api3('setting', 'create', array('redirectDomain' => $redirect));
    CRM_Utils_System::redirect($url);
    parent::run();
  }
}
