<?php

namespace Home\Service;

use Common\Library\ClassUtil;

class BaseService {

    /**
     * 获取model对象
     * @param string $modelName 名称
     * @return object 返回 instance of BaseModel对象
     */
    public function getModel($modelName = '') {
        if (empty($modelName)) {
            $modelName = preg_replace('/Service$/i', '', ClassUtil::getClassName(get_class($this)));
        }

        $modelName = MODULE_NAME . '\\Model\\' . ucfirst($modelName) . 'Model';
        if (!class_exists($modelName)) {
            throw new \Exception(get_lang('CLASS_NOT_FOUND', $modelName));
        }

        return new $modelName();
    }

    /**
     * 根据主键id获取一条数据
     * 成功返回数据,失败返回false
     */
    public function getRowById($id, $options = array()) {
        $model = $this->getModel($options['model_name']);
        return $model->getByIds(intval($id));
    }

    /**
     * 根据主键ids 获取多条数据, 返回哪些是存在的,哪些不存在
     * 成功返回array('succ' => array(), 'fail' => array()), 失败返回false
     */
    public function getRowsByIds($ids, $options = array()) {
        $ids = array_unique(array_map('intval', (array) $ids));
        $model = $this->getModel($options['model_name']);
        $result = $model->getByIds($ids);
        if (false === $result) {
            return $result;
        }

        $return = array();
        foreach ($result as $item) {
            $return['succ'][$item['id']] = $item;
        }

        $return['fail'] = array_diff($ids, array_keys($return['succ']));
        return $return;
    }

    /**
     * 根据给定数组获取查询结果，只支持等值查询, 例如 array('age' => 18, 'status' => array(1, 2)), 将查询出 age = 18 and status in (1, 2)的数据
     * 成功返回数组，失败返回false
     */
    public function getRowsByEquals(array $data, $options = array()) {
        $model = $this->getModel($options['model_name']);
        return $model->getByEqualsConds($data, $options['fetch_count']);
    }

    /**
     * 保存一条数据 主键存在时是更新数据
     * 成功返回保存数据,失败返回false
     */
    public function saveRow(array $data, $options = array()) {
        $data['update_time'] = time();
        if (empty($data['id'])) {
            $data['create_time'] = $data['update_time'];
            $data['is_delete'] = 0;
            unset($data['id']);
        }

        $model = $this->getModel($options['model_name']);
        return empty($data['id']) ? $model->insertRow($data) : $model->updateRow($data);
    }

    /**
     * 保存多条数据 主键存在时是更新数据 输入array(array(), array())
     * 使用事务时，成功返回: array(array(), array()), 失败返回 false
     * 不使用事务时，返回array('succ' => array(), 'fail' => array())
     */
    public function saveRows(array $data, $options = array()) {
        if ($options['use_tx']) {
            $this->begin();
        }

        $return = array();
        foreach ($data as $key => $row) {
            $row['update_time'] = time();
            if (empty($row['id'])) {
                $row['create_time'] = $row['update_time'];
                $row['is_delete'] = 0;
                unset($row['id']);
            }

            $model = $this->getModel($options['model_name']);
            $result = empty($row['id']) ? $model->insertRow($row) : $model->updateRow($row);
            if (false === $result) {
                if ($options['use_tx']) {
                    $this->rollback();
                    return false;
                }
                $return['fail'][] = $row;
            } else {
                $return['succ'][] = $result;
            }
        }

        if ($options['use_tx']) {
            $this->commit();
            return $return['succ'];
        }

        return $return;
    }

}
