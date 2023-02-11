<?php 

/**
 * @copyright (c) 2023 WP Single Post Pagination
 *
 * MIT License
 *
 * WP Single Post Pagination v1.2 free software: you can redistribute it and/or modify.
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @category   WP Single Post Pagination
 * @package    Single post pagination
 *            
 *            
 * @author    Leinner Zednanref <nielsoffice.wordpress.php@gmail.com>
 * @license   MIT License
 * @link      https://github.com/nielsoffice/WPSPPagination
 * @link      https://github.com/nielsoffice/WPSPPagination
 * @version   v1.2
 * @since     02.10.2023
 *
 */

 class WPSPPagination {

  /**
   * Defined: @var @property wp_request_holding_argu
   * @since 1.0.0.0 
   * @since 02.10.2023 **/   	
   private $wp_request_post_type; 

  /**
   * Defined: @var @property wp_sub_directory
   * @since 1.0.0.0 
   * @since 02.10.2023 **/
   private $wp_sub_directory;

  /**
   * Defined: @var @property wp_orderby
   * @since 1.0.0.0 
   * @since 02.10.2023 **/
   private $wp_orderby;
   
   public function __construct( $args = [] )
   {
 
     $this->wp_request_post_type = $args['post_type'] ?? [];
     $this->wp_sub_directory = $args['sub_directory'] ?? '';    
     $this->wp_orderby = $args['orderby'] ?? '';

   }

  /** 
    * Defined : Processing pagination title loop
    * @method Private wp_single_post_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   private function set_wp_single_post_previous_pagination() {  

      global $wpdb;

      $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query(false, false ));
      $wp_request = json_decode(json_encode($wp_request), true);	
      $wp_request = $wp_request[0]['post_name'];

      $currentURL = $this->wp_domain_sub_directory( $this->wp_sub_directory );
      $currentURL .= '/';
      $currentURL .= $wp_request;

      return ($currentURL);
      
   }

  /** 
    * Defined : Processing pagination title loop
    * @method Private wp_single_post_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   private function set_wp_single_post_next_pagination() { 
   
      global $wpdb;

      $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query( true , false));
      $wp_request = json_decode(json_encode($wp_request), true);	
      $wp_request = $wp_request[0]['post_name'];

      $currentURL = $this->wp_domain_sub_directory( $this->wp_sub_directory );
      $currentURL .= '/';
      $currentURL .= $wp_request;

      return ($currentURL);

   }

  /** 
    * Defined : request custom post type url sub directory
    * @method Private wp_domain_sub_directory
    * @since v1.0 
    * @since 02.10.2022 **/
   private function wp_domain_sub_directory($sub_directory) {
     
    $set_wp_domain_sub_directory = ( empty($sub_directory) ) ? '' : '/'.$sub_directory.'';
    return get_site_url() . $set_wp_domain_sub_directory;

   }

  /** 
    * Defined : Processing pagination title loop
    * @method Private set_wp_sp_pagination_prev_post_title
    * @since v1.0   
    * @since 02.10.2022 **/
   private function set_wp_sp_pagination_prev_post_title() {

      global $wpdb;
  
      $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query(false, true));
      $wp_request = json_decode(json_encode($wp_request), true);	
      $wp_request = $wp_request[0]['post_title'];

      return $wp_request;
  
    }
  
  /** 
    * Defined : Processing pagination title loop
    * @method Private set_wp_sp_pagination_next_post_title
    * @since v1.0 
    * @since 02.10.2022 **/
    private function set_wp_sp_pagination_next_post_title() {
  
     global $wpdb;
  
     $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query(true, true));
     $wp_request = json_decode(json_encode($wp_request), true);	
     $wp_request = $wp_request[0]['post_title'];
  
     return $wp_request; 

   }

  /** 
    * Defined : Processing html collection 
    * @method Private wp_sp_pagination_entity
    * @since v1.0 
    * @since 02.10.2022 **/
   private function wp_sp_pagination_modal_pagination_query( $left, $wp_postRequest ) {
      
     global $post;

     $order_by = mb_strtolower($this->wp_orderby ,'UTF-8');
     $order_by = (!is_string( $order_by ))?  false :  $order_by;

     var_dump( $order_by );

     if( $order_by === false ) { return; }

      switch ($order_by) {

        case 'date':
        return $this->wp_pagination_order_by_request( $post->post_date, 'post_date', $left, $wp_postRequest );  
        break;

        case 'id':
        return $this->wp_pagination_order_by_request( $post->ID, 'id', $left, $wp_postRequest ); 
        break;

        case 'author' :
        return $this->wp_pagination_order_by_request( $post->post_author, 'post_author', $left, $wp_postRequest ); 
        break;

        case 'type' :
        return $this->wp_pagination_order_by_request( $post->post_type, 'post_type', $left, $wp_postRequest ); 
        break;

        case 'rand' :
        return $this->wp_pagination_order_by_request( $post->ID, 'rand', $left, $wp_postRequest ); 
        break;

        case 'comment_count' :
        return $this->wp_pagination_order_by_request( $post->comment_count, 'comment_count', $left, $wp_postRequest); 
        break;
        
        default:
          return "Invalid request orderby list avaliable are 
            [ 
              'orderby' => 'date' 
              'orderby' => 'id' 
              'orderby' => 'author' 
              'orderby' => 'type' 
              'orderby' => 'rand' 
              'orderby' => 'comment_count'           
            ]
            
            Reference: https://developer.wordpress.org/reference/classes/wp_query/#order-orderby-parameters
            
            ";

          break;
      }   

   }

  private function wp_pagination_order_by_request( $post_order_by_query, $order_by,  $left = false , $wp_postRequest = false ) {
      
    // sanitation !
    $post_type_query = is_array($this->wp_request_post_type ) ? $this->wp_request_post_type : $this->wp_request_post_type;
    $post_prev_next_condition  = (!$left === false) ? '<' : '>';
    $post_prev_next_order      = (!$left === false) ? 'DESC' : 'ASC';
    $post_wp_postRequest_title = (!$wp_postRequest === false) ? 'post_title' : 'post_name';
    $post_wp_rand_id           = ( (!empty($order_by) && $order_by === 'rand') ) ?  'id' : $order_by;
    $post_wp_rand              = ( (!empty($order_by) && $order_by === 'rand') ) ? 'rand()': (((!empty($order_by) && $order_by === 'post_author')) ? 'post_date' : $order_by) ;
    $post_type_query_array     = implode('', $this->wp_post_type_is_array($post_type_query)[0]);
       
    // Post author 
    $wp_post_author_post_prev_next_condition = ( (!empty($order_by) && $order_by === 'post_author') ) ?  '=' : $post_prev_next_condition; 

    // remove condition and post order request ex $post->ID if the post->post_title !
    // remove the title itself and post order request ex $post->ID if the post->post_title !
    $wp_post_author_post_prevnextcondition = (  $order_by === 'post_title'  || $order_by === 'post_name' ) ? false : 'AND '.$post_wp_rand_id.' '.$wp_post_author_post_prev_next_condition;
    $post_date_query_ = ( $order_by === 'post_title' || $order_by === 'post_name') ? false : " '$post_order_by_query' ";

    // Return query pagination by request !
    $wp_post_query_  = '';
    $wp_post_query_ .= " SELECT $post_wp_postRequest_title ";
    $wp_post_query_ .= " FROM wp_posts ";
    $wp_post_query_ .= " WHERE post_status = 'publish' ";
    $wp_post_query_ .= " $wp_post_author_post_prevnextcondition ";
    $wp_post_query_ .= " $post_date_query_ "; 
    $wp_post_query_ .=   $post_type_query_array;
    $wp_post_query_ .= " ORDER BY $post_wp_rand ";
    $wp_post_query_ .= " $post_prev_next_order LIMIT 1 ";
     
    return $wp_post_query_;

  } 


  /** 
    * Defined : Process multiple custom post type 
    * @method Private wp_post_type_is_array
    * @since v1.0 
    * @since 02.10.2022 **/
   private function wp_post_type_is_array($post_type_query) {

      $wp_post_query_ = [];

      if(is_array($post_type_query)) {

        foreach($post_type_query as $post => $data ) {

         if($post === 0) {
            $wp_post_query_[]= "AND post_type = '". $data ."'";
            continue;
         }  
         else { $wp_post_query_[]= " OR post_type = '". $data ."'"; }
      
        }

        return [ $wp_post_query_ ];

      } else { return [ [ "AND post_type = '". $post_type_query ."' " ] ]; }

   }

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_single_post_previous_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_single_post_previous_pagination() { return ($this->set_wp_single_post_previous_pagination());}

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_single_post_next_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_single_post_next_pagination() { return ($this->set_wp_single_post_next_pagination()); }

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_sp_pagination_prev_post_title
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_sp_pagination_prev_post_title() { return ($this->set_wp_sp_pagination_prev_post_title());}

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_sp_pagination_next_post_title
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_sp_pagination_next_post_title() { return ($this->set_wp_sp_pagination_next_post_title()); }
 
 } 

