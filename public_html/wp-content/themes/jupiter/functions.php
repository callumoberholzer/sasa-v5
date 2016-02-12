<?php

/**
 * Class and Function List:
 * Function list:
 * - init()
 * - constants()
 * - widgets()
 * - plugins()
 * - supports()
 * - post_types()
 * - functions()
 * - language()
 * - admin_menus()
 * - add_metaboxes()
 * - theme_activated()
 * - _load_demo_content_page()
 * - _load_option_page()
 * Classes list:
 * - Theme
 */
$theme = new Theme();
$theme->init(array(
    "theme_name" => "Jupiter",
    "theme_slug" => "JP"
));

if (!isset($content_width)) {
    $content_width = 1140;
}

class Theme
{
    function init($options) {
        $this->constants($options);
        add_action('init', array(&$this,
            'language'
        ));
        $this->functions();
        $this->helpers();
        $this->admin();
        $this->actions();
        $this->classes();
        $this->plugins();
        $this->post_types();
        add_action('admin_menu', array(&$this,
            'admin_menus'
        ));
        add_action('init', array(&$this,
            'add_metaboxes'
        ));
        $this->theme_activated();
        
        add_action('after_setup_theme', array(&$this,
            'supports'
        ));
        add_action('widgets_init', array(&$this,
            'widgets'
        ));
    }
    
