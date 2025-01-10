<?php
namespace sitemap;

/**
 * Enumera os valores padrão para o módulo sitemap. 
 * Visto que o padrão do sitemap pode ser alterado com o tempo, 
 * pode haver necessidade de alterar os valores padrão. Os 
 * valores deste enumerador, no momento, foram preparados 
 * conforme as especificações do website sitemaps.org.
 */
enum DEFAULTS : string {
 
 /**
  * String informativa que deve, obrigatoriamente, ser a 
  * primeira linha de um arquivo sitemap.xml.
  */
 const HEADER = "<?xml version='1.0' encoding='UTF-8'?>
<urlset
   xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'
   xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
   xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9
   http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'
   xmlns:image='http://www.google.com/schemas/sitemap-image/1.1'>" ;

 /** 
  * Valor padrão para a data de última modificação de uma URL.
  */
 const LAST_MOD = "2024-08-01T00:15:00.000Z" ;

}