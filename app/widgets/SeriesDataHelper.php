<?php

// ext highchart
namespace app\widgets;

use JsonSerializable;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\data\BaseDataProvider;
use yii\helpers\ArrayHelper;

/**

 * Basic usage:
 * ```php
 * use miloschuman\highcharts\Highstock;
 * use miloschuman\highcharts\SeriesDataHelper;
 *
 * Highstock::widget([
 *     'options' => [
 *         'series' => [
 *             [
 *                 'type' => 'candlestick',
 *                 'name' => 'Stock',
 *                 'data' => new SeriesDataHelper($dataProvider, ['date:datetime', 'open', 'high', 'low', 'close']),
 *             ],
 *             [
 *                 'type' => 'column',
 *                 'name' => 'Volume',
 *                 'data' => new SeriesDataHelper($dataProvider, ['date:datetime', 'volume:int']),
 *             ],
 *         ]
 *     ]
 * ]);

 */
class SeriesDataHelper extends Component implements JsonSerializable
{

    /**
     * @var array column configuration
     */
    protected $columns;

    /**
     * @var BaseDataProvider|array the underlying data source
     */
    protected $data;

    public function __construct($data, $columns, $config = [])
    {
        parent::__construct($config);

        $this->setData($data);
        $this->setColumns($columns);
    }


    /**
     * Sets the underlying data source.
     * 
     * @param BaseDataProvider|array $data the data source
     * @throws InvalidParamException
     */
    public function setData($data)
    {
        if ($data instanceof BaseDataProvider) {
            $this->data = $data;
        } elseif (is_array($data)) {
            $this->data = new ArrayDataProvider([
                'allModels' => $data,
            ]);
        } else {
            throw new InvalidParamException('Data must be an array or extend BaseDataProvider');
        }
    }


    /**
  
     * Example showing different ways to specify a column:
     *
     * ```php
     * [
     *     ['date_measured', 'datetime'],
     *     'open',
     *     'high:float',
     *     ['low', 'float'],
     *     ['close', function($value) {
     *         return ceil($value);
     *     }]
     * ]
     * ```
     *
     * @param array $columns
     * @throws InvalidParamException
     */
    public function setColumns($columns)
    {
        if (!is_array($columns) || !count($columns)) {
            throw new InvalidParamException('Columns must be an array with at least one element.');
        }

        $this->columns = $columns;
    }


    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->process();
    }

    public function process()
    {
        if (empty($this->data)) {
            throw new InvalidConfigException('Missing required "data" property.');
        }

        $this->normalizeColumns();

        // return simple array for single-column configs
        if (count($this->columns) === 1) {
            $column = $this->columns[0];
            $data = ArrayHelper::getColumn($this->data->models, $column[0]);
            return array_map($column[1], $data);
        }

        // use two-dimensional array for multi-column configs
        $data = [];
        foreach ($this->data->models as $model) {
            $row = [];
            foreach ($this->columns as $column) {
                $row[] = call_user_func($column[1], $model[$column[0]]);
            }

            $data[] = $row;
        }

        return $data;
    }

    protected function normalizeColumns()
    {
        $formatters = $this->getFormatters();

        foreach ($this->columns as $index => $column) {

            // convert shorthand string and int configs to array
            if (is_string($column)) {
                $column = explode(':', $column);
            } elseif (is_int($column)) {
                $column = [$column];
            }

            // default to 'raw' formatter if none is specified
            if (!isset($column[1])) {
                $column[1] = 'raw';
            }

            // assign built-in formatters
            if (!is_callable($column[1])) {
                if (array_key_exists($column[1], $formatters)) {
                    $column[1] = $formatters[$column[1]];
                } else {
                    throw new InvalidConfigException("Invalid formatter for column: {$column[0]}.");
                }
            }

            $this->columns[$index] = $column;
        }
    }



    protected function getFormatters()
    {
        return [
            'datetime' => function ($val) { return (float) strtotime($val) * 1000; },
            'int' => 'intval',
            'float' => 'floatval',
            'raw' => function ($val) { return $val; },
            'string' => 'strval',
            'timestamp' => function ($val) { return (float) $val * 1000; },
        ];
    }
}
