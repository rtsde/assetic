<?php

/*
 * This file is part of the Assetic package, an OpenSky project.
 *
 * (c) 2010-2014 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Assetic;

use Assetic\Filter\FilterInterface;

/**
 * Manages the available filters.
 *
 * @author Kris Wallsmith <kris.wallsmith@gmail.com>
 */
class FilterManager
{
    private $filters = array();

    public function set($alias, FilterInterface $filter)
    {
        $this->checkName($alias);

        $this->filters[$alias] = $filter;
    }

    public function get($alias)
    {
        if (!isset($this->filters[$alias])) {
            throw new \InvalidArgumentException(sprintf('There is no "%s" filter.', $alias));
        }

        return $this->filters[$alias];
    }

    public function has($alias)
    {
        return isset($this->filters[$alias]);
    }

    public function getNames()
    {
        return array_keys($this->filters);
    }

    /**
     * Checks that a name is valid.
     *
     * @param string $name An asset name candidate
     *
     * @throws \InvalidArgumentException If the asset name is invalid
     */
    protected function checkName($name)
    {
        // Loosen up asset/filter name checks. Fix assetic #246 #255.
        if (!ctype_alnum(str_replace(array('_', '-', '.'), '', $name))) {
            throw new \InvalidArgumentException(sprintf('The name "%s" is invalid.', $name));
        }
    }
}
