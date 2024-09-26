<?php
namespace sitemap ;

/* Classe sitemap, que organiza operações que afetam o mapa de páginas do site */
class url_set {

 public \routes\url $loc ;
 public string $lastmod ;
 public string $changefreq ;
 public string $priority ;
 public array $image = [ ] ;

 function __construct ( \blog\page $page ) {

  $this->loc = $this->set_url ( $page ) ;
  $this->lastmod = $page->dateTime ;
  $this->changefreq = $this->set_change_freq ( $page ) ;
  $this->priority = $this->set_priority ( $page ) ;

 }

 private function set_url ( \blog\page $page ):\routes\url {
  global $request ;
  
  if ( $page->type == \blog\PAGE_TYPE::POST->value ) {
  
   $query = new \data\query ( ) ;
   $post_obj = $query->get_post_by_url ( $page->url->full ) ;
   
   $post = new \blog\post ( ) ;
   $post->new ( $post_obj ) ;
   return $post->url ;
  }

  return new \routes\url ( $page->url->full ) ;
 }

 private function set_priority ( \blog\page $page ):float {
  
  if ( $page->type == \blog\PAGE_TYPE::HOME->value ) {
   return 1.0 ;
  }

  if ( $page->type == \blog\PAGE_TYPE::PAGE->value || $page->type == \blog\PAGE_TYPE::CATEGORY->value || $page->type == \blog\PAGE_TYPE::TAG->value || $page->type == \blog\PAGE_TYPE::MEDIA->value || $page->type == \blog\PAGE_TYPE::BLOG->value ) {
   return 0.9 ;
  }

  if ( $page->type == \blog\PAGE_TYPE::POST->value ) {
   return 0.8 ;
  }

  return 0.5 ;

 }

 private function set_change_freq ( \blog\page $page ):string {

  if ( $page->type == \blog\PAGE_TYPE::HOME->value ) {
   return CHANGE_FREQ::YEARLY->value ;
  }

  if ( $page->type == \blog\PAGE_TYPE::PAGE->value || $page->type == \blog\PAGE_TYPE::CATEGORY->value || $page->type == \blog\PAGE_TYPE::TAG->value || $page->type == \blog\PAGE_TYPE::MEDIA->value || $page->type == \blog\PAGE_TYPE::BLOG->value ) {
   return CHANGE_FREQ::MONTHLY->value ;
  }

  if ( $page->type == \blog\PAGE_TYPE::POST->value ) {
   return CHANGE_FREQ::WEEKLY->value  ;
  }

  return CHANGE_FREQ::NEVER->value  ;

 }

}

?>