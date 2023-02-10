# WPSPPagination
WPSPPagination - WP Single Post Pagination

```PHP
 // Usage:
 $SB_SINGLE_POST_PAHINATION = new WPSPPagination([
  
  'post_type' => 'post' // for custom post_type ['post','blog','news']

 ]);

 echo ($SB_SINGLE_POST_PAHINATION->get_wp_single_post_previous_pagination());
 echo ($SB_SINGLE_POST_PAHINATION->get_wp_single_post_next_pagination());
  
```
