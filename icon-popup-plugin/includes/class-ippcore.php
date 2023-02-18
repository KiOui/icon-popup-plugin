<?php
/**
 * Icon Popup Plugin Core.
 *
 * @package icon-popup-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'IPPCore' ) ) {
	/**
	 * IPPCore class.
	 */
	class IPPCore {

		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public string $version = '1.0.0';

		/**
		 * The unique instance of this class.
		 *
		 * @var IPPCore|null
		 */
		private static ?IPPCore $_instance = null;

		/**
		 * Spawn a unique instance of this class.
		 *
		 * @return IPPCore The unique instance of this class.
		 */
		public static function instance(): IPPCore {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * The constructor of this class.
		 */
		private function __construct() {
			$this->define_constants();
			$this->add_shortcodes();
		}

		/**
		 * Define constants of the plugin.
		 */
		private function define_constants(): void {
			$this->define( 'IPP_ABSPATH', dirname( IPP_PLUGIN_FILE ) . '/' );
			$this->define( 'IPP_VERSION', $this->version );
			$this->define( 'IPP_FULLNAME', 'icon-popup-plugin' );
		}

		/**
		 * Define if not already set
		 *
		 * @param string $name name of the variable to define.
		 * @param string $value value of the variable to define.
		 */
		private static function define( string $name, string $value ): void {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Add the shortcode.
		 */
		public function add_shortcodes(): void {
			add_shortcode( 'icon-popup', array( $this, 'do_shortcode' ) );
		}

		/**
		 * Do the shortcode.
		 *
		 * @param $atts
		 * @return string
		 */
		public function do_shortcode( $atts ): string {
			if ( gettype( $atts ) != 'array' ) {
				$atts = array();
			}

			include_once IPP_ABSPATH . 'includes/class-ippshortcode.php';
			$shortcode = new IPPShortcode( $atts );
			$return = $shortcode->do_shortcode();
			return $return ? $return : '';
		}
	}
}
