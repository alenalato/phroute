<?php namespace Phroute\Phroute;

use Phroute\Phroute\Exception\BadRouteException;

class RouteReverser {
  /**
   * @var array
   */
  private $reverse = [];

  /**
   * @param array $reverseData
   */
  public function __construct(array $reverseData = [])
  {
    $this->reverse = $reverseData;
  }

  /**
   * @param $name
   * @param $reverseData
   */
  public function addRoute($name, array $reverseData)
  {
    $this->reverse[$name] = $reverseData;
  }

  /**
   * @param $name
   * @return bool
   */
  public function hasRoute($name)
  {
    return isset($this->reverse[$name]);
  }

  /**
   * @return array
   */
  public function getData()
  {
    return $this->reverse;
  }

  /**
   * @param $name
   * @param array $args
   * @return string
   */
  public function route($name, array $args = null)
  {
    $url = [];

    $replacements = is_null($args) ? [] : array_values($args);

    $variable = 0;

    foreach($this->reverse[$name] as $part)
    {
      if(!$part['variable'])
      {
        $url[] = $part['value'];
      }
      elseif(isset($replacements[$variable]))
      {
        if($part['optional'])
        {
          $url[] = '/';
        }

        $url[] = $replacements[$variable++];
      }
      elseif(!$part['optional'])
      {
        throw new BadRouteException("Expecting route variable '{$part['name']}'");
      }
    }

    return implode('', $url);
  }

  /**
   * @return array
   */
  public function getReverseSchema()
  {
    $urls = [];

    foreach($this->reverse as $name => $reverseData)
    {
      $url = [];

      foreach($this->reverse[$name] as $part)
      {
        if(!$part['variable'])
        {
          $url[] = $part['value'];
        }
        else
        {
          if($part['optional'])
          {
            $url[] = '/';
          }

          $url[] = '<';

          if($part['optional'])
          {
            $url[] = '?';
          }

          $url[] =  $part['name'] . '>';
        }
      }

      $urls[$name] = implode('', $url);
    }

    return $urls;
  }
}
