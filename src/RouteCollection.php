<?php
namespace Involve\Router;

use FastRoute\RouteCollector as BaseRouteCollector;


class RouteCollection  extends BaseRouteCollector
{

  /*
  *@parent
  */
  public function __construct($routeParser, $dataGenerator)
  {
     parent::__construct($routeParser,$dataGenerator);
  }
  /*
  *@ add route
  */
  public function add($method,$path,$handler)
  {
    $this->addRoute($method,$path,$handler);
  }
  /**
  * Adds a GET route to the collection
  * 
  * This is simply an alias of $this->addRoute('GET', $route, $handler)
  *
  * @param string $route
  * @param mixed  $handler
  */
  public function get($route, $handler)
  {
    $this->addRoute('GET', $route, $handler);
  }
  
  /**
   * Adds a POST route to the collection
   * 
   * This is simply an alias of $this->addRoute('POST', $route, $handler)
   *
   * @param string $route
   * @param mixed  $handler
   */
  public function post($route, $handler)
  {
      $this->addRoute('POST', $route, $handler);
  }
  
  /**
   * Adds a PUT route to the collection
   * 
   * This is simply an alias of $this->addRoute('PUT', $route, $handler)
   *
   * @param string $route
   * @param mixed  $handler
   */
  public function put($route, $handler)
  {
      $this->addRoute('PUT', $route, $handler);
  }
  
  /**
   * Adds a DELETE route to the collection
   * 
   * This is simply an alias of $this->addRoute('DELETE', $route, $handler)
   *
   * @param string $route
   * @param mixed  $handler
   */
  public function delete($route, $handler)
  {
      $this->addRoute('DELETE', $route, $handler);
  }
  
  /**
   * Adds a PATCH route to the collection
   * 
   * This is simply an alias of $this->addRoute('PATCH', $route, $handler)
   *
   * @param string $route
   * @param mixed  $handler
   */
  public function patch($route, $handler)
  {
      $this->addRoute('PATCH', $route, $handler);
  }
  
  /**
   * Adds a HEAD route to the collection
   *
   * This is simply an alias of $this->addRoute('HEAD', $route, $handler)
   *
   * @param string $route
   * @param mixed  $handler
   */
  public function head($route, $handler)
  {
      $this->addRoute('HEAD', $route, $handler);
  }
  
  /**
   * Returns the collected route data, as provided by the data generator.
   *
   * @return array
   */
  public function getData()
  {
      return $this->dataGenerator->getData();
  }
  
}