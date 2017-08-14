<?php
/**
 * Description
 *
 * @package CampFirePixels\Tabber
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

// Dashboard:           ‘index.php’
// Posts:               ‘edit.php’
// Media:               ‘upload.php’
// Pages:               ‘edit.php?post_type=page’
// Comments:            ‘edit-comments.php’
// Custom Post Types:   ‘edit.php?post_type=your_post_type’
// Appearance:          ‘themes.php’
// Plugins:             ‘plugins.php’
// Users:               ‘users.php’
// Tools:               ‘tools.php’
// Settings:            ‘options-general.php’
// Network Settings:    ‘settings.php’

/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class CFP_Admin {

   /**
    * Holds an instance of the object
    *
    * @var CFP_Admin
    */
   protected static $instance = null;
   /**
    * Option key, and option page slug
    * @var string
    */
   protected $key = 'cfp_options';
   /**
    * Option key, and option page slug
    * @var string
    */
   protected $prefix = 'cfp_options_';
   /**
    * Options page metabox id
    * @var string
    */
   protected $metabox_id = 'cfp_option_metabox';
   /**
    * Options Page title
    * @var string
    */
   protected $title = 'CampFirePixels Responsive Tabber';
   /**
    * Options Page hook
    * @var string
    */
   protected $options_page = '';

   /**
    * Constructor
    * @since 0.1.0
    */
   protected function __construct() {
      // Set our title
      $this->title = __( 'Responsive Tabber', 'cfp' );
   }

   /**
    * Returns the running object
    *
    * @return CFP_Admin
    */
   public static function get_instance() {
      if ( null === self::$instance ) {
         self::$instance = new self();
         self::$instance->hooks();
      }

      return self::$instance;
   }

   /**
    * Initiate our hooks
    * @since 0.1.0
    */
   public function hooks() {
      add_action( 'admin_init', array ( $this, 'init' ) );
      add_action( 'admin_menu', array ( $this, 'add_options_page' ) );
      add_action( 'cmb2_admin_init', array ( $this, 'add_options_page_metabox' ) );
   }

   /**
    * Register our setting to WP
    * @since  0.1.0
    */
   public function init() {
      register_setting( $this->key, $this->key );
   }

   public function paragraph() {
      return $this->get_new_render_type( __FUNCTION__, 'CMB2_Type_Text', array (
         'class' => 'cmb2-paragraph',
         'desc'  => $this->_desc(),
      ), 'input' )->render();
   }

   public function cfp_paragraph( $args = array () ) {
      return $this->get_new_render_type( __FUNCTION__, 'paragraph', $args )->render();
      //$data =  "<p>Motivation is a multi-level concept</p>";
      //echo $data;
   }

   public function add_options_page() {
      $this->options_page = add_submenu_page(
         'options-general.php',
         'CampFirePixels Responsive Tabber',
         $this->title,
         'manage_options',
         $this->key,
         array ( $this, 'admin_page_display' )
      );
      // Include CMB CSS in the head to avoid FOUT
      add_action( "admin_print_styles-{$this->options_page}", array ( 'CMB2_hookup', 'enqueue_cmb_css' ) );
   }

   /**
    * Admin page markup. Mostly handled by CMB2
    * @since  0.1.0
    */
   public function admin_page_display() {
      ?>
      <div class="wrap cmb2-options-page <?php echo $this->key; ?>">
         <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
         <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
      </div>
      <?php
   }

   /**
    * Add the options metabox to the array of metaboxes
    * @since  0.1.0
    */
   function add_options_page_metabox() {
      global $prefix;
      //global $cmb;

      // hook in our save notices
      add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array ( $this, 'settings_notices' ), 10, 2 );

      $cmb = new_cmb2_box( array (
                              'id'         => $this->metabox_id,
                              'hookup'     => false,
                              'cmb_styles' => false,
                              'show_on'    => array (
                                 // These are important, don't remove
                                 'key'   => 'options-page',
                                 'value' => array ( $this->key, )
                              ),
                           ) );

      $cmb->add_field( array (
                          'name' => '<h3>Enter the shortcodes consecutively like below</h3>
                                      <strong>You can use a different icon if you wish</strong><br>', 'cfp',
                          //'desc' => esc_html__( 'This is a title description', 'cfp' ),
                          'id'   => $prefix . 'title',
                          'type' => 'title',
                       ) );

      $cmb->add_field( array ( 'name' => '<pre>
[tab title="First Tab" show_icon="fa fa-angle-left"]Four score and seven years ...[/tab]
[tab title="Second Tab"]Of mice and men ...[/tab]
[tab title="Third Tab" show_icon="fa fa-caret-left"]You can\'t handle the truth![/tab]
[tab title="Fourth Tab"]Frankly Scarlet, I just don\'t give a damn![/tab]</pre>
<br>
<pre>[tabber topic="Rocky"][/tabber]</pre>
   <h4>This plugin includes the following features:</h4>
   <ul>
      <li>NOTICE: you do not have to put a div around the shortcode, the plugin takes care of that for you.</li>
      <li>Font icon visual indicator</li>
      <li>jQuery sliding animation</li>
   </ul>
                                     ', 'cfp',
                               'desc' => esc_html__( 'This is a title description', 'cfp' ),
                               'id'   => $prefix . 'paragraph',
                               'type' => 'paragraph',
                       ) );

      $cmb->add_field( array (
                          'name' => 'Font Awesome Icon', 'cfp',
                          'desc' => 'example: <strong><a href="http://fontawesome.io/icons/#directional" target="_blank">fa fa-caret-left</a></strong><br><br>', 'cfp',
                          'id'   => 'icon_left',
                          'type' => 'text_medium',
                       ) );

      // $group_field_id is the field id string, so in this case: $prefix . 'demo'
      //$group_field_id = $cmb->add_field( array (
      //                                      'id'          => $prefix . 'demo',
      //                                      'type'        => 'group',
      //                                      'description' => esc_html__( 'Generates reusable form entries', 'cfp' ),
      //                                      'options'     => array (
      //                                         'group_title'   => esc_html__( 'Entry {#}', 'cfp' ), // {#} gets replaced by row number
      //                                         'add_button'    => esc_html__( 'Add Another Entry', 'cfp' ),
      //                                         'remove_button' => esc_html__( 'Remove Entry', 'cfp' ),
      //                                         'sortable'      => true, // beta
      //                                         // 'closed'     => true, // true to have the groups closed by default
      //                                      ),
      //                                   ) );
