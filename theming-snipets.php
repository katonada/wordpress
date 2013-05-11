<?php
    # get post content from page, select page by ID
    $home_page_post_id = 101; # O nama
    $home_page_post = get_post( $home_page_post_id, ARRAY_A );
    $content_content = $home_page_post['post_content'];
?>



<?php
    # get post link, title, excerpt ... from page, select page by ID
	$home_page_post_id = 5; # O nama
	$home_page_post = get_post( $home_page_post_id, ARRAY_A );
	$content_link = $home_page_post['guid'];
	$content_title = $home_page_post['post_title'];
	$content_excerpt = $home_page_post['post_excerpt'];
?>



<?php 
    # to load some other header, footer, sidebar ...
    get_sidebar('some_name'); // create sidebar-some_name.php 
?>
