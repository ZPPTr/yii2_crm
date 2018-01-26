<?php
namespace common\components;

use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * Class ActiveRecord
 *
 * @method forceDelete()
 *
 * @package common\components
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function trySave($runValidation = true, $attributeNames = null)
    {
        if (false === $this->save($runValidation, $attributeNames)) {
            throw new \LogicException;
        }
        return true;
    }

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function tryUpdate($runValidation = true, $attributeNames = null)
    {
        if (false === $this->update($runValidation, $attributeNames)) {
            throw new \LogicException;
        }
        return true;
    }

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function tryInsert($runValidation = true, $attributeNames = null)
    {
        if (false === $this->insert($runValidation, $attributeNames)) {
            throw new \LogicException;
        }
        return true;
    }
    public static function updateAllUsingQuery( $attributes, Query $query, $params = [ ] )
    {

        $params = array_merge( $params, $query->params );

        if (is_null( $query->join )) {
            return static::updateAll( $attributes, $query->where, $params );
        }

        $command = static::getDb()->createCommand();
        $builder = static::getDb()->getQueryBuilder();

        $tableAlias = '{{t}}';

        $sql = $builder->update( static::tableName(), $attributes, $query->where, $params );

        $join = $builder->buildJoin( $query->join, $params );
        $sql = preg_replace( '/^UPDATE (.+) SET/', 'UPDATE $1 ' . $tableAlias . ' ' . $join . ' SET', $sql );

        if ($tableAlias != '') {

            // fixing SET statement
            $sql = preg_replace_callback(
                '/^(.+ SET)(.+?)(WHERE .+)?$/',
                function ( $m ) use ( $tableAlias ) {

                    $m[ 2 ] = preg_replace(
                    // search fields without specified table
                        '/(?<!\.)(?:\[\[|`)(\w+)(?:\]\]|`)(?!\.)/',
                        $tableAlias . '.[[$1]]',
                        $m[ 2 ]
                    );

                    return $m[ 1 ] . $m[ 2 ] . ( isset( $m[ 3 ] ) ? $m[ 3 ] : '' );
                },
                $sql
            );

        }

        $command->setSql( $sql )->bindValues( $params );

        return $command->execute();
    }

    /**
     * Данные для элемента формы DropDownList
     * Возвращает массив записей или пустой массив
     *
     * @param string $indexField - атрибут индексации
     * @param string $labelField - атрибут отображаемого имени
     * @return array
     */
    public static function listAll($indexField = 'id', $labelField = 'name', $query = false)
    {
        if (!$query){
            $query = static::find();
        }
        $models = $query
            ->asArray()
            ->all();
        $items = array_column($models, $labelField, $indexField);

        return (count($items) > 0) ? $items : [];
    }

    /**
     * @param $models
     * @param bool $force
     * @throws \Error
     */
    public static function deleteAllModels($models, $force = false)
    {
        if($models) {
            foreach($models as $model) {
                if($model instanceof ActiveRecord) {
                    if($force) {
                        $model->forceDelete();
                    } else {
                        $model->delete();
                    }
                } else {
                    throw new \Error('$model must be instanceof AR');
                }

            }
        }
    }

    /**
     * @return mixed Возвращает имя класса
     */
    public static function getModelName()
    {
        $string  = (string) get_called_class();
        preg_match("/.*?([A-Z].*)/",$string,$out);
        return $out[1];
    }

    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'id' => $this->id,
//            'default' => $this->default,
//            'createdAt' => $this->createdAt,
//            'updatedAt' => $this->updatedAt,
//            'status' => $this->status,
//        ]);
//
//        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}