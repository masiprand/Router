<?php
namespace Involve\Router;

use Involve\Router\RouteException\NotFoundException;
use Involve\Router\RouteException\MethodNotAllowedException;
class ParseRouteInfo
{
  
  const FOUND = 1;
  const NOT_FOUND = 0;
  const METHOD_NOT_ALLOWED = 2;
  /*
  *@var routeInfo
  */
  private $routeInfo = [];
  /*
  *@var config
  */
  private $config = [];
  
  /*
  *@ add routeInfo | config
  */
  public function __construct(array $routeInfo,$config = null)
  {
    $this->routeInfo = $routeInfo;
 
    $this->config = $config;
  }
  /*
  *@ return callback
  *@callable | string
  *@string controller
  */
  public function callbackRoute()
  {
    $condition = $this->routeInfo[0];
    $new = $this->routeInfo[1];
    $vars = $this->routeInfo[2];
    
    if($condition === static::NOT_FOUND){
      throw new NotFoundException('Page Not Found!!');
    }
    
    if($condition === static::METHOD_NOT_ALLOWED){
      throw new MethodNotAllowedException('Method Not Allowed!!');
    }
    
    
    if($condition === static::FOUND){
    
      if(is_callable($new)){
        echo call_user_func_array($new,$vars);
      }
      
      if(is_string($new)){
        $new = explode('@',$new);
        $controller = $this->config['controller'].$new[0];
        $class = new $controller;
        
        echo call_user_func_array([$class,$new[1]],$vars);
      }
      
    }
    
    
  }
  

}