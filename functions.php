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
