<?php
namespace sitemap;

/**
 * Enumera os valores possíveis para a frequência de mudança de uma URL 
 * no sitemap. As strings retornadas são todas em minúsculas. As 
 * constantes e seus respectivos valores estão listados abaixo:
 * | **CONSTANTE**       | **VALOR**      |
 * |---------------------|----------------|
 * | **ALWAYS**          | "always"       |
 * | **HOURLY**          | "hourly"       |
 * | **DAILY**           | "daily"        |
 * | **WEEKLY**          | "weekly"       |
 * | **MONTHLY**         | "monthly"      |
 * | **YEARLY**          | "yearly"       |
 * | **NEVER**           | "never"        |
 */
enum CHANGE_FREQ : string {

 case ALWAYS = "always" ;

 case HOURLY = "hourly" ;
 
 case DAILY = "daily" ;
 
 case WEEKLY = "weekly" ;
 
 case MONTHLY = "monthly" ;
 
 case YEARLY = "yearly" ;
 
 case NEVER = "never" ;

}