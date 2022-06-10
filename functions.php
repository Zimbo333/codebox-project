<?php
/**
 * Blossom Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blossom_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blossom_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Blossom Theme, use a find and replace
		* to change 'blossom-theme' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'blossom-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'blossom-theme' ),
			)
		);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

	// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'blossom_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

	// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'blossom_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blossom_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blossom_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'blossom_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blossom_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blossom-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blossom-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blossom_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blossom_theme_scripts() {
	wp_enqueue_style( 'blossom-theme-style', get_stylesheet_uri().'?t='.time(), array(), _S_VERSION );
	wp_style_add_data( 'blossom-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'blossom-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blossom_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



function pre($arr,$title = "Untitled"){
	echo "<h5 class='pre-title'>$title</h5>";
	echo "<pre class='system'>";
	print_r($arr);
	echo "</pre>";
}

function isAdmin(){
	$is = 0;
	if(current_user_can('administrator') ) {
		$is = 1;
	}
	return $is;
}

function isMod($course_id){
	$is = 0;
	if ($course_id == '') {
		return $is;
	}
	if(current_user_can('administrator')) {
		$is = 1;
	}else{
		$users = [];
		$ins = get_field('course_instructor');
		$mod = get_field('course_mod');
		foreach ($ins as $key => $u) {
			array_push($users, $u->data->ID);
		}
		foreach ($mod as $key => $u) {
			array_push($users, $u->data->ID);
		}
		if (in_array(get_current_user_id(),$users)) {
			$is = 1;
		}
	}
	return $is;
}

function get_user_branch($parent_id,$uid = null){
	if ($uid == null) {
		$uid = get_current_user_id();
	}
	$parent_type = get_post_type($parent_id);
	$branch_type = $parent_type.'-branch';
	$av_type = ['code','lesson','exercise'];
	if (in_array($parent_type,$av_type)) {
		$args = array(
			// 'post_parent' => $parent_id,
			'meta_key'		=> 'parent',
			'meta_value'	=> $parent_id,
			'post_type' => $branch_type,
			'author' => $uid,
			'posts_per_page' => -1

		);
		$p = new WP_Query($args);
		if ($p->post_count) {
			$b = $p->posts;
			return $b;
		}
	}else{
		return null;
	}
	
}

function get_all_branches($parent_id){
	$parent_type = get_post_type($parent_id);
	$branch_type = $parent_type.'-branch';
	$av_type = ['code','lesson','exercise'];
	if (in_array($parent_type,$av_type)) {
		$args = array(
			// 'post_parent' => $parent_id,
			'meta_key'		=> 'parent',
			'meta_value'	=> $parent_id,
			'post_type' => $branch_type,
			'posts_per_page' => -1

		);
		$p = new WP_Query($args);
		if ($p->post_count) {
			$b = $p->posts;
			return $b;
		}
	}else{
		return null;
	}
	
}

function masthead(){
	?>
	<header id="masthead" class="site-header py-4">
		<div class="container mx-auto">
			<div class="nav-wrap">
				<div class="nav-block nav-block-site noto">
					<h5 class="font-bold text-xl">
						<a href="<?=get_site_url()?>" class="">
							<i class="fas fa-code"></i> &nbsp;<?=get_bloginfo() ?>
						</a>
					</h5>
				</div>
				<div class="nav-block nav-block-menu mono">
					<?php 
					wp_nav_menu();
					?>
				</div>
				<div class="nav-block nav-block-user noto">
					<?php 
					$is_login = is_user_logged_in();
					if ($is_login) {
						$uid = get_current_user_id();
						$u = get_user_by( 'ID', $uid );
						$upic = get_avatar_url($uid, array("size"=>72));

						?>
						<div class="nav-profile-wrap">
							<div class="nav-profile">
								<div class="nav-profile-pic" style="background-image:url('<?=$upic?>')"></div>
								<h5 class="nav-profile-name"><?=$u->display_name?></h5>
							</div>
							<div class="nav-toggle-wrap">
								<div class="nav-toggle mono">
									<a href="<?=get_author_posts_url($uid)?>" class="">
										<h5>
											My Profile
										</h5>
									</a> 
									<a href="<?=wp_logout_url("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'?t='.time())?>" class="">
										<h5>
											Logout 👋
										</h5>
									</a> 
								</div>
							</div>
						</div>
						
						<?php
					}else{
						?>
						<a class="sign-in" href="/?google_redirect&redirect_to=<?=urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'?t='.time())?>&reauth=1" class="">Login &nbsp;<i class="fas fa-arrow-right text-xs"></i>
						</a>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php
}