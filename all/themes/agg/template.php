<?php

/**
 * Implements template_preprocess_html().
 *
 */
//function agg_preprocess_html(&$variables) {
//  // Add conditional CSS for IE. To use uncomment below and add IE css file
//  drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
//
//  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
//  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external');
//}

/**
 * Implements template_preprocess_page
 *
 */
function agg_preprocess_page(&$vars) {

  // Add html to site name if appropriate
  if ( strpos( $vars['site_name'], '1st' ) !== FALSE ) {
    $vars['site_name'] =
      str_replace( '1st', '1<sup>st</sup>', $vars['site_name'] );
  }

  // Get text entered by admin about the site
  $vars['site_about_text'] = theme_get_setting( 'site_about_text', NULL );

  // $title is available in page.tpl.php, but 'title' is not available in
  // variables array here.
  $title = drupal_get_title();

  // Whether to hide the page title. Edit as needs change.
  $vars['hide_page_title'] = empty($title) || ( $vars['is_front'] && FALSE );

  // D7 secondary menu seems to be broken.
  // Create menu with appropriate log in / log out / register links
  unset($vars['top_bar_secondary_menu']);
  $vars['top_bar_secondary_menu'] = get_secondary_menu_themed(
    get_secondary_menu_links( $vars['logged_in'] ) );

  // While we're at it, let's add a "universal" menu too.
  // This will be accessible even while logged out.
  $vars['top_bar_universal_menu'] =
    get_universal_menu_themed( get_universal_menu_links() );

  $vars['search_form'] = drupal_get_form( 'search_block_form' );

  // Didn't work!?! Do breadcrumbs get added later?
  //if ( $vars['is_front'] ) {
  //  unset( $vars['breadcrumb'] );
  //}
}


// Make our own secondary menu, similar to the user menu, but less broken.
function get_secondary_menu_links( $logged_in ) {

  global $user;

  if ( $logged_in ) {
    $links =
      array(
        array(
          'href' => "user/$user->uid/edit",
          'title' => 'Settings',
          'query' => drupal_get_destination(),
        ),
        array(
          'href' => 'user/logout',
          'title' => 'Log out',
        ),
      );
  }
  else {
    $links =
      array(
        array(
          'href' => 'user',
          'title' => 'Log in',
          'query' => drupal_get_destination(),
        ),
        array(
          'href' => 'user/register',
          'title' => 'Register',
          'query' => drupal_get_destination(),
        ),
	    );
  }
  return $links;
}

function get_secondary_menu_themed( $secondary_menu_links ) {
  return theme( 'links',
		array(
      'links' => $secondary_menu_links,
      'attributes' => array(
        'id' => 'secondary-menu',
        'class' => array('secondary', 'link-list', 'right'),
      ),
    )
  );
}


function get_universal_menu_links() {

  return array(
    array(
      'href' => "node/add/imported-article",
      'title' => 'Suggest an article',
      'attributes' => array(
        'title' => t('What website articles should we know about?')
      ),
    ),
    array(
      'href' => 'article-topics',
      'title' => 'Article topics',
      'attributes' => array(
        'title' => t('See what kinds of articles are available')
      ),
    ),
  );
}

function get_universal_menu_themed( $universal_menu_links ) {
  return theme( 'links',
		array(
      'links' => $universal_menu_links,
      'attributes' => array(
        'id' => 'universal-menu',
        'class' => array('universal-menu', 'left'),
      ),
    )
  );
}

/**
 * Implements template_preprocess_node
 *
 */
//function agg_preprocess_node(&$variables) {
//}

/**
 * Implements hook_preprocess_block()
 */
//function agg_preprocess_block(&$variables) {
//  // Add wrapping div with global class to all block content sections.
//  $variables['content_attributes_array']['class'][] = 'block-content';
//
//  // Convenience variable for classes based on block ID
//  $block_id = $variables['block']->module . '-' . $variables['block']->delta;
//
//  // Add classes based on a specific block
//  switch ($block_id) {
//    // System Navigation block
//    case 'system-navigation':
//      // Custom class for entire block
//      $variables['classes_array'][] = 'system-nav';
//      // Custom class for block title
//      $variables['title_attributes_array']['class'][] = 'system-nav-title';
//      // Wrapping div with custom class for block content
//      $variables['content_attributes_array']['class'] = 'system-nav-content';
//      break;
//
//    // User Login block
//    case 'user-login':
//      // Hide title
//      $variables['title_attributes_array']['class'][] = 'element-invisible';
//      break;
//
//    // Example of adding Foundation classes
//    case 'block-foo': // Target the block ID
//      // Set grid column or mobile classes or anything else you want.
//      $variables['classes_array'][] = 'six columns';
//      break;
//  }
//
//  // Add template suggestions for blocks from specific modules.
//  switch($variables['elements']['#block']->module) {
//    case 'menu':
//      $variables['theme_hook_suggestions'][] = 'block__nav';
//    break;
//  }
//}

