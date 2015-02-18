<?php

require_once 'CRM/Core/Form.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Auth_Form_AttentivelyAuth extends CRM_Core_Form {
  function buildQuickForm() {

    $this->add('text', "access_token", ts('Access Token'), array(
        'size' => 30, 'maxlength' => 60, 'readonly' => TRUE)
    );
    $this->add('checkbox', "accept", ts('I have read and accepted the terms of conditions'));
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Authorize'),
        'isDefault' => TRUE,
      ),
    ));

    $defaults = CRM_Core_OptionGroup::values('attentively_auth', TRUE, FALSE, FALSE, NULL, 'name');
    $this->setDefaults($defaults);
    $this->freeze('access_token');
    parent::buildQuickForm();
  }

  function postProcess() {
    $values = $this->exportValues();
    CRM_Attentively_BAO_Attentively::updateAttentivelyAuth($values);
    $config = CRM_Core_Config::singleton();
    $redirectUri = "http://attentive.ly.jmaconsulting.biz/civicrm/attentively/request?redirect={$config->userFrameworkBaseURL}/civicrm/attentively/authcallback"; // Redirect to JMA instance
    CRM_Utils_System::redirect($redirectUri);
  }
}
