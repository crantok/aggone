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

  $form['zurb_foundation']['general']['about'] =
    array( '#type' => 'fieldset',
	   '#title' => 'Site "About" text',
	   '#description' => 'Enter text to describe this website. You may use HTML.',
	   'site_about_text' => array( '#type' => 'textarea',
				       '#default_value' => theme_get_setting('site_about_text'),
				       ),
	   );

  dsm ( array( __FUNCTION__ => func_get_args() ) );
}