    function constants($options) {
        define("THEME_DIR", get_template_directory());
        define("THEME_DIR_URI", get_template_directory_uri());
        define("THEME_NAME", $options["theme_name"]);
        if (defined("ICL_LANGUAGE_CODE")) {
            $lang = "_" . ICL_LANGUAGE_CODE;
        } 
        else {
            $lang = "";
        }
        define("THEME_OPTIONS", $options["theme_name"] . '_options' . $lang);
        define("THEME_SLUG", $options["theme_slug"]);
        define("THEME_STYLES", THEME_DIR_URI . "/stylesheet/css");
        define("THEME_IMAGES", THEME_DIR_URI . "/images");
        define("THEME_JS", THEME_DIR_URI . "/js");
        define('FONTFACE_DIR', THEME_DIR . '/fontface');
        define('FONTFACE_URI', THEME_DIR_URI . '/fontface');
        define("THEME_FRAMEWORK", THEME_DIR . "/framework");
        define("THEME_PLUGINS", THEME_FRAMEWORK . "/plugins");
        define("THEME_ACTIONS", THEME_FRAMEWORK . "/actions");
        define("THEME_PLUGINS_URI", THEME_DIR_URI . "/framework/plugins");
        define("THEME_SHORTCODES", THEME_FRAMEWORK . "/shortcodes");
        define("THEME_WIDGETS", THEME_FRAMEWORK . "/widgets");
        define("THEME_SLIDERS", THEME_FRAMEWORK . "/sliders");
        define("THEME_HELPERS", THEME_FRAMEWORK . "/helpers");
        define("THEME_FUNCTIONS", THEME_FRAMEWORK . "/functions");
        define("THEME_CLASSES", THEME_FRAMEWORK . "/classes");
        define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
        define('THEME_METABOXES', THEME_ADMIN . '/metaboxes');
        define('THEME_ADMIN_POST_TYPES', THEME_ADMIN . '/post-types');
        define('THEME_GENERATORS', THEME_ADMIN . '/generators');
        define('THEME_ADMIN_URI', THEME_DIR_URI . '/framework/admin');
        define('THEME_ADMIN_ASSETS_URI', THEME_DIR_URI . '/framework/admin/assets');
    }
    function widgets() {
        require_once locate_template("widgets/widgets-contact-form.php");
        require_once locate_template("widgets/widgets-contact-info.php");
        require_once locate_template("widgets/widgets-gmap.php");
        require_once locate_template("widgets/widgets-popular-posts.php");
        require_once locate_template("widgets/widgets-related-posts.php");
        require_once locate_template("widgets/widgets-recent-posts.php");
        require_once locate_template("widgets/widgets-social-networks.php");
        require_once locate_template("widgets/widgets-subnav.php");
        require_once locate_template("widgets/widgets-testimonials.php");
        require_once locate_template("widgets/widgets-twitter-feeds.php");
        require_once locate_template("widgets/widgets-video.php");
        require_once locate_template("widgets/widgets-flickr-feeds.php");
        require_once locate_template("widgets/widgets-instagram-feeds.php");
        require_once locate_template("widgets/widgets-news-slider.php");
        require_once locate_template("widgets/widgets-recent-portfolio.php");
        require_once locate_template("widgets/widgets-slideshow.php");
        register_widget("Artbees_Widget_Popular_Posts");
        register_widget("Artbees_Widget_Recent_Posts");
        register_widget("Artbees_Widget_Related_Posts");
        register_widget("Artbees_Widget_Twitter");
        register_widget("Artbees_Widget_Contact_Form");
        register_widget("Artbees_Widget_Contact_Info");
        register_widget("Artbees_Widget_Social");
        register_widget("Artbees_Widget_Sub_Navigation");
        register_widget("Artbees_Widget_Google_Map");
        register_widget("Artbees_Widget_Testimonials");
        register_widget("Artbees_Widget_video");
        register_widget("Artbees_Widget_Flickr_feeds");
        register_widget("Artbees_Widget_Instagram_Feeds");
        register_widget("Artbees_Widget_News_Feed");
        register_widget("Artbees_Widget_Recent_Portfolio");
        register_widget("Artbees_Widget_Slideshow");
    }
    function plugins() {
        require_once locate_template("wpml-fix/mk-wpml.php");
    }
    function supports() {
        
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('automatic-feed-links');
        add_theme_support('editor-style');
        register_nav_menus(array(
            'primary-menu' => __('Primary Navigation', "mk_framework"),
            'second-menu' => __('Second Navigation', "mk_framework"),
            'third-menu' => __('Third Navigation', "mk_framework"),
            'fourth-menu' => __('Fourth Navigation', "mk_framework"),
            'fifth-menu' => __('Fifth Navigation', "mk_framework"),
            'sixth-menu' => __('Sixth Navigation', "mk_framework"),
            "seventh-menu" => __('Seventh Navigation', "mk_framework"),
            "eighth-menu" => __('Eighth Navigation', "mk_framework"),
            "ninth-menu" => __('Ninth Navigation', "mk_framework"),
            "tenth-menu" => __('tenth Navigation', "mk_framework"),
            'footer-menu' => __('Footer Navigation', "mk_framework"),
            'toolbar-menu' => __('Header Toolbar Navigation', "mk_framework"),
            'side-dashboard-menu' => __('Side Dashboard Navigation', "mk_framework"),
            'fullscreen-menu' => __('Full Screen Navigation', "mk_framework")
        ));
        add_theme_support('post-thumbnails');
        add_image_size('jupiter-full-width', 1140, 580, true);
    }
    function post_types() {
        include_once (THEME_ADMIN_POST_TYPES . '/portfolio.php');
        include_once (THEME_ADMIN_POST_TYPES . '/news.php');
        include_once (THEME_ADMIN_POST_TYPES . '/faq.php');
        include_once (THEME_ADMIN_POST_TYPES . '/employee.php');
        include_once (THEME_ADMIN_POST_TYPES . '/pricing.php');
        include_once (THEME_ADMIN_POST_TYPES . '/clients.php');
        include_once (THEME_ADMIN_POST_TYPES . '/testimonials.php');
        include_once (THEME_ADMIN_POST_TYPES . '/slideshow.php');
        include_once (THEME_ADMIN_POST_TYPES . '/edge_slider.php');
        include_once (THEME_ADMIN_POST_TYPES . '/icarousel.php');
        include_once (THEME_ADMIN_POST_TYPES . '/banner_builder.php');
        include_once (THEME_ADMIN_POST_TYPES . '/animated_columns.php');
        include_once (THEME_ADMIN_POST_TYPES . '/tab_slider.php');
    }
    function functions() {
        include_once (ABSPATH . 'wp-admin/includes/plugin.php');
        require_once (THEME_FUNCTIONS . "/general-functions.php");
        require_once (THEME_FUNCTIONS . "/bfi_cropping.php");
        require_once (THEME_FUNCTIONS . "/vc-integration.php");
        require_once (THEME_FUNCTIONS . "/ajax-search.php");
        require_once (THEME_FUNCTIONS . "/post-pagination.php");


        
        require_once (THEME_FUNCTIONS . "/enqueue-front-scripts.php");
        require_once (THEME_GENERATORS . '/sidebar-generator.php');
        require_once (THEME_FRAMEWORK . "/tgm-plugin-activation/request-plugins.php");
        require_once (THEME_FUNCTIONS . "/dynamic-styles.php");
        require_once (THEME_FUNCTIONS . "/mk-woocommerce.php");

        require_once (THEME_DIR . "/demo-importer/functions.php");
    }
    function actions() {
        require_once locate_template('framework/actions/header.php');
        require_once locate_template('framework/actions/general.php');
        require_once locate_template('framework/actions/post.php');
        require_once locate_template('framework/actions/slideshow.php');
    }
    function helpers() {
        require_once (THEME_HELPERS . "/global.php");
        require_once (THEME_HELPERS . "/head.php");
        require_once (THEME_HELPERS . "/schema-markup.php");
    }
    function classes() {
        require_once (THEME_CLASSES . "/love-this.php");
        require_once (THEME_CLASSES . "/wp-nav-custom-walker.php");
    }
    function admin() {
        if (is_admin()) {
            include_once (THEME_ADMIN . '/general/general-functions.php');
            include_once (THEME_ADMIN . '/general/mega-menu.php');
            include_once (THEME_ADMIN . '/general/icon-library.php');
            include_once (THEME_ADMIN . '/generators/option-generator.php');
            include_once (THEME_ADMIN . '/general/backend-enqueue-scripts.php');
            include_once (THEME_ADMIN . '/admin-panel/masterkey-ajax-calls.php');
        }
    }
    function language() {
        
        load_theme_textdomain('mk_framework', get_stylesheet_directory() . '/languages');
    }
    
