/* Limit Excerpt to 20 - better solution is Advanced Excerpt (http://basvd.com/code/advanced-excerpt/) */
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



/* Add Excerpt to pages */
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'my_add_excerpts_to_pages' );



/* Translate month in archive to croatian */
function translate_archive_month($list) {
    $patterns = array(
        '/January/', '/February/', '/March/', '/April/', '/May/', '/June/',
        '/July/', '/August/', '/September/', '/October/',  '/November/', '/December/'
    );
    $replacements = array(
        'Siječanj', 'Veljača', 'Ožujak', 'Travanj', 'Svibanj', 'Lipanj', 
        'Srpanj', 'Kolovoz', 'Rujan', 'Listopad', 'Studeni', 'Prosinac'
    );    
    $list = preg_replace($patterns, $replacements, $list);
    return $list; 
}

add_filter('get_archives_link', 'translate_archive_month');



/* include some script or style (/javascripts/enquire.js) */
function wp_enquire_js(){
    wp_register_script( 'wp-enquire-js', get_template_directory_uri() . '/javascripts/enquire.js');
    wp_enqueue_script( 'wp-enquire-js' );
}

add_action('wp_enqueue_scripts', 'wp_enquire_js');


/* custom menu with images (in theme call with "<?php wp_nav_menu( array( 'menu' => 'Image Menu' ) ); ?>" ) */
add_filter('wp_nav_menu_objects', 'ad_filter_menu', 10, 2);
function ad_filter_menu($sorted_menu_objects, $args) {

    // here we check for the menu with name 'Image Menu' (name of menu under Appearance > Menus)
    // wp_nav_menu( array( 'menu' => 'Image Menu' ) );
    if ($args->menu != 'Image Menu')
        return $sorted_menu_objects;

    foreach ($sorted_menu_objects as $menu_object) {
        if ( in_array($menu_object->object, array('post', 'page', 'any_post_type')) ) {
            $menu_object->title = has_post_thumbnail($menu_object->object_id) ? get_the_post_thumbnail($menu_object->object_id, 'thumbnail') .''. $menu_object->title : $menu_object->title;
        }
    }

    return $sorted_menu_objects;
}


/* sidebars: 
    to add more sidebars copy  and edit the sidebar code.    
    copy the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be: sidebar-sidebar-en.php
    
*/
register_sidebar(array(
    'id' => 'sidebar-en', // lovercase wthout spaces
    'name' => 'Main Sidebar EN',
    'description' => 'Used on EN every page BUT the homepage page template.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
));

/*  Post (single.php)
    Diferent categories with diferent post templates
    Gets post cat slug and looks for single-[cat slug].php and applies it
*/
add_filter('single_template', create_function(
    '$the_template',
    'foreach( (array) get_the_category() as $cat ) {
        if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
        return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
    return $the_template;' )
);
