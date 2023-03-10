# WPSPPagination
WPSPPagination - WP Single Post Pagination alternative solution for drag and drop template builder <br />
Activated ! Multiple Custom post type and terms @since v1.3 !

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
   
   
  // On single page Cutom Post Type CPT
  // Usage: @since v1.0
  $WP_SINGLE_POST_PAHINATION = new WPSPPagination([
  
     'post_type'     => 'post', // for custom post_type ['post','blog','news']
     'sub_directory' => 'blog', // www.domain.com/sub_directory/post-title
     'orderby'       => 'date'  // 'date' OR 'id' OR 'author' OR 'type' OR  'rand' OR 'comment_count'  make sure the same as parent query!
  
  ]);
  
  // On single page post type default by terms
  /*
    For instance you have a newsletter and blog category you post them using default post type in different page?
    Let say you will use the category for layout
    category-newsletter.php
    category-blog.php 
    Both of them having different approach or layout then you wish to having pagination which only return the value 
    whose terms is "newsLetter" in the other hands you wants to return the pagination for only who have terms "blog" 
    This is the answer WP Single Post Pagination @since  v1.3!
    
     *For main query make sure your post archive display as by category name
     // Parent page or main page query 
     $wp_require_query = new WP_Query([ 'cat' => 'newsLetter' ]);

  */ 
  // Usage: @since v1.3
  $WP_SINGLE_POST_PAHINATION = new WPSPPagination([
  
     'post_type'     => 'post', // for custom post_type ['post','blog','news']
     'byterms'       => 'newsLetter', // If you use single post type and wants to display pagination by terms you can use this
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
  function getLinkPrev($WP_SINGLE_POST_PAGINATION) {
  
    $wp_left = $WP_SINGLE_POST_PAGINATION->get_wp_single_post_previous_pagination();
 
    if( !empty($wp_left) ) { return $wp_left;  
    } return;
	  
  }
  
  // Next Page configuration Sanitize if the return value is empty!
  $nextTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title(); 
   function getLinkNext($WP_SINGLE_POST_PAGINATION) {
  
    $sb_right = $WP_SINGLE_POST_PAGINATION->get_wp_single_post_next_pagination();
    $wp_firstLink = $WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination('get_post_link_last');
   
    if( !empty($sb_right) ) { return $sb_right;  
    } return;
	  
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

<h5> Get Last and First Pagination </h5>

```PHP
<?php 

   $WP_SINGLE_POST_PAHINATION = new WPSPPagination([
  
     'post_type' => 'post', // for custom post_type ['post','blog','news']
     'orderby'   => 'date'  	  

   ]);
    
   // this post if end post means last posr item
   $cD = get_site_url() .'/';

   // Prev Page Configartion Sanitize if the return value is empty!
   $prevTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title(); 
   $lastTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title('get_post_title_last');
   function getLinkPrev($WP_SINGLE_POST) {
     
      $sb_left = $WP_SINGLE_POST->get_wp_single_post_previous_pagination();
      if( !empty($sb_left) ) { return $sb_left;  }
      return;
	
   }
   
   $sb_lastLink      = $WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination('get_post_link_last');
   $leftPreviousLink = getLinkPrev($WP_SINGLE_POST_PAHINATION);
   $leftPreviousLink = ( $leftPreviousLink === $cD )? $sb_lastLink : $leftPreviousLink;
	
   // Next Page configuration Sanitize if the return value is empty!
   $nextTitle  = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title();
   $firstTitle = $WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title('get_post_title_first');
   function getLinkNext($WP_SINGLE_POST) {
    
      $sb_right = $WP_SINGLE_POST->get_wp_single_post_next_pagination();
      if( !empty($sb_right) ) { return $sb_right; } 
      return; 
	
   }

   $sb_FirsLink   = ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination('get_post_link_first'));
   $rightNextLink = getLinkNext($WP_SINGLE_POST_PAHINATION);
   $rightNextLink = ( $rightNextLink === $cD ) ? $sb_FirsLink : $rightNextLink;
 	
?>
```

```HTML  

<!-- rendered HTML  return last Title and Last link post !-->
<div id="sb_pagination_container">	
<h6 class="sb-heading-label-pagi">Read previous posted article</h6>		
<div id="leftPrevious" class="sb-previous">
  <a href="<?php echo ($leftPreviousLink); ?>">  
  <?php echo !empty($prevTitle) ? '??? '.$prevTitle : '??? '.$lastTitle; ?>
  </a>	
</div>
	
<h6 class="sb-heading-label-pagi">Read next posted article</h6>	
<div id="RightNext" class="sb-next">
  <a href="<?php echo ($rightNextLink); ?>">
  <?php echo !empty($nextTitle) ? '??? '.$nextTitle : '??? '.$firstTitle; ?>
  </a>	
</div>
</div>	

```
