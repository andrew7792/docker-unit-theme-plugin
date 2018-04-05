<?php
/**
 * _s functions and definitions
 *
 * @package unite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}

/**
 * Set the content width for full width pages with no sidebar.
 */
function unite_content_width() {
  if ( is_page_template( 'page-fullwidth.php' ) || is_page_template( 'front-page.php' ) ) {
    global $content_width;
    $content_width = 1110; /* pixels */
  }
}
add_action( 'template_redirect', 'unite_content_width' );


if ( ! function_exists( 'unite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function unite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'unite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'unite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'unite-featured', 730, 410, true );
	add_image_size( 'tab-small', 60, 60 , true); // Small Thumbnail

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'unite' ),
		'footer-links' => __( 'Footer Links', 'unite' ) // secondary nav in footer
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'unite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add WooCommerce support
	add_theme_support( 'woocommerce' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

}
endif; // unite_setup
add_action( 'after_setup_theme', 'unite_setup' );


if ( ! function_exists( 'unite_widgets_init' ) ) :
/**
 * Register widgetized area and update sidebar with default widgets.
 */
function unite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'unite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar(array(
		'id'            => 'home1',
		'name'          => 'Homepage Widget 1',
		'description'   => 'Used only on the homepage page template.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
    ));

    register_sidebar(array(
		'id'            => 'home2',
		'name'          => 'Homepage Widget 2',
		'description'   => 'Used only on the homepage page template.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
    ));

    register_sidebar(array(
		'id'            => 'home3',
		'name'          => 'Homepage Widget 3',
		'description'   => 'Used only on the homepage page template.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
    ));

    register_widget( 'unite_popular_posts_widget' );
    register_widget( 'unite_social_widget' );
}
endif;
add_action( 'widgets_init', 'unite_widgets_init' );

/**
 * Include widgets for Unite theme
 */
include(get_template_directory() . "/inc/widgets/popular-posts-widget.php");
include(get_template_directory() . "/inc/widgets/widget-social.php");

/**
 * Include Metabox for Unite theme
 */
include(get_template_directory() . "/inc/metaboxes.php");



