<?php
namespace sitemap ;

/**
 * Atualiza o arquivo `sitemap.xml` de acordo com os dados enviados. 
 * Os dados devem ser enviados de acordo com um modelo pré-definido de array 
 * associativa.
 * @param array $data Array associativa contendo os dados a serem adicionados. 
 * As chaves devem corresponder às especificações abaixo:
 * - **"loc"** `string`: **Obrigatória.** É a URL da página. Caso não seja 
 * informada, a entrada será ignorada.
 * - **"lastmod"** `string`: Data da última modificação da página no formato 
 * `YYYY-MM-DDTHH:MM:SS.000Z`. Caso não seja informada, será usada a data 
 * padrão especificada na constante `DEFAULTS::LAST_MOD`.
 * - **"changefreq"** `string`: Frequência de atualização da página. Os valores 
 * permitidos são: `always`, `hourly`, `daily`, `weekly`, `monthly`, `yearly`, 
 * `never`. Caso não seja informada, será usada a frequência padrão especificada 
 * na constante `DEFAULTS::CHANGE_FREQ`.
 * - **"priority"** `string`: Prioridade da página. O valor deve ser um número 
 * entre 0 e 1. Caso não seja informada, será usada a prioridade padrão 
 * especificada na constante `DEFAULTS::PRIORITY`.
 * - **"image"** `array`: Array contendo as URLs das imagens da página. Caso 
 * não seja informada, a chave será ignorada.
 * Uma exceção `\InvalidArgumentException` será lançada caso o valor não seja 
 * do tipo array.
 * @param string $xml_path Nome do arquivo xml no qual será salvo o sitemap. 
 * O padrão é "sitemap.xml" no diretório referencial em que o script invocou 
 * esta função.
 * 
 * @return array|bool 
 * - Retorna uma array contendo os erros ocorridos durante a 
 * criação do sitemap. Os erros são relatados numa array unidimensional. Cada 
 * elemento é uma mensagem simples que informa o índice da entrada de `$data` 
 * no qual está o erro.
 * - Retorna `true` se nenhum erro for relatado.
 * 
 * @example ## Exemplo de uso:
 * ```
 * if (!\sitemap\refresh()) {
 *  echo "Houve um erro ao criar o sitemap." ;
 * } else {
 *  echo "Sitemap criado com sucesso."
 * }
 * ```
 * 
 * @author Siael Alves
 * @copyright (c) 2025 Copyright, Siael Alves
 */
function refresh ( array $data , string $xml_path = "sitemap.xml" ) : array|bool {

 $result = [ ] ;

 if ( gettype ( $data ) != "array" ) {
  throw new \InvalidArgumentException ( "O argumento passado para a 
  função 'refresh' deve ser um array. Ao invés disso, foi passado um 
  tipo " . gettype ( $data ) . "." ) ;
 }

 $xml_content = DEFAULTS::HEADER . "\n" ;
 
 $i = 0 ;

 foreach ( $data as $entry ) {

  if ( !array_key_exists ( "loc" , $entry ) ) {
   array_push ( $result , "A entrada do índice $i foi ignorada porque 
   a chave 'loc' não foi encontrada." ) ;
   continue ;
  }

  if ( !array_key_exists ( "lastmod" , $entry ) ) {
   array_push ( $result , "Não foi encontrada a chave \"lastmod\" na 
   entrada do índice $i. O valor padrão \"" . DEFAULTS::CHANGE_FREQ . 
   "\" foi usado." ) ;

   $entry [ "lastmod" ] = DEFAULTS::LAST_MOD ;
  }

  if ( !array_key_exists ( "changefreq" , $entry ) ) {
   array_push ( $result , "Não foi encontrada a chave \"changefreq\" na 
   entrada do índice $i. O valor padrão \"" . DEFAULTS::CHANGE_FREQ . 
   "\" foi usado." ) ;

   $entry [ "changefreq" ] = DEFAULTS::CHANGE_FREQ ;
  }

  if ( !array_key_exists ( "priority" , $entry ) ) {
   array_push ( $result , "Não foi encontrada a chave \"priority\" na 
   entrada do índice $i. O valor padrão \"" . DEFAULTS::PRIORITY . 
   "\" foi usado." ) ;

   $entry [ "priority" ] = DEFAULTS::PRIORITY ;
  }


  $xml_content .= "<url>\n" ;

  $xml_content .= " <loc>" . $entry [ "loc" ] . "</loc>\n" ;
  $xml_content .= " <lastmod>" . $entry [ "lastmod" ] . "</lastmod>\n" ;
  $xml_content .= " <changefreq>" . $entry [ "changefreq" ] . "</changefreq>\n" ;
  $xml_content .= " <priority>" . $entry [ "priority" ] . "</priority>\n" ;

  if ( array_key_exists ( "image" , $entry ) ) {
   if ( gettype ( $entry [ "image" ] ) == "array" ) {

    foreach ( $entry [ "image" ] as $image ) {
     $xml_content .= " <image:image><image:loc>" . $image . "</image:loc></image:image>\n" ;  
    }

   } else {
    array_push ( $result , "A chave \"image\" do índice $i não foi adicionada porque 
    a chave deve ser uma array. Ao invés disso, foi passado um tipo " . 
    gettype ( $entry [ "image" ] . "." ) ) ;    
   }
  }

  $xml_content .= "</url>\n" ;

  $i++ ;
 }

 $xml_content .= "</urlset>" ;

 file_put_contents ( $xml_path , $xml_content ) ;

 if ( count ( $result ) == 0 ) { return true ; }

 return $result ;

}