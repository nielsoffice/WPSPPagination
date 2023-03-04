<?php 

/**
 * @copyright (c) 2023 WP Single Post Pagination
 *
 * MIT License
 *
 * WP Single Post Pagination v1.3 free software: you can redistribute it and/or modify.
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
 * @version   v1.3
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

  /**
   * Defined: @var @property wp_byterms
   * @since 1.3 
   * @since 02.16.2023 **/
  private $wp_byterms;

 /**
   * Defined: @var @property ORDER_REQUEST
   * @since 1.0.0.0 
   * @since 02.10.2023 **/
   private const ORDER_REQUEST = [

      'date',
      'id',
      'author',
      'type',
      'rand',
      'comment_count' 

   ];

 /**
   * Defined: @var @property ORDER_REQUEST
   * @since 1.0.0.0 
   * @since 02.10.2023 **/
   private const GET_POSTS_LINK = [
      
      'get_post_link_first',
      'get_post_link_last',
      'get_post_title_first',
      'get_post_title_last'
     
   ];
   
   public function __construct( $args = [] )
   {
 
     $this->wp_request_post_type = $args['post_type'] ?? '';
     $this->wp_sub_directory = $args['sub_directory'] ?? '';    
     $this->wp_orderby = $args['orderby'] ?? '';
     $this->wp_byterms = $args['byterms'] ?? '';

   }

  /** 
    * Defined : Processing pagination title loop
    * @method Private wp_single_post_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   private function set_wp_single_post_previous_pagination( $link = null ) {  

     global $post;
     global $wpdb;

     if( !is_null($link) && $link !== 'get_post_link_first') : return ' Invalid agurment | require : '.self::GET_POSTS_LINK[0]; exit; endif;

     // get_post_link_first then !
     if( $link === self::GET_POSTS_LINK[0] ) {

      $order_by = mb_strtolower($this->wp_orderby ,'UTF-8');
      $order_by = (!is_string( $order_by ))?  false :  $order_by; 

      $wp_request = $wpdb->get_results($this->wp_pagination_query_post_request_prev($post->post_type,$this->wp_set_order_by_link_post_first() ));
      $wp_request = json_decode(json_encode($wp_request), true);	
      $wp_request = $wp_request[0]['post_name']?? '';

      $currentURL = $this->wp_domain_sub_directory( $this->wp_sub_directory );
      $currentURL .= '/';
      $currentURL .= $wp_request;

      return ($currentURL);
    
     } else {

      $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query(false, false ));
      $wp_request = json_decode(json_encode($wp_request), true);	
      $wp_request = $wp_request[0]['post_name']?? '';

      $currentURL = $this->wp_domain_sub_directory( $this->wp_sub_directory );
      $currentURL .= '/';
      $currentURL .= $wp_request;

      return ($currentURL);

     }
      
   }

  /** 
    * Defined : Processing pagination title loop
    * @method Private wp_single_post_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   private function set_wp_single_post_next_pagination( $link = null ) {
    
    global $post;
    global $wpdb;

    if( !is_null($link) && $link !== 'get_post_link_last') : return ' Invalid agurment | require : '. self::GET_POSTS_LINK[1]; exit; endif;
   
    // get_post_link_last then !
    if( $link === self::GET_POSTS_LINK[1] ) {

     $order_by = mb_strtolower($this->wp_orderby ,'UTF-8');
     $order_by = (!is_string( $order_by ))?  false :  $order_by; 

     $wp_request = $wpdb->get_results($this->wp_pagination_query_post_request_next($post->post_type,$this->wp_set_order_by_link_post_first()));
     $wp_request = json_decode(json_encode($wp_request), true);	
     $wp_request = $wp_request[0]['post_name']?? '';

     $currentURL = $this->wp_domain_sub_directory( $this->wp_sub_directory );
     $currentURL .= '/';
     $currentURL .= $wp_request;

     return ($currentURL);

    } else {

     $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query( true , false));
     $wp_request = json_decode(json_encode($wp_request), true);	
     $wp_request = $wp_request[0]['post_name']?? '';

     $currentURL = $this->wp_domain_sub_directory( $this->wp_sub_directory );
     $currentURL .= '/';
     $currentURL .= $wp_request;

     return ($currentURL);

    }

   }

  /** 
    * Defined : request custom post type url sub directory
    * @method Private wp_domain_sub_directory
    * @since v1.0 
    * @since 02.10.2022 **/
   private function wp_domain_sub_directory($sub_directory) {
     
    $set_wp_domain_sub_directory  =  get_site_url();
    $set_wp_domain_sub_directory .= ( empty($sub_directory) ) ? '' : '/'.$sub_directory.'';
    return ($set_wp_domain_sub_directory);

   }

  /** 
    * Defined : Processing pagination title loop
    * @method Private set_wp_sp_pagination_prev_post_title
    * @since v1.0   
    * @since 02.10.2022 **/
   private function set_wp_sp_pagination_prev_post_title( $link = null ) {

    global $post;
    global $wpdb;

    if( !is_null($link) && $link !== 'get_post_title_first') : return ' Invalid agurment | require : '.self::GET_POSTS_LINK[2]; exit; endif;

    // get_post_link_first then !
    if( $link === self::GET_POSTS_LINK[2] ) {

     $order_by = mb_strtolower($this->wp_orderby ,'UTF-8');
     $order_by = (!is_string( $order_by ))?  false :  $order_by; 

     $wp_request = $wpdb->get_results($this->wp_pagination_query_post_request_prev($post->post_type,$this->wp_set_order_by_link_post_first(), true ));
     $wp_request = json_decode(json_encode($wp_request), true);	
     $wp_request = $wp_request[0]['post_title']?? '';

     return ($wp_request);
     
    } else {
  
      $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query(false, true));
      $wp_request = json_decode(json_encode($wp_request), true);	
      $wp_request = $wp_request[0]['post_title']?? '';

      return $wp_request;

    }
  
    }
  
  /** 
    * Defined : Processing pagination title loop
    * @method Private set_wp_sp_pagination_next_post_title
    * @since v1.0 
    * @since 02.10.2022 **/
    private function set_wp_sp_pagination_next_post_title( $link = null ) {

      global $post;
      global $wpdb;
  
      if( !is_null($link) && $link !== 'get_post_title_last') : return ' Invalid agurment | require : '. self::GET_POSTS_LINK[3]; exit; endif;
     
      // get_post_link_last then !
      if( $link === self::GET_POSTS_LINK[3] ) {
  
       $order_by = mb_strtolower($this->wp_orderby ,'UTF-8');
       $order_by = (!is_string( $order_by ))?  false :  $order_by; 
  
       $wp_request = $wpdb->get_results($this->wp_pagination_query_post_request_next($post->post_type,$this->wp_set_order_by_link_post_first(), true ));
       $wp_request = json_decode(json_encode($wp_request), true);	
       $wp_request = $wp_request[0]['post_title']?? '';
         
       return ($wp_request);
  
      } else {
  
     $wp_request = $wpdb->get_results($this->wp_sp_pagination_modal_pagination_query(true, true));
     $wp_request = json_decode(json_encode($wp_request), true);	
     $wp_request = $wp_request[0]['post_title']?? '';
  
     return $wp_request; 

      }

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

     if( $order_by === false ) { return; }

      switch ($order_by) {

        // Obviously for date
        case self::ORDER_REQUEST[0] :
        return $this->wp_pagination_order_by_request( $post->post_date, 'post_date', $left, $wp_postRequest );  
        break;

        // Obviously for id
        case self::ORDER_REQUEST[1] :
        return $this->wp_pagination_order_by_request( $post->ID, 'id', $left, $wp_postRequest ); 
        break;

        // Obviously for author
        case self::ORDER_REQUEST[2] :
        return $this->wp_pagination_order_by_request( $post->post_author, 'post_author', $left, $wp_postRequest ); 
        break;

        // Obviously for type
        case self::ORDER_REQUEST[3] :
        return $this->wp_pagination_order_by_request( $post->post_type, 'post_type', $left, $wp_postRequest ); 
        break;

        // Obviously for rand
        case self::ORDER_REQUEST[4] :
        return $this->wp_pagination_order_by_request( $post->ID, 'rand', $left, $wp_postRequest ); 
        break;

        // Obviously for commetn_count
        case self::ORDER_REQUEST[5] :
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

  /** 
    * Defined : Query Modal request
    * @method Private wp_sp_pagination_entity
    * @since v1.0 
    * @since 02.10.2022 **/
  private function wp_pagination_order_by_request( $post_order_by_query, $order_by,  $left = false , $wp_postRequest = false ) {
      
    // controller !
    $post_type_query = is_array($this->wp_request_post_type ) ? $this->wp_request_post_type : $this->wp_request_post_type; 
    $wp_byterms	     = is_array($this->wp_byterms ) ? $this->wp_byterms : $this->wp_byterms;
    $post_prev_next_condition  = (!$left === false) ? '<' : '>';
    $post_prev_next_order      = (!$left === false) ? 'DESC' : 'ASC';
    $post_wp_postRequest_title = (!$wp_postRequest === false) ? 'post_title' : 'post_name';
    $post_wp_rand_id           = ( (!empty($order_by) && $order_by === 'rand') ) ?  'id' : $order_by;
    $post_wp_rand              = ( (!empty($order_by) && $order_by === 'rand') ) ? 'rand()': (((!empty($order_by) && $order_by === 'post_author')) ? 'post_date' : $order_by) ;
    
    // OR POST TYPE
    $post_type_query_array     = implode('', $this->wp_post_type_is_array($post_type_query)[0]);
    // BY TERMS IF ONLY POST
    $wp_byterms_array          = implode('', $this->wp_byterms_is_array($wp_byterms)[0]);
        
    // Post author 
    $wp_post_author_post_prev_next_condition = ( (!empty($order_by) && $order_by === 'post_author') ) ?  '=' : $post_prev_next_condition; 

    // remove condition and post order request ex $post->ID if the post->post_title !
    // remove the title itself and post order request ex $post->ID if the post->post_title !
    $wp_post_author_post_prevnextcondition = (  $order_by === 'post_title'  || $order_by === 'post_name' ) ? false : 'AND '.$post_wp_rand_id.' '.$wp_post_author_post_prev_next_condition;
    $post_date_query_ = ( $order_by === 'post_title' || $order_by === 'post_name') ? false : " '$post_order_by_query' ";

    // Return query pagination by request !
    $wp_post_query_  = "";
    $wp_post_query_ .= " SELECT $post_wp_postRequest_title ";
    $wp_post_query_ .= " FROM wp_posts ";
    
    // Do this if we use single post type and return by terms if not the post will mixed !  @since v1.3
    if( !empty( $this->wp_byterms ) ) {
      $wp_post_query_ .= " LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) ";
      $wp_post_query_ .= " LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) ";
      $wp_post_query_ .= " LEFT JOIN wp_terms ON (wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id) ";
    }

    $wp_post_query_ .= " WHERE post_status = 'publish' ";

    // Do this if we use single post type and return by terms if not the post will mixed ! @since v1.3
    if( !empty( $this->wp_byterms )) { $wp_post_query_ .= $wp_byterms_array; }
    
    $wp_post_query_ .= " $wp_post_author_post_prevnextcondition ";
    $wp_post_query_ .= " $post_date_query_ "; 
    $wp_post_query_ .=   $post_type_query_array;
    $wp_post_query_ .= " ORDER BY $post_wp_rand ";
    $wp_post_query_ .= " $post_prev_next_order LIMIT 1 ";
     
    return $wp_post_query_;

  } 
  
   /** 
    * Defined : Query Modal request
    * @method Private wp_pagination_query_post_request_prev
    * @since v1.0 
    * @since 02.12.2022 **/
  private function wp_pagination_query_post_request_prev($post_type_query,  $order_by, $wp_postRequest = false ) {
  
    $post_wp_postRequest_title = (!$wp_postRequest === false) ? 'post_title' : 'post_name';
    $post_type_query_array     = implode('', $this->wp_post_type_is_array($post_type_query)[0]);
  
    $wp_first_query  = "";
    $wp_first_query .= " SELECT $post_wp_postRequest_title ";
    $wp_first_query .= " FROM wp_posts ";
    $wp_first_query .= " WHERE post_status = 'publish' ";
    $wp_first_query .= " $post_type_query_array ";    
    $wp_first_query .= " ORDER BY  $order_by ";
    $wp_first_query .= " DESC LIMIT 1";

    return $wp_first_query;

  }

   /** 
    * Defined : Query Modal request
    * @method Private wp_pagination_query_post_request_next
    * @since v1.0 
    * @since 02.12.2022 **/  
  private function wp_pagination_query_post_request_next($post_type_query,  $order_by, $wp_postRequest = false ) {
  
    $post_wp_postRequest_title = (!$wp_postRequest === false) ? 'post_title' : 'post_name';
    $post_type_query_array     = implode('', $this->wp_post_type_is_array($post_type_query)[0]);
   
    $wp_first_query  = "";
    $wp_first_query .= " SELECT $post_wp_postRequest_title ";
    $wp_first_query .= " FROM wp_posts ";
    $wp_first_query .= " WHERE post_status = 'publish' ";
    $wp_first_query .= " $post_type_query_array ";    
    $wp_first_query .= " ORDER BY  $order_by ";
    $wp_first_query .= " ASC LIMIT 1";

    return $wp_first_query;

  }

   /** 
    * Defined : Query Modal request
    * @method Private wp_set_order_by_link_post_first
    * @since v1.0 
    * @since 02.12.2022 **/ 
  private function wp_set_order_by_link_post_first() {
    
    $order_by = mb_strtolower($this->wp_orderby ,'UTF-8');
    $order_by = (!is_string( $order_by ))?  false :  $order_by;

    if( $order_by === false ) { return; }

     switch ($order_by) {

       case self::ORDER_REQUEST[0] :
       return 'post_date';
       break;
       case self::ORDER_REQUEST[1] :
       return 'id';
       break;      
       case self::ORDER_REQUEST[2] :
       return 'author';
       break; 
       case self::ORDER_REQUEST[3] :
       return 'post_type';
       break;        
       case self::ORDER_REQUEST[4] :
       return 'rand';
       break;  
       case self::ORDER_REQUEST[5] :
       return 'comment_count';
       break; 

       default:
       return "Invalid request orderby list avaliable are :
         [ 
           'orderby' => 'date' 
           'orderby' => 'id' 
           'orderby' => 'author' 
           'orderby' => 'type' 
           'orderby' => 'rand' 
           'orderby' => 'comment_count'           
         ]";
      break;
   }    

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
    * Defined : Process Single post type return by terms 
   	* for intance you have a blog and new is your post if you want to return the pagination only those newLetter 
	   * you need to use this by terms ! so in yout single page it will return to you by terms NOT mixed or by CPT
    * @method Private wp_post_type_is_array
    * @since v1.5 
    * @since 03.04.2023 **/
   private function wp_byterms_is_array($wp_byterms) {

  	$wp_byterms_ = [];

	  if(is_array($wp_byterms)) {

	  foreach($wp_byterms as $post => $term ) {

	   if($post === 0) {
		  $wp_byterms_[]= "AND wp_terms.slug = '". $term ."'";
		  continue;
	   }  
	   else { $wp_byterms_[]= " OR wp_terms.slug = '". $term ."'"; }
	
	 }

	 return [ $wp_byterms_ ];

	} else { return [ [ "AND wp_terms.slug = '". $wp_byterms ."' " ] ]; }

 }

   

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_single_post_previous_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_single_post_previous_pagination( $link = null ) { return ($this->set_wp_single_post_previous_pagination($link));}

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_single_post_next_pagination
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_single_post_next_pagination( $link = null ) { return ($this->set_wp_single_post_next_pagination($link)); }

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_sp_pagination_prev_post_title
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_sp_pagination_prev_post_title( $link = null ) { return ($this->set_wp_sp_pagination_prev_post_title($link));}

  /** 
    * Defined : Processing pagination title loop
    * @method Public get_wp_sp_pagination_next_post_title
    * @since v1.0 
    * @since 02.10.2022 **/
   public function get_wp_sp_pagination_next_post_title( $link = null ) { return ($this->set_wp_sp_pagination_next_post_title($link)); }

 }
