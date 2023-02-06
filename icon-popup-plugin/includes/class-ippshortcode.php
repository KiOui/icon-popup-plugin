<?php
/**
 * Icon Popup Plugin Shortcode.
 *
 * @package icon-popup-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'IPPShortcode' ) ) {
	/**
	 * IPPShortcode class.
	 */
	class IPPShortcode {

		/**
		 * Identifier of slider.
		 *
		 * @var string
		 */
		private string $id;

		/**
		 * Class of slider.
		 *
		 * @var string
		 */
		private string $class;

		/**
		 * Badge text.
		 *
		 * @var ?string
		 */
		private ?string $badge_text;

		/**
		 * Icon css class.
		 *
		 * @var ?string
		 */
		private ?string $icon;

		/**
		 * Popup title.
		 *
		 * @var ?string
		 */
		private ?string $popup_title;

		/**
		 * Popup text.
		 *
		 * @var ?string
		 */
		private ?string $popup_text;

		/**
		 * Badge color.
		 *
		 * @var ?string
		 */
		private ?string $badge_color;

		/**
		 * Text color.
		 *
		 * @var ?string
		 */
		private ?string $text_color;

		/**
		 * Construct a shortcode.
		 *
		 * @param array $atts The attributes of the shortcode.
		 */
		public function __construct( array $atts = array() ) {
			if ( key_exists( 'id', $atts ) && 'string' === gettype( $atts['id'] ) ) {
				$this->id = $atts['id'];
			} else {
				$this->id = uniqid();
			}
			if ( key_exists( 'class', $atts ) && 'string' === gettype( $atts['class'] ) ) {
				$this->class = $atts['class'];
			}
			if ( key_exists( 'badge_text', $atts ) && 'string' === gettype( $atts['badge_text'] ) ) {
				$this->badge_text = $atts['badge_text'];
			} else {
				$this->badge_text = null;
			}
			if ( key_exists( 'icon', $atts ) && 'string' === gettype( $atts['icon'] ) ) {
				$this->icon = $atts['icon'];
			} else {
				$this->icon = null;
			}
			if ( key_exists( 'popup_title', $atts ) && 'string' === gettype( $atts['popup_title'] ) ) {
				$this->popup_title = $atts['popup_title'];
			} else {
				$this->popup_title = null;
			}
			if ( key_exists( 'popup_text', $atts ) && 'string' === gettype( $atts['popup_text'] ) ) {
				$this->popup_text = $atts['popup_text'];
			} else {
				$this->popup_text = null;
			}
			if ( key_exists( 'badge_color', $atts ) && gettype( $atts['badge_color'] ) == 'string' ) {
				$this->badge_color = sanitize_hex_color( $atts['badge_color'] );
			} else {
				$this->badge_color = null;
			}
			if ( key_exists( 'text_color', $atts ) && gettype( $atts['text_color'] ) == 'string' ) {
				$this->text_color = sanitize_hex_color( $atts['text_color'] );
			} else {
				$this->text_color = null;
			}
			$this->include_styles_and_scripts();
		}

		/**
		 * Include all styles and scripts required for this slider to work.
		 */
		public function include_styles_and_scripts(): void {
			wp_enqueue_style( 'ipp-shortcode', IPP_PLUGIN_URI . 'assets/badges/css/ipp-badges.css', array(), '1.0' );
			if ( isset( $this->popup_text ) ) {
				wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), '5.2.3' );
				wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '5.2.3' );
			}
		}

		/**
		 * Get the ID of this slider.
		 *
		 * @return string
		 */
		public function get_id(): string {
			return $this->id;
		}

		/**
		 * Get the contents of the shortcode.
		 *
		 * @return false|string
		 */
		public function do_shortcode() {
			ob_start(); ?>
			<div class="ipp-badge 
			<?php
			if ( isset( $this->class ) ) {
				echo esc_attr( $this->class ); }
			?>
			" id="<?php echo esc_attr( $this->get_id() ); ?>"
				 style="
			<?php if ( isset( $this->badge_color ) ) : ?>
					background-color: <?php echo esc_attr( $this->badge_color ); ?>;
					<?php endif ?>
			<?php if ( isset( $this->popup_text ) ) : ?>
					cursor: pointer;
			<?php endif; ?>
					"
				<?php if ( isset( $this->popup_text ) ) : ?>
					data-bs-toggle="modal" data-bs-target="#ipp-badge-modal-<?php echo esc_attr( $this->id ); ?>"
				<?php endif; ?>
			>
				<?php if ( isset( $this->icon ) ) : ?>
					<span class="ipp-badge-icon"
															<?php if ( isset( $this->text_color ) ) : ?>
																style="color: <?php echo esc_attr( $this->text_color ); ?>;"
															<?php endif ?>
						>
							<i class="<?php echo esc_attr( $this->icon ); ?>"></i>
						</span>
				<?php endif; ?>
				<?php if ( isset( $this->badge_text ) ) : ?>
					<span class="ipp-badge-text"
															<?php if ( isset( $this->text_color ) ) : ?>
																style="color: <?php echo esc_attr( $this->text_color ); ?>;"
															<?php endif ?>
						><?php echo esc_html( $this->badge_text ); ?></span>
				<?php endif; ?>
			</div>
			<?php if ( isset( $this->popup_text ) ) : ?>
				<div class="modal fade" id="ipp-badge-modal-<?php echo esc_attr( $this->id ); ?>" tabindex="-1"
					 aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header">
								<?php if ( isset( $this->popup_title ) ) : ?>
									<h5 class="modal-title"><?php echo esc_html( $this->popup_title ); ?></h5>
								<?php endif; ?>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php echo esc_html( $this->popup_text ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php
			$ob_content = ob_get_contents();
			ob_end_clean();

			return $ob_content;
		}
	}
}