if ( ! function_exists( 'unite_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function unite_scripts() {

	wp_enqueue_style( 'unite-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

	wp_enqueue_style( 'unite-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );

	wp_enqueue_style( 'unite-style', get_stylesheet_uri() );

	wp_enqueue_script('unite-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );

	wp_enqueue_script( 'unite-functions', get_template_directory_uri() . '/inc/js/main.min.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'unite_scripts' );


if ( ! function_exists( 'unite_ie_support_header' ) ) :
/**
 * Add HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries
 */
function unite_ie_support_header() {
    echo '<!--[if lt IE 9]>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/inc/js/html5shiv.min.js' ) . '"></script>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/inc/js/respond.min.js' ) . '"></script>'. "\n";
    echo '<![endif]-->'. "\n";
}
endif;
add_action( 'wp_head', 'unite_ie_support_header', 1 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */

require get_template_directory() . '/inc/navwalker.php';

/**
 * Load social nav
 */
require get_template_directory() . '/inc/socialnav.php';

/* All Globals variables */
global $text_domain;
$text_domain = 'unite';

global $site_layout;
$site_layout = array('side-pull-left' => esc_html__('Right Sidebar', 'dazzling'),'side-pull-right' => esc_html__('Left Sidebar', 'dazzling'),'no-sidebar' => esc_html__('No Sidebar', 'dazzling'),'full-width' => esc_html__('Full Width', 'dazzling'));

// Option to switch between the_excerpt and the_content
global $blog_layout;
$blog_layout = array('1' => __('Display full content for each post', 'unite'),'2' => __('Display excerpt for each post', 'unite'));

// Typography Options
global $typography_options;
$typography_options = array(
        'sizes' => array( '6px' => '6px','10px' => '10px','12px' => '12px','14px' => '14px','15px' => '15px','16px' => '16px','18'=> '18px','20px' => '20px','24px' => '24px','28px' => '28px','32px' => '32px','36px' => '36px','42px' => '42px','48px' => '48px' ),
        'faces' => array(
                'arial'          => 'Arial',
                'verdana'        => 'Verdana, Geneva',
                'trebuchet'      => 'Trebuchet',
                'georgia'        => 'Georgia',
                'times'          => 'Times New Roman',
                'tahoma'         => 'Tahoma, Geneva',
                'Open Sans'      => 'Open Sans',
                'palatino'       => 'Palatino',
                'helvetica'      => 'Helvetica',
                'helvetica-neue' => 'Helvetica Neue,Helvetica,Arial,sans-serif'
        ),
        'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
        'color'  => true
);

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if ( ! function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {

  $option_name = '';
  // Get option settings from database
  $options = get_option( 'unite' );

  // Return specific option
  if ( isset( $options[$name] ) ) {
    return $options[$name];
  }

  return $default;
}
endif;



/*task*/

add_action( 'init', 'true_register_products' ); // Использовать функцию только внутри хука init

function true_register_products() {
    $labels = array(
        'name' => '',
        'singular_name' => 'Films', // админ панель Добавить->Функцию
        'add_new' => 'Add films',
        'add_new_item' => 'Add new film', // заголовок тега <title>
        'edit_item' => 'Edit film',
        'new_item' => 'New film',
        'all_items' => 'All films',
        'view_item' => 'Watch the film on the site',
        'search_items' => 'Search film',
        'not_found' =>  'The film was not found.',
        'not_found_in_trash' => 'There are no movies in the basket.',
        'menu_name' => 'Films' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true, // благодаря этому некоторые параметры можно пропустить
        'menu_icon' => 'dashicons-format-video', // иконка фильмов
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments')
    );
    register_post_type('product',$args);
}



// Add new taxonomy

add_action( 'init', 'create_films_taxonomies' ); // Использовать функцию только внутри хука init

function create_films_taxonomies() {
    $labels = array(
        'name'              => _x( 'Actors', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Actor', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Actors', 'textdomain' ),
        'all_items'         => __( 'All Actors', 'textdomain' ),
        'parent_item'       => __( 'Parent Actor', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Actor:', 'textdomain' ),
        'edit_item'         => __( 'Edit Actor', 'textdomain' ),
        'update_item'       => __( 'Update Actor', 'textdomain' ),
        'add_new_item'      => __( 'Add New Actor', 'textdomain' ),
        'new_item_name'     => __( 'New Actor Name', 'textdomain' ),
        'menu_name'         => ( 'Actor' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'actor' ),
    );

    register_taxonomy( 'actor', array( 'product' ), $args );

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Genres', 'textdomain' ),
        'popular_items'              => __( 'Popular Genres', 'textdomain' ),
        'all_items'                  => __( 'All Genres', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Genre', 'textdomain' ),
        'update_item'                => __( 'Update Genre', 'textdomain' ),
        'add_new_item'               => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'              => __( 'New Genre Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove genres', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used genres', 'textdomain' ),
        'not_found'                  => __( 'No writers found.', 'textdomain' ),
        'menu_name'                  => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'genre' ),
    );

    register_taxonomy( 'genre', 'product', $args );

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Country', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Country', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Country', 'textdomain' ),
        'popular_items'              => __( 'Popular Country', 'textdomain' ),
        'all_items'                  => __( 'All Country', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Country', 'textdomain' ),
        'update_item'                => __( 'Update Country', 'textdomain' ),
        'add_new_item'               => __( 'Add New Country', 'textdomain' ),
        'new_item_name'              => __( 'New Country Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate country with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove country', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used country', 'textdomain' ),
        'not_found'                  => __( 'No country found.', 'textdomain' ),
        'menu_name'                  => __( 'Country' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'country' ),
    );

    register_taxonomy( 'country', 'product', $args );

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Years', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Year', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Years', 'textdomain' ),
        'popular_items'              => __( 'Popular Years', 'textdomain' ),
        'all_items'                  => __( 'All Years', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Year', 'textdomain' ),
        'update_item'                => __( 'Update Year', 'textdomain' ),
        'add_new_item'               => __( 'Add New Year', 'textdomain' ),
        'new_item_name'              => __( 'New Year Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate Years with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove Years', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Years', 'textdomain' ),
        'not_found'                  => __( 'No Year found.', 'textdomain' ),
        'menu_name'                  => __( 'Year' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'year' ),
    );

    register_taxonomy( 'year', 'product', $args );
}

function true_custom_fields() {
    add_post_type_support( 'product', 'custom-fields'); // в качестве первого параметра название типа поста
}

add_action('init', 'true_custom_fields');


function filmsview_func( $atts )
{

    $args = array(
        'numberposts' => 5,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'include'     => array(),
        'exclude'     => array(),
        'meta_key'    => '',
        'meta_value'  =>'',
        'post_type'   => 'product',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    );

    $posts = get_posts( $args );


    foreach($posts as $post)
    { ?>
        <div>
            <?php //var_dump($post); ?>
            <h2><?=$post->post_title?></h2>
        </div>
        <div>
            <?=$post->post_modified?>
        </div>
        <div class="postContent">
            <?=$post->post_content?><br/>
            <a href="<?=$post->guid?>">Подробнее о дате выхода и стоимости билетов..</a>
        </div>
    <?php }

}

add_shortcode( 'filmsview', 'filmsview_func' );
