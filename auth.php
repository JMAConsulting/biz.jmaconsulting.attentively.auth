<?php

define('ENV', 0); // Set ENV to 1 for production API (https://api.attentive.ly) or 0 for test API (http://apidev.attentive.ly)

require_once 'auth.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function auth_civicrm_config(&$config) {
  _auth_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function auth_civicrm_xmlMenu(&$files) {
  _auth_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function auth_civicrm_install() {
  _auth_civix_civicrm_install();
  CRM_Core_Session::singleton()->set('authEnabled', TRUE);
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function auth_civicrm_uninstall() {
  _auth_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function auth_civicrm_enable() {
  _auth_civix_civicrm_enable();
  CRM_Core_Session::singleton()->set('authEnabled', TRUE);
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function auth_civicrm_disable() {
  _auth_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function auth_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _auth_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function auth_civicrm_managed(&$entities) {
  _auth_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function auth_civicrm_caseTypes(&$caseTypes) {
  _auth_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function auth_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _auth_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implementation of hook_civicrm_pageRun
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_pageRun
 */
function auth_civicrm_pageRun(&$page) {
  if (get_class($page) == 'CRM_Admin_Page_Extensions' && CRM_Core_Session::singleton()->get('authEnabled')) {
    CRM_Core_Session::singleton()->set('authEnabled', FALSE);
    CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/auth', "reset=1"));
  }
}