//
      ///**
      // * Group fields works the same, except ids only need
      // * to be unique to the group. Prefix is not needed.
      // *
      // * The parent field's id needs to be passed as the first argument.
      // */
      //$cmb->add_group_field( $group_field_id, array (
      //   'name' => esc_html__( 'Tab Title', 'cfp' ),
      //   'id'   => 'title',
      //   'type' => 'text',
      //   //'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
      //) );
//
      //$cmb->add_group_field( $group_field_id, array (
      //   'name'    => esc_html__( 'Tab Content', 'cfp' ),
      //   'id'      => 'tab_content',
      //   'type'    => 'wysiwyg',
      //   'options' => array (
      //      'textarea_rows' => 10,
      //   ),
      //   //'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
      //) );

      //\Kint::$maxLevels = 0; // 0 equals no limit
      //ddd( $cmb );
   }

   /**
    * Register settings notices for display
    *
    * @since  0.1.0
    * @param  int   $object_id Option key
    * @param  array $updated   Array of updated fields
    * @return void
    */
   public function settings_notices( $object_id, $updated ) {
      if ( $object_id !== $this->key || empty( $updated ) ) {
         return;
      }

      add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'cfp' ), 'updated' );
      settings_errors( $this->key . '-notices' );
   }

   /**
    * Public getter method for retrieving protected/private variables
    * @since  0.1.0
    * @param  string $field Field to retrieve
    * @return mixed          Field value or exception is thrown
    */
   public function __get( $field ) {
      // Allowed fields to retrieve
      if ( in_array( $field, array ( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
         return $this->{$field};
      }

      throw new Exception( 'Invalid property: ' . $field );
   }
}

/**
 * Helper function to get/return the CFP_Admin object
 * @since  0.1.0
 * @return CFP_Admin object
 */
function cfp_admin() {
   return CFP_Admin::get_instance();
}

/**
 * Wrapper function around cfp_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function cfp_get_option( $key = '', $default = false ) {
   if ( function_exists( 'cmb2_get_option' ) ) {
      // Use cmb2_get_option as it passes through some key filters.
      return cmb2_get_option( cfp_admin()->key, $key, $default );
   }

   // Fallback to get_option if CMB2 is not loaded yet.
   $opts = get_option( cfp_admin()->key, $default );

   $val = $default;

   if ( 'all' == $key ) {
      $val = $opts;
   } elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
      $val = $opts[ $key ];
   }

   return $val;
}

//add_action( 'cmb2_admin_init', 'cfp_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function cfp_register_repeatable_group_field_metabox() {
   global $prefix;
   //$prefix = 'cfp_group_';

   /**
    * Repeatable Field Groups
    */
   $cmb2 = new_cmb2_box( array (
                            'id'           => $prefix . 'metabox',
                            'title'        => esc_html__( 'Repeating Field Group', 'cfp' ),
                            'object_types' => array ( 'page' ),
                            'show_on'      => array (
                               // These are important, don't remove
                               'key'   => 'options-page',
                               'value' => 'cfp_options'  //array( $this->key, )
                            )
                         ) );

   // $group_field_id is the field id string, so in this case: $prefix . 'demo'
   $group_field_id = $cmb->add_field( array (
                                         'id'          => $prefix . 'demo',
                                         'type'        => 'group',
                                         'description' => esc_html__( 'Generates reusable form entries', 'cfp' ),
                                         'options'     => array (
                                            'group_title'   => esc_html__( 'Entry {#}', 'cfp' ), // {#} gets replaced by row number
                                            'add_button'    => esc_html__( 'Add Another Entry', 'cfp' ),
                                            'remove_button' => esc_html__( 'Remove Entry', 'cfp' ),
                                            'sortable'      => true, // beta
                                            // 'closed'     => true, // true to have the groups closed by default
                                         ),
                                      ) );

   /**
    * Group fields works the same, except ids only need
    * to be unique to the group. Prefix is not needed.
    *
    * The parent field's id needs to be passed as the first argument.
    */
   $cmb->add_group_field( $group_field_id, array (
      'name' => esc_html__( 'Entry Title', 'cfp' ),
      'id'   => 'title',
      'type' => 'text',
      // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
   ) );

   $cmb->add_group_field( $group_field_id, array (
      'name'        => esc_html__( 'Description', 'cfp' ),
      'description' => esc_html__( 'Write a short description for this entry', 'cfp' ),
      'id'          => 'description',
      'type'        => 'textarea_small',
   ) );

}

// Get it started
cfp_admin();


