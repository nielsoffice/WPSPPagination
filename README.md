# WPSPPagination
WPSPPagination - WP Single Post Pagination alternative solution for drag and drop template builder

```PHP
  // Main page Require Query 
   $args = [
	
     'posts_per_page' => 11,
     'post_type'      => 'blog',
     'orderby'        => 'date', // must be query by 'date' OR 'id' OR 'author' OR 'type' OR  'rand' OR 'comment_count'  
     'order'          => 'DESC', // must be DESC
	  
  ];
  
  // Parent page or main page query 
  $wp_require_query = new WP_Query($args);
   
  // On single page 
  // Usage:
  $WP_SINGLE_POST_PAHINATION = new WPSPPagination([
  
     'post_type'     => 'post', // for custom post_type ['post','blog','news']
     'sub_directory' => 'blog', // www.domain.com/sub_directory/post-title
     'orderby'       => 'date'  // 'date' OR 'id' OR 'author' OR 'type' OR  'rand' OR 'comment_count'  make sure the same as parent query!
  
  ]);
 
  // Render the post link
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination());
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination());

  // Get post link First and Last
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination('get_post_link_first'));
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination('get_post_link_last'));
 
  // Render the post title
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title());
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title());
 
  // Get post title First and Last
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title('get_post_title_first'));
  echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title('get_post_title_last'));
 
```

```PHP
  // Prev Page Configartion Sanitize if the return value is empty!
  $prevTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title(); 
  $wp_firstTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title('get_post_title_first'));
  function getLinkPrev($WP_SINGLE_POST_PAGINATION) {
  
    $wp_left = $WP_SINGLE_POST_PAGINATION->get_wp_single_post_previous_pagination();
    $wp_firstLink = $WP_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination('get_post_link_first');
   
    if( !empty($wp_left) ) { return $wp_left;  
    } else { return $wp_firstLink; }
	  
  }
  
  // Next Page configuration Sanitize if the return value is empty!
  $nextTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title(); 
  $wp_LastTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title('get_post_title_last'));
  function getLinkNext($WP_SINGLE_POST_PAGINATION) {
  
    $sb_right = $WP_SINGLE_POST_PAGINATION->get_wp_single_post_next_pagination();
    $wp_firstLink = $WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination('get_post_link_last');
   
    if( !empty($sb_right) ) { return $sb_right;  
    } else { return  $wp_firstLink; }
	  
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
		
<div id="reightPrevious" class="sb-next">
  <a href="<?php echo (getLinkNext($WP_SINGLE_POST_PAHINATION) ); ?>">
  <?php echo ( !empty($nextTitle) ? $nextTitle : 'No more post!...' )?>
  </a>	
</div>
</div>	
```

```HTML  
<!-- rendered HTML  return last Title and Last link post !-->
<div id="sb_pagination_container">	
<div id="leftPrevious" class="sb-previous">
  <a href="<?php echo (getLinkPrev($WP_SINGLE_POST_PAHINATION) ); ?>">
  <?php echo ( !empty($prevTitle) ? $prevTitle : $wp_firstTitle )?>
  </a>	
</div>
		
<div id="reightPrevious" class="sb-next">
  <a href="<?php echo (getLinkNext($WP_SINGLE_POST_PAHINATION) ); ?>">
  <?php echo ( !empty($nextTitle) ? $nextTitle : $wp_LastTitle )?>
  </a>	
</div>
</div>	
```
