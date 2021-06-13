<?php
/**
 *
 * @package modern-day-post-plugin
 * @author Yanike Mann
 * @copyright Yanike Mann
 *
 * @wordpress-plugin
 * Plugin Name:       Modern-Day Post Plugin
 * Description:       Modern-Day Post Plugin for WordPress
 * Version:           1.0.0
 * Requires at least: 5.2.0
 * Requires PHP:      7.3
 * Author:            Yanike Mann
 * Text Domain:       modern-day-post-plugin
 */
if (! defined('ABSPATH')) {
	die();
}

if (! defined('PLUGINTEMPLATE_DIR')) {
	define('PLUGINTEMPLATE_DIR', plugin_dir_path(__FILE__));
}

require_once PLUGINTEMPLATE_DIR . 'includes/Core.php';

class ModernDayPost
{

	public function __construct()
	{
		add_action('init', array(
			$this,
			'action_init'
		));
	}

	/**
	 * Activation of WordPress Plugin
	 */
	function activate()
	{
		// generated a Custom Post Type (CPT)
		$this->action_init();
		// flush rewrite rules
		flush_rewrite_rules(true);
	}

	/**
	 * Deactivation of WordPress Plugin
	 */
	function deactivate()
	{
		// flush rewrite rules
		flush_rewrite_rules(true);
	}

	/**
	 * Register custom post type
	 */
	public function action_init()
	{
		/*
		 * register_post_type('test_section', [
		 * 'label' => __('Test Section', 'txtdomain'),
		 * 'public' => true,
		 * 'show_in_menu' => true,
		 * 'menu_position' => 25,
		 * 'menu_icon' => 'dashicons-book',
		 * 'supports' => [
		 * 'title',
		 * 'thumbnail',
		 * 'author',
		 * 'revisions'
		 * ],
		 * 'show_in_rest' => true,
		 * 'taxonomies' => [
		 * 'test_section_item'
		 * ],
		 * 'labels' => [
		 * 'singular_name' => __('Test Section', 'txtdomain'),
		 * 'add_new_item' => __('Add new Test Section', 'txtdomain'),
		 * 'new_item' => __('New Test Section', 'txtdomain'),
		 * 'view_item' => __('View Test Section', 'txtdomain'),
		 * 'not_found' => __('No Test Sections found', 'txtdomain'),
		 * 'not_found_in_trash' => __('No Test Sections found in trash', 'txtdomain'),
		 * 'all_items' => __('All Test Sections', 'txtdomain'),
		 * 'insert_into_item' => __('Insert into test_section', 'txtdomain')
		 * ]
		 * ]);
		 *
		 * register_taxonomy('test_section_item', [
		 * 'test_section'
		 * ], [
		 * 'label' => __('Item', 'txtdomain'),
		 * 'hierarchical' => true,
		 * 'show_admin_column' => true,
		 * 'show_in_rest' => true,
		 * 'labels' => [
		 * 'singular_name' => __('Item', 'txtdomain'),
		 * 'all_items' => __('All Item', 'txtdomain'),
		 * 'edit_item' => __('Edit Item', 'txtdomain'),
		 * 'view_item' => __('View Item', 'txtdomain'),
		 * 'update_item' => __('Update Item', 'txtdomain'),
		 * 'add_new_item' => __('Add New Item', 'txtdomain'),
		 * 'new_item_name' => __('New Item Name', 'txtdomain'),
		 * 'search_items' => __('Search Items', 'txtdomain'),
		 * 'not_found' => __('No Items found', 'txtdomain')
		 * ]
		 * ]);
		 * register_taxonomy_for_object_type('test_section_item', 'test_section');
		 */
	}
}

// If class exists, create a new instance of the class
if (class_exists('ModernDayPost')) {
	$modernDayPost = new ModernDayPost();
}

// activation
register_activation_hook(__FILE__, 'active');

// activation
register_deactivation_hook(__FILE__, 'deactivate');

/**
 * Uninstallation of WordPress Plugin
 */
function plugintemplate_uninstallation()
{
	// Access the database via SQL
	global $wpdb;
	// Delete all posts of articles
	// $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'test_section'");
	// Delete all post_id data not found in wp_posts id
	// $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT ID FROM wp_posts)");
	// Delete all object_id data not found in wp_posts id
	// $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN(SELECT ID FROM wp_posts)");
}

// uninstall
register_activation_hook(__FILE__, 'plugintemplate_uninstallation');

function add_plugintemplate_stylesheet()
{
	wp_register_style('plugintemplate_style', WP_PLUGIN_URL . '/PluginTemplate/assets/styles/style.css');
	wp_enqueue_style('plugintemplate_style');
}

function add_plugintemplate_scripts()
{
	if (! is_admin()) {
		wp_register_script('plugintemplate_script', WP_PLUGIN_URL . '/PluginTemplate/assets/scripts/script.js');
		wp_enqueue_script('plugintemplate_script');
	}
}

function testSec($atts)
{
	$core = new \Core();
	$core->testSection($atts);
}

function add_plugintemplate_shortcodes()
{
	add_shortcode("plugintemplate_testsection", "testSec");
}

add_action('wp_print_styles', 'add_plugintemplate_stylesheet');
add_action('wp_print_scripts', 'add_plugintemplate_scripts');
add_action('init', 'add_plugintemplate_shortcodes');

/**
 * Grab latest articles by category
 *
 * @param array $data
 *        	Options for the function.
 * @return array null if none.
 */
function getCategoryArticles($data): array
{
	$posts = get_posts(array(
		'post_type' => 'post',
		'post_status' => 'published',
		'category_name' => $data['cat'],
		'numberposts' => 10,
		'offset' => $data['offset'],
		'order' => 'DESC'
	));
	
	$generated_articles = array();
	
	foreach ($posts as $article){
		$new_article = (array) $article;
		$new_article['image'] = get_the_post_thumbnail_url( $new_article['ID'], 'medium');
		$new_article['summary'] = get_post_meta($new_article['ID'])['summary'];
		array_push($generated_articles, $new_article);
	}

	if (empty($generated_articles)) {
		return null;
	}

	return $generated_articles;
}

add_action('rest_api_init', function () {
	register_rest_route('rest/v1', '/category/(?P<cat>\w+)/(?P<offset>\d+)', array(
		'methods' => 'GET',
		'callback' => 'getCategoryArticles'
	));
});

// Add AJAX Calls to WP
$core = new Core();
$core->ajaxCalls();
