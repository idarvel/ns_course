<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;


/**
 * Filter custom data
 */
class FiltersForm extends Model
{

    public $id, $price, $categoryName, $hidden;
    private $_params;

    public function rules()
    {
        return [
            [['id', 'price', 'categoryName', 'hidden'], 'integer'],
            [['categoryName'], 'string'],
        ];
    }

    /**
     * Prepare array with applyed filters.
     *
     * @param array $data
     * @param array $params
     * @return ArrayDataProvider
     */
    public function search($data, $params = [])
    {
        $this->_params = $params;

        return new ArrayDataProvider([
            'allModels' => $this->getData($data),
            'sort' => [
                'attributes' => ['id', 'price', 'categoryName', 'hidden'],
            ],
        ]);
    }

    /**
     * Filtered array by params.
     *
     * @param array $data
     * @return array
     */
    protected function getData($data)
    {
        if ($this->_params) {
            $data = array_filter($data, function ($value) {
                $conditions = [true];
                foreach ($this->_params as $attribute => $search_value) {
                    $search_value = trim($search_value);
                    if (isset($search_value) and $search_value !== '') {
                        $conditions[] = strpos($value[$attribute], $search_value) !== false;
                    }
                }
                return array_product($conditions);
            });
        }

        return $data;
    }

}