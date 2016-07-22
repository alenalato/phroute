<?php namespace Phroute\Phroute;

class RouteDataArray implements RouteDataInterface {

    /**
     * @var array
     */
    private $variableRoutes;

    /**
     * @var array
     */
    private $staticRoutes;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var array
     */
    private $reverseData;

    /**
     * @param array $staticRoutes
     * @param array $variableRoutes
     * @param array $filters
     * @param array $reverseData
     */
    public function __construct(array $staticRoutes, array $variableRoutes, array $filters, array $reverseData)
    {
        $this->staticRoutes = $staticRoutes;

        $this->variableRoutes = $variableRoutes;

        $this->filters = $filters;

        $this->reverseData = $reverseData;
    }

    /**
     * @return array
     */
    public function getStaticRoutes()
    {
        return $this->staticRoutes;
    }

    /**
     * @return array
     */
    public function getVariableRoutes()
    {
        return $this->variableRoutes;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return array
     */
    public function getReverseData()
    {
      return $this->reverseData;
    }
}