    function add_metaboxes() {
        include_once (THEME_GENERATORS . '/metabox-generator.php');
        include_once (THEME_METABOXES . '/metabox-posts.php');
        include_once (THEME_METABOXES . '/metabox-employee.php');
        include_once (THEME_METABOXES . '/metabox-slideshow.php');
        include_once (THEME_METABOXES . '/metabox-clients.php');
        include_once (THEME_METABOXES . '/metabox-testimonials.php');
        include_once (THEME_METABOXES . '/metabox-icarousel.php');
        include_once (THEME_METABOXES . '/metabox-pricing.php');
        include_once (THEME_METABOXES . '/metabox-banner-video.php');
        include_once (THEME_METABOXES . '/metabox-news.php');
        include_once (THEME_METABOXES . '/metabox-edge.php');
        include_once (THEME_METABOXES . '/metabox-portfolios.php');
        include_once (THEME_METABOXES . '/metabox-posts-slideshow.php');
        include_once (THEME_METABOXES . '/metabox-skinning.php');
        include_once (THEME_METABOXES . '/metabox-animated-columns.php');
        include_once (THEME_METABOXES . '/metabox-tab-slider.php');
        include_once (THEME_METABOXES . '/metabox-pages.php');
        include_once (THEME_METABOXES . '/metabox-footer-widgets.php');
    }
    
    function theme_activated() {
        if ('themes.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['activated']) && $_GET['activated'] == 'true') {
            update_option('woocommerce_enable_lightbox', "no");
            wp_redirect(admin_url('admin.php?page=welcome'));
            flush_rewrite_rules();
        }
    }
    
    function admin_menus() {
        add_menu_page(__('Theme Options', 'mk_framework') , __('Theme Options', 'mk_framework') , 'edit_theme_options', 'masterkey', array(&$this,
            '_load_option_page'
        ) , 'dashicons-admin-network');
        
        // add_submenu_page('themes.php', 'Install Templates', 'Install Templates', 'manage_options', 'demo-importer', array(&$this,
        //     '_load_demo_content_page'
        // ));

         add_submenu_page('themes.php', 'Install Templates', 'Install Templates', 'manage_options', 'install-template', array(&$this,
            '_load_demo_install_page'
        ));

         add_menu_page(__( 'register-product', 'mk_framework') , __('Register Product', 'mk_framework') , 'manage_options', 'register-product', array(&$this,
            '_load_demo_register_page'
        ) , 'dashicons-lock', 3);

         add_submenu_page( 'register-product', 'Welcome', 'welcome', 'manage_options', 'welcome', array(&$this,
            '_welcome_page'
        ) );

        
    }
  
    function _welcome_page(){
         include_once (THEME_DIR . '/demo-importer/welcome.php');
    }
    function _load_demo_install_page() {
        include_once (THEME_DIR . '/demo-importer/install-template.php');
    }
    function _load_demo_register_page() {
        include_once (THEME_DIR . '/demo-importer/register-product.php');
    }
    
    function _load_option_page() {
        
        $page = include (THEME_ADMIN . '/admin-panel/masterkey.php');
        new mkOptionGenerator($page['name'], $page['options']);
    }
}
?>