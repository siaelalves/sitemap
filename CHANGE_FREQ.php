<?php
namespace sitemap;

enum CHANGE_FREQ : string {

 case ALWAYS = "always" ;
 case HOURLY = "hourly" ;
 case DAILY = "daily" ;
 case WEEKLY = "weekly" ;
 case MONTHLY = "monthly" ;
 case YEARLY = "yearly" ;
 case NEVER = "never" ;

}
?>