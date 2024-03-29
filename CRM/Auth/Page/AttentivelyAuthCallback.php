<?php

require_once 'CRM/Core/Page.php';

class CRM_Auth_Page_AttentivelyAuthCallback extends CRM_Core_Page {
  function run() {
    $code = CRM_Utils_Array::value('code', $_GET);
    $redirectUri = CRM_Utils_System::url('civicrm/attentively/authcallback', NULL, TRUE);
    $url = CRM_Auth_BAO_AttentivelyAuth::checkEnvironment();
    $url = $url . 'authorization';
    $post = 'code=' . $code . '&client_id=' . CLIENT_ID . '&client_secret=' . CLIENT_SECRET . '&redirect_uri=' .$redirectUri. '&access_token=';
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, TRUE);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $result = civicrm_api3('setting', 'get', array('return' => array('redirectDomain')));
    $redirectDomain = $result['values'][1]['redirectDomain'];
    civicrm_api3('setting', 'create', array('redirectDomain' => NULL));

    $response = curl_exec( $ch );
    $values = get_object_vars(json_decode($response));
    if ($values['success']) {
      CRM_Utils_System::redirect($redirectDomain . $values['access_token']);
    }
  }
}
