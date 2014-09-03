<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function agg_form_system_theme_settings_alter(&$form, &$form_state) {

  // Allow someone to change "About" text without faffing about with a node.
  $form['zurb_foundation']['general']['about'] =
    array( '#type' => 'fieldset',
	   '#title' => 'Site "About" text',
	   '#description' => 'Enter text to describe this website. You may use HTML.',
	   'site_about_text' => array( '#type' => 'textarea',
				       '#default_value' => theme_get_setting('site_about_text'),
				       ),
	   );

  // We're always going to use the top bar. Don't allow it to be changed.
  unset( $form['zurb_foundation']['topbar']['zurb_foundation_top_bar_enable'] );

  dsm ( array( __FUNCTION__ => func_get_args() ) );
}
