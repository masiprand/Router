<?php
namespace Involve\Router;

class Dispatcher
{
  /*
  *@return involve dispatcher
  */
  public function involveDispatcher(callable $routeDefinitionCallback, array $options = [])
  {
    $options += [
        'routeParser' => 'FastRoute\\RouteParser\\Std',
        'dataGenerator' => 'FastRoute\\DataGenerator\\GroupCountBased',
        'dispatcher' => 'FastRoute\\Dispatcher\\GroupCountBased',
        'routeCollector' => 'Involve\\Router\\RouteCollection',
    ];
    
    /** @var RouteCollection $routeCollection */
    $routeCollector = new $options['routeCollector'](
        new $options['routeParser'], new $options['dataGenerator']
    );
    $routeDefinitionCallback($routeCollector);
    
    return new $options['dispatcher']($routeCollector->getData());
    
  }
  /*
  *@ return dispatcher cache
  */
  public function cache(callable $routeDefinitionCallback, array $options = [])
  {
    $options += [
        'routeParser' => 'FastRoute\\RouteParser\\Std',
        'dataGenerator' => 'FastRoute\\DataGenerator\\GroupCountBased',
        'dispatcher' => 'FastRoute\\Dispatcher\\GroupCountBased',
        'routeCollector' => 'FastRoute\\RouteCollector',
        'cacheDisabled' => false,
    ];
    
    if (!isset($options['cacheFile'])) {
        throw new \LogicException('Must specify "cacheFile" option');
    }
    
    if (!$options['cacheDisabled'] && file_exists($options['cacheFile'])) {
        $dispatchData = require $options['cacheFile'];
        if (!is_array($dispatchData)) {
            throw new \RuntimeException('Invalid cache file "' . $options['cacheFile'] . '"');
        }
        return new $options['dispatcher']($dispatchData);
    }
    
    $routeCollector = new $options['routeCollector'](
        new $options['routeParser'], new $options['dataGenerator']
    );
    $routeDefinitionCallback($routeCollector);
    
    /** @var RouteCollection $routeCollection */
    $dispatchData = $routeCollector->getData();
    if (!$options['cacheDisabled']) {
        file_put_contents(
            $options['cacheFile'],
            '<?php return ' . var_export($dispatchData, true) . ';'
        );
    }
    
    return new $options['dispatcher']($dispatchData);
    
  }
  
}