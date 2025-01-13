# Sitemap PHP

**Versão** 1.0.0

**Objetivo** Gera um arquivo de sitemap válido no formato XML a partir de uma lista de valores.

## Detalhes

### O que faz?

Lê uma entrada contendo uma lista de valores e as converte para um formato XML válido que pode ser usado como mapa do site para mecanismos de pesquisa, como Google, Bing e outros.

## Como instalar

1. Copie o conteúdo para um diretório dentro de seu projeto;
2. Num script externo à pasta deste projeto, utilize o seguinte código para incluir **Routes Manager**:

```php
require dirname(__FILE__) . "/sitemap/sitemap.php" ;
```

3. Acesse as classes de **Sitemap PHP** através do namespace `\sitemap`;

A estrutura de diretórios do projeto deve estar da seguinte forma:

- sitemap-PHP
    - *Conteúdo de sitemap-PHP*
    - ...
- index.php

No caso, o script *index.php* deve conter a instrução no passo 2. Fique à vontade para renomear a pasta em que ficará instalado este projeto.

## Formato de dados aceito

Para gerar o sitemap, a entrada de dados deve ser do tipo `Array` em que cada entrada é um objeto que conteha as seguintes chaves:

- **"loc"** `string`: **Obrigatória.** É a URL da página. Caso não seja informada, a entrada será ignorada.

- **"lastmod"** `string`: Data da última modificação da página no formato `YYYY-MM-DDTHH:MM:SS.000Z`. Caso não seja informada, será usada a data padrão especificada na constante `DEFAULTS::LAST_MOD`.

- **"changefreq"** `string`: Frequência de atualização da página. Os valores permitidos são:
    - `"always"`
    - `"hourly"`
    - `"daily"`
    - `"weekly"`
    - `"monthly"`
    - `"yearly"`
    - `"never"`

Caso `changefreq` não seja informada, será usada a frequência padrão especificada na constante `DEFAULTS::CHANGE_FREQ`.

- **"priority"** `string`: Prioridade da página. O valor deve ser um número entre 0 e 1. Caso não seja informada, será usada a prioridade padrão especificada na constante `DEFAULTS::PRIORITY`.

- **"image"** `array`: Array contendo as URLs das imagens da página. Caso não seja informada, a chave será ignorada. Uma exceção `\InvalidArgumentException` será lançada caso o valor não seja 
do tipo array.

## Exemplos

### **Exemplo de dados que seriam aceitos**

Um exemplo de dado que seria aceito como entrada de sitemap:

```php
$data = [
 [
  "loc" -> "https://diariocode.com.br/blog",
  "lastmod" -> "2025-01-13T13:41:25",
  "changefreq" -> "monthly",
  "priority" -> "0.9",
  "image" -> [
   "https://diariocode.com.br/uploads/diario-code-como-converter-uma-string-para-array-php-1024.jpg",
   "https://diariocode.com.br/uploads/como-funciona-o-range-em-python-1024.jpg"
  ]
 ]
]
```

### **Como gerar um sitemap a partir de uma lista de valores**

Considerando que a variável citada no exemplo acima, `$data`, o código abaixo criará um arquivo chamado `sitemap-2024.xml` no diretório raiz do website:

```php
\sitemap\refresh($data, "sitemap-2024.xml");
```

## Mapa de utilização de Sitemap PHP

Abaixo, está o mapa de classes e propriedades de Sitemap PHP.

* sitemap
    * **CHANGE_FREQ [ enum:string ]**
    * **DEFAULTS [ enum:string ]**
    * **`refresh ( )`

## Bugs

Atualmente, não foram detectados bugs no projeto.