//function agg_preprocess_views_view(&$variables) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
//function agg_preprocess_panels_pane(&$variables) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 */
//function agg_preprocess_views_view_fields(&$variables) {
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
//function agg_form_element_label($variables) {
//  if (!empty($variables['element']['#title'])) {
//    $variables['element']['#title'] = '<span class="secondary label">' . $variables['element']['#title'] . '</span>';
//  }
//  if (!empty($variables['element']['#description'])) {
//    $variables['element']['#description'] = ' <span data-tooltip="top" class="has-tip tip-top" data-width="250" title="' . $variables['element']['#description'] . '">' . t('More information?') . '</span>';
//  }
//  return theme_form_element_label($variables);
//}

/**
 * Implements hook_preprocess_button().
 */
//function agg_preprocess_button(&$variables) {
//  $variables['element']['#attributes']['class'][] = 'button';
//  if (isset($variables['element']['#parents'][0]) && $variables['element']['#parents'][0] == 'submit') {
//    $variables['element']['#attributes']['class'][] = 'secondary';
//  }
//}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
//function agg_form_alter(&$form, &$form_state, $form_id) {
//  // Sexy submit buttons
//  if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
//    $classes = (is_array($form['actions']['submit']['#attributes']['class']))
//      ? $form['actions']['submit']['#attributes']['class']
//      : array();
//    $classes = array_merge($classes, array('secondary', 'button', 'radius'));
//    $form['actions']['submit']['#attributes']['class'] = $classes;
//  }
//}

/**
 * Implements hook_form_FORM_ID_alter()
 * Example of using foundation sexy buttons on comment form
 */
//function agg_form_comment_form_alter(&$form, &$form_state) {
  // Sexy preview buttons
//  $classes = (is_array($form['actions']['preview']['#attributes']['class']))
//    ? $form['actions']['preview']['#attributes']['class']
//    : array();
//  $classes = array_merge($classes, array('secondary', 'button', 'radius'));
//  $form['actions']['preview']['#attributes']['class'] = $classes;
//}


/**
 * Implements template_preprocess_panels_pane().
 */
// function zurb_foundation_preprocess_panels_pane(&$variables) {
// }

/**
* Implements template_preprocess_views_views_fields().
*/
/* Delete me to enable
function THEMENAME_preprocess_views_view_fields(&$variables) {
 if ($variables['view']->name == 'nodequeue_1') {

   // Check if we have both an image and a summary
   if (isset($variables['fields']['field_image'])) {

     // If a combined field has been created, unset it and just show image
     if (isset($variables['fields']['nothing'])) {
       unset($variables['fields']['nothing']);
     }

   } elseif (isset($variables['fields']['title'])) {
     unset ($variables['fields']['title']);
   }

   // Always unset the separate summary if set
   if (isset($variables['fields']['field_summary'])) {
     unset($variables['fields']['field_summary']);
   }
 }
}

// */

/**
 * Implements hook_css_alter().
 */
//function agg_css_alter(&$css) {
//  // Always remove base theme CSS.
//  $theme_path = drupal_get_path('theme', 'zurb_foundation');
//
//  foreach($css as $path => $values) {
//    if(strpos($path, $theme_path) === 0) {
//      unset($css[$path]);
//    }
//  }
//}

/**
 * Implements hook_js_alter().
 */
//function agg_js_alter(&$js) {
//  // Always remove base theme JS.
//  $theme_path = drupal_get_path('theme', 'zurb_foundation');
//
//  foreach($js as $path => $values) {
//    if(strpos($path, $theme_path) === 0) {
//      unset($js[$path]);
//    }
//  }
//}
