<?php
namespace Involve\Router;

class Route
{
  
  private $config;
  
  public function __construc(array $configuration = [])
  {
    $this->config = $configuration;
  }
  
  public function getConfigRoute()
  {
  
    return $this->config;
  }
  
}