<?php
/**
 * Display notice on admin page after theme installed before 10 days
 *
 * @package Engage_Mag
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class to display the `Upgrade to Pro` admin notice.
 *
 * Class Engage_Mag_Theme_Notice
 */
class Engage_Mag_Theme_Notice {

	/**
	 * Currently active theme in the site.
	 *
	 * @var \WP_Theme
	 */
	protected $active_theme;

	/**
	 * Current user id.
	 *
	 * @var int Current user id.
	 */
	protected $current_user_data;

	/**
	 * Constructor function for `Upgrade To Pro` admin notice.
	 *
	 * Engage_Mag_Theme_Notice constructor.
	 */
	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'engage_mag_pro_theme_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	/**
	 * Function to hold the available themes, which have pro version available.
	 *
	 * @return array Theme lists.
	 */
	public static function get_theme() {

		$theme_name = array(
			'engage mag'      => 'https://www.candidthemes.com/themes/engage-mag-pro/',
		);

		return $theme_name;

	}
	public function engage_mag_pro_theme_notice() {

		global $current_user;
		$this->current_user_data = $current_user;
		$this->active_theme      = wp_get_theme();

		if ( is_child_theme() ) {
			$this->active_theme = wp_get_theme()->parent()->get( 'Name' );
		}

		$option = get_option( 'engage_mag_theme_activate_start_time' );

		if ( ! $option ) {
			update_option( 'engage_mag_theme_activate_start_time', time() );
		}

		add_action( 'admin_notices', array( $this, 'engage_mag_pro_theme_notice_markup' ), 0 );
		add_action( 'admin_init', array( $this, 'engage_mag_pro_theme_notice_partial_ignore' ), 0 );
		add_action( 'admin_init', array( $this, 'engage_mag_pro_theme_notice_ignore' ), 0 );

	}
	public function enqueue_scripts() {

		wp_enqueue_style( 'engage-notice', get_template_directory_uri() . '/candidthemes/notice/admin-notice.css', array(), '4.5.0' );
	}
	public function engage_mag_pro_theme_notice_markup() {

		$theme_name             = self::get_theme();
		$current_theme           = strtolower( $this->active_theme );

		$theme_notice_start_time = get_option( 'engage_mag_theme_activate_start_time' );
		$buy_before_questions    = ( 'engage mag' !== $current_theme ) ? "https://www.candidthemes.com/contact/" : "https://www.candidthemes.com/contact/";
		$ignore_notice_permanent = get_user_meta( $this->current_user_data->ID, 'engage_mag_nag_engage_mag_pro_theme_notice_ignore', true );
		$ignore_notice_partially = get_user_meta( $this->current_user_data->ID, 'engage_mag_nag_engage_mag_pro_theme_notice_partial_ignore', true );

		if ( ! array_key_exists( $current_theme, $theme_name ) ) {
			return;
		}
		if ( ( $theme_notice_start_time > strtotime( '-5 days' ) ) || ( $ignore_notice_partially > strtotime( '-2 days' ) ) || ( $ignore_notice_permanent ) ) {
			return;
		}
		?>
		<div class="engage-admin-notice updated engage-pro-admin-notice">
			<p>
				<?php
				$pro_link = '<a target="_blank" href=" ' . esc_url( $theme_name[ $current_theme ] ) . ' ">' . esc_html__( 'unlock more features with pro theme', 'engage-mag' ) . '</a>';

				printf(
					esc_html__(
						/* Translators: %1$s current user display name., %2$s Currently activated theme., %3$s Pro theme link., %4$s Coupon code. */
						'Howdy, %1$s! You\'ve been using %2$s theme for a while now, and we hope you\'re happy with it. If you are looking for the premium features, you can %3$s. Moreover, you can use the coupon code %4$s to get 20 percent discount. Enjoy!', 'engage-mag'
					),
					'<strong>' . esc_html( $this->current_user_data->display_name ) . '</strong>',
					$this->active_theme,
					$pro_link,
					'<code>offer20</code>'
				);
				?>
			</p>

			<div class="links">
				<a href="<?php echo esc_url( $theme_name[ $current_theme ] ); ?>" class="btn button-primary"
				   target="_blank">
					<span class="dashicons dashicons-cart"></span>
					<span><?php esc_html_e( 'Unlock More Features', 'engage-mag' ); ?></span>
				</a>

				<a href="?engage_mag_nag_engage_mag_pro_theme_notice_partial_ignore=1" class="btn button-secondary">
					<span class="dashicons dashicons-calendar-alt"></span>
					<span><?php esc_html_e( 'Remind later', 'engage-mag' ); ?></span>
				</a>

				<a href="<?php echo esc_url( $buy_before_questions ); ?>"
				   class="btn button-secondary" target="_blank">
					<span class="dashicons dashicons-email-alt"></span>
					<span><?php esc_html_e( 'Contact Us', 'engage-mag' ); ?></span>
				</a>
			</div>

			<a class="engage-pro-admin-notice-dismiss" href="?engage_mag_nag_engage_mag_pro_theme_notice_ignore=1"></a>
		</div>

		<?php
	}
	public function engage_mag_pro_theme_notice_partial_ignore() {

		$user_id = $this->current_user_data->ID;

		if ( isset( $_GET['engage_mag_nag_engage_mag_pro_theme_notice_partial_ignore'] ) && '1' == $_GET['engage_mag_nag_engage_mag_pro_theme_notice_partial_ignore'] ) {
			update_user_meta( $user_id, 'engage_mag_nag_engage_mag_pro_theme_notice_partial_ignore', time() );
		}

	}
	public function engage_mag_pro_theme_notice_ignore() {

		$user_id = $this->current_user_data->ID;

		if ( isset( $_GET['engage_mag_nag_engage_mag_pro_theme_notice_ignore'] ) && '1' == $_GET['engage_mag_nag_engage_mag_pro_theme_notice_ignore'] ) {
			update_user_meta( $user_id, 'engage_mag_nag_engage_mag_pro_theme_notice_ignore', time() );
		}

	}
}
new Engage_Mag_Theme_Notice();
