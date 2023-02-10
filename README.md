# WPSPPagination
WPSPPagination - WP Single Post Pagination alternative solution for drag and drop template builder

```PHP
 // Main page Require Query 
   $args = [
	
	'posts_per_page' => 11,
	'post_type'      => 'blog',
	'orderby'        => 'date', // must be query by date OR post_date
        'order'          => 'DESC', // must be DESC
	  
  ];

  $wp_require_query = new WP_Query($args);
   
 // On single page 
 // Usage:
 $WP_SINGLE_POST_PAHINATION = new WPSPPagination([
  
  'post_type'     => 'post', // for custom post_type ['post','blog','news']
  'sub_directory' => 'blog'  // www.domain.com/sub_directory/post-title

 ]);
 
 // Render the post link
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination());
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination());
  
 // Render the post title
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title());
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title());
 
```

```PHP
  // Prev Page Configartion Sanitize if the return value is empty!
  $prevTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title(); 
  function getLinkPrev($WP_SINGLE_POST_PAGINATION) {
  
    $sb_left = $WP_SINGLE_POST_PAGINATION->get_wp_single_post_previous_pagination();
   
    if( !empty($sb_left) ) { return $sb_left;  
    } else { return '#'; }
	  
  }
  
  // Next Page configuration Sanitize if the return value is empty!
  $nextTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title(); 
  function getLinkNext($WP_SINGLE_POST_PAGINATION) {
  
    $sb_left = $WP_SINGLE_POST_PAGINATION->get_wp_single_post_next_pagination();
   
    if( !empty($sb_left) ) { return $sb_left;  
    } else { return '#'; }
	  
  }
  
```

```HTML  
<!-- rendered HTML -->
<div id="sb_pagination_container">	
<div id="leftPrevious" class="sb-previous">
  <a href="<?php echo (getLinkPrev($WP_SINGLE_POST_PAHINATION) ); ?>">
  <?php echo ( !empty($prevTitle) ? $prevTitle : 'No more post!...' )?>
  </a>	
</div>
		
<div id="leftPrevious" class="sb-previous">
  <a href="<?php echo (getLinkNext($WP_SINGLE_POST_PAHINATION) ); ?>">
  <?php echo ( !empty($nextTitle) ? $nextTitle : 'No more post!...' )?>
  </a>	
</div>
</div>	
```
