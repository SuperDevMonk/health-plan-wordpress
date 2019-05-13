<?php
namespace lsx_health_plan\classes;
/**
 * LSX Health Plan Admin Class.
 *
 * @package lsx-health-plan
 */
class Post_Type {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_health_plan\classes\Post_Type()
	 */
	protected static $instance = null;

	/**
	 * The post types available
	 *
	 * @var array
	 */
	public $post_types = array();

	/**
	 * The related post type connections
	 *
	 * @var array
	 */
	public $connections = array();	

	/**
	 * Contructor
	 */
	public function __construct() {
		$this->enable_post_types();
		add_filter( 'lsx_health_plan_post_types', array( $this, 'enable_post_types' ) );
		foreach ( $this->post_types as $post_type ) {
			require_once( LSX_HEALTH_PLAN_PATH . 'classes/class-' . $post_type . '.php' );
			$classname = ucwords( $post_type );
			$this->$post_type = call_user_func_array( '\\lsx_health_plan\classes\\' . $classname . '::get_instance', array() );
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx_health_plan\classes\Post_Type()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Enable our post types
	 *
	 * @return void
	 */
	public function enable_post_types() {
		$this->post_types = array(
			'plan',
			'workout',
			'meal',
			'recipe',
			'tip',
		);
		return $post_types;
	}
}
