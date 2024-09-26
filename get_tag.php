<?php
namespace sitemap ;

/**
 * Obtém uma tag do sitemap e insere um valor entre elas. Por exemplo: 
 * <loc>https://website.com</loc>
 * @param string $info_name Pode ser um dos valores a seguir: loc,lastmod,changefreq,
 * priority ou image.
 * @param string $value Valor a ser inserido na tag.
 * @return string Uma string com a tag e o valor dentro dela.
 */
function get_tag ( string $info_name , $value ):string {

 if ( $info_name == "image" ) {
  return "<image:image><image:loc>" . $value . "</image:image></image:loc>" ;

 }

 return "<" . $info_name . ">" . $value . "</" . $info_name . ">" ;

}

?>