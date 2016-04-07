<?php

namespace Khill\Lavacharts\Dashboards\Filters;

use \Khill\Lavacharts\Exceptions\InvalidFilterParam;
use \Khill\Lavacharts\Support\Customizable;
use \Khill\Lavacharts\Support\Traits\NonEmptyStringTrait as StringCheck;
use \Khill\Lavacharts\Support\Contracts\WrappableInterface as Wrappable;

/**
 * Filter Parent Class
 *
 * The base class for the individual filter objects, providing common
 * functions to the child objects.
 *
 *
 * @package   Khill\Lavacharts\Dashboards\Filters
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class Filter extends Customizable implements Wrappable, \JsonSerializable
{
    use StringCheck;

    /**
     * Type of wrapped class
     */
    const WRAP_TYPE = 'controlType';

    /**
     * Builds a new Filter Object.
     * Takes either a column label or a column index to filter. The options object will be
     * created internally, so no need to set defaults. The child filter objects will set them.
     *
     * @param  string|int $columnLabelOrIndex
     * @param  array      $options Array of options to set.
     * @throws \Khill\Lavacharts\Exceptions\InvalidFilterParam
     */
    public function __construct($columnLabelOrIndex, array $options = [])
    {
        if ($this->nonEmptyString($columnLabelOrIndex) === false && is_int($columnLabelOrIndex) === false) {
            throw new InvalidFilterParam($columnLabelOrIndex);
        }

        if (is_string($columnLabelOrIndex) === true) {
            $options = array_merge($options, ['filterColumnLabel' => $columnLabelOrIndex]);
        }

        if (is_int($columnLabelOrIndex) === true) {
            $options = array_merge($options, ['filterColumnIndex' => $columnLabelOrIndex]);
        }

        parent::__construct($options);
    }

    /**
     * Returns the Filter type.
     *
     * @return string
     */
    public function getType()
    {
        return static::TYPE;
    }

    /**
     * Returns the Filter wrap type.
     *
     * @since 3.1.0
     * @return string
     */
    public function getWrapType()
    {
        return static::WRAP_TYPE;
    }
}
