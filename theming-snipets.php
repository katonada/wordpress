<?php
    # get page content from page, select page by ID
    $home_page_post_id = 101; # O nama
    $home_page_post = get_post( $home_page_post_id, ARRAY_A );
    $content_content = $home_page_post['post_content'];
?>



<?php
    # get page link, title, excerpt ... from page, select page by ID
    $home_page_post_id = 5; # O nama
    $home_page_post = get_post( $home_page_post_id, ARRAY_A );
    $content_link = $home_page_post['guid'];
    $content_title = $home_page_post['post_title'];
    $content_excerpt = $home_page_post['post_excerpt'];
?>

<?php
    # get post link, title, excerpt, image ... from pages, select page by category ID
	global $post;
	$tmp_post = $post;
	$args = array( 'category' => '5' );
	$myposts = get_posts( $args );
	foreach( $myposts as $post ) :	setup_postdata($post); 
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' ); /* full image size */
?>
    <img src="<?php echo $featured_src[0] ?>" alt="">

	<?php the_title(); ?>
	<?php the_excerpt(); ?>
	<?php the_permalink(); ?>


<?php 
    # to load some other header, footer, sidebar ...
    get_sidebar('some_name'); // create sidebar-some_name.php 
?>
