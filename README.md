# WPSPPagination
WPSPPagination - WP Single Post Pagination

```PHP
 // Usage:
 $WP_SINGLE_POST_PAHINATION = new WPSPPagination([
  
  'post_type' => 'post' // for custom post_type ['post','blog','news']

 ]);
 
 // Render the post link
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination());
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination());
  
 // Render the post title
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_prev_post_title());
 echo ($WP_SINGLE_POST_PAHINATION->get_wp_sp_pagination_next_post_title());
```
