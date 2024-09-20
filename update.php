<?php
namespace sitemap ;

/**
 * Atualiza o sitemap e salva um novo arquivo na pasta "sitemaps". Realiza 
 * a atualização de todas as versões do sitemap.
 */
function update ( ) {
 global $admin , $paths , $request ;

 $new_sitemap = [ ] ;

 foreach ( $admin->public_pages as $page_obj ) {
  $page = new \blog\page ( $page_obj ) ;
  $sitemap = new url_set ( $page ) ;
  $loc = new \routes\url ( $admin->config [ "protocolSecure" ] . "//" . $admin->website [ "address" ] . "/" . $sitemap->loc->path->full ) ;
  
  $new_entry = [ 
   info_name::LOC =>  $loc->full ,
   info_name::LASTMOD => $sitemap->lastmod ,
   info_name::CHANGE_FREQ => $sitemap->changefreq ,
   info_name::PRIORITY => $sitemap->priority ,
   info_name::IMAGE => $sitemap->image 
  ];

  array_push ( $new_sitemap , $new_entry ) ;
 }

 file_put_contents ( $paths->sitemap_db , json_encode ( $new_sitemap ) ) ;

 $admin->sitemap = json_decode ( file_get_contents ( $paths->sitemap_db ) , true ) ;

 
 // atualiza o XML
 $new_xml = header . "\n" ;
 foreach ( $admin->sitemap as $url_set ) {
  
  if ( $url_set [ info_name::LOC ] == "" ) {
   continue ;

  }

  $new_xml .= "<url>\n" ;
  $new_xml .= " " . get_tag ( info_name::LOC , $url_set [ info_name::LOC ] ) . "\n" ;
  
  if ( $url_set [ info_name::LASTMOD ] == "" ) {
   $new_xml .= " " . get_tag ( info_name::LASTMOD , default_last_mod ) . "\n" ;
   
  } else {
   $new_xml .= " " . get_tag ( info_name::LASTMOD , $url_set [ info_name::LASTMOD ] ) . "\n" ;

  }  

  $new_xml .= " " . get_tag ( info_name::PRIORITY , $url_set [ info_name::PRIORITY ] ) . "\n" ;
  $new_xml .= " " . get_tag ( info_name::CHANGE_FREQ , $url_set [ info_name::CHANGE_FREQ ] ) . "\n" ;
  
  foreach ( $url_set [ info_name::IMAGE ] as $image ) {

   if ( count ( $url_set [ info_name::IMAGE ] ) == 0 ) {
    $new_xml .= " " . get_tag ( info_name::IMAGE , "" ) . "\n" ;
   
   } else {
    $new_xml .= " " . get_tag ( info_name::IMAGE , $image ) . "\n" ;

   }

  }
  
  $new_xml .= "</url>\n" ;

 }

 $new_xml .= "</urlset>" ;

 file_put_contents ( $paths->sitemap_xml , $new_xml ) ;

}

?>