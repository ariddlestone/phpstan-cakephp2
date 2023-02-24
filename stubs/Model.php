<?php

class Model extends CakeObject implements CakeEventListener
{
    /**
     * @var string
     */
    public $useDbConfig = 'default';

    /**
     * @var string|false
     */
    public $useTable = null;

    /**
     * @var string|null
     */
    public $displayField = null;

    /**
     * @var int|string|null
     */
    public $id = false;

    /**
     * @var array<string, mixed>|false
     */
    public $data = array();

    /**
     * @var string
     */
    public $schemaName = null;

    /**
     * @var string
     */
    public $table = false;

    /**
     * @var string
     */
    public $primaryKey = null;

    /**
     * @var array<string, array{
     *     type: string,
     *     null: bool,
     *     default: mixed,
     *     key: mixed,
     *     length: int,
     *     extra: mixed
     * }>|null
     */
    protected $_schema = null;

    /**
     * @var array<string, mixed>
     */
    public $validate = array();

    /**
     * @var array<string, mixed>
     */
    public $validationErrors = array();

    /**
     * @var string|null
     */
    public $validationDomain = null;

    /**
     * @var string|null
     */
    public $tablePrefix = null;

    /**
     * @var string|null
     */
    public $plugin = null;

    /**
     * @var string
     */
    public $name = null;

    /**
     * @var string
     */
    public $alias = null;

    /**
     * @var array<string, string>
     */
    public $tableToModel = array();

    /**
     * @var bool
     */
    public $cacheQueries = false;

    /**
     * @var array<string|array{
     *     className?: string,
     *     foreignKey?: string,
     *     conditions?: string,
     *     type?: string,
     *     fields?: array<string>,
     *     order?: string,
     *     counterCache?: bool|string,
     *     counterScope?: array<string>
     * }>
     */
    public $belongsTo = array();

    /**
     * @var array<string|array{
     *     className?: string,
     *     foreignKey?: string,
     *     conditions?: string,
     *     fields?: array<string>,
     *     order?: string,
     *     dependent?: bool
     * }>
     */
    public $hasOne = array();

    /**
     * @var array<string|array{
     *     className?: string,
     *     foreignKey?: string,
     *     conditions?: string,
     *     fields?: array<string>,
     *     order?: string,
     *     limit?: int,
     *     offset?: int,
     *     dependent?: bool,
     *     exclusive?: bool,
     *     finderQuery?: string
     * }>
     */
    public $hasMany = array();

    /**
     * @var array<string|array{
     *     className?: string,
     *     joinTable?: string,
     *     with?: string,
     *     foreignKey?: string,
     *     associationForeignKey?: string,
     *     unique?: bool,
     *     conditions?: string,
     *     fields?: array<string>,
     *     order?: string,
     *     limit?: int,
     *     offset?: int,
     *     finderQuery?: string
     * }>
     */
    public $hasAndBelongsToMany = array();

    /**
     * @var array<string|array<mixed>>
     */
    public $actsAs = null;

    /**
     * @var BehaviorCollection
     */
    public $Behaviors = null;

    /**
     * @var array<string>
     */
    public $whitelist = array();

    /**
     * @var bool
     */
    public $cacheSources = true;

    /**
     * @var string|null
     */
    public $findQueryType = null;

    /**
     * @var int
     */
    public $recursive = 1;

    /**
     * @var string|array<string>
     */
    public $order = null;

    /**
     * @var array<string, string>
     */
    public $virtualFields = array();

    /**
     * @var array<string, array<string>>
     */
    protected $_associationKeys = array(
        'belongsTo' => array('className', 'foreignKey', 'conditions', 'fields', 'order', 'counterCache'),
        'hasOne' => array('className', 'foreignKey', 'conditions', 'fields', 'order', 'dependent'),
        'hasMany' => array('className', 'foreignKey', 'conditions', 'fields', 'order', 'limit', 'offset', 'dependent', 'exclusive', 'finderQuery', 'counterQuery'),
        'hasAndBelongsToMany' => array('className', 'joinTable', 'with', 'foreignKey', 'associationForeignKey', 'conditions', 'fields', 'order', 'limit', 'offset', 'unique', 'finderQuery')
    );

    /**
     * @var array<string>
     */
    protected $_associations = array('belongsTo', 'hasOne', 'hasMany', 'hasAndBelongsToMany');

    /**
     * @var array<string, array<mixed>>
     */
    public $__backAssociation = array();

    /**
     * @var array<mixed>
     */
    public $__backInnerAssociation = array();

    /**
     * @var array<mixed>
     */
    public $__backOriginalAssociation = array();

    /**
     * @var array<mixed>
     */
    public $__backContainableAssociation = array();

    /**
     * @var bool
     */
    public $__safeUpdateMode = false;

    /**
     * @var bool
     */
    public $useConsistentAfterFind = true;

    /**
     * @var int|string
     */
    protected $_insertID = null;

    /**
     * @var bool
     */
    protected $_sourceConfigured = false;

    /**
     * @var array<string, bool>
     */
    public $findMethods = array(
        'all' => true, 'first' => true, 'count' => true,
        'neighbors' => true, 'list' => true, 'threaded' => true
    );

    /**
     * @var CakeEventManager|null
     */
    protected $_eventManager = null;

    /**
     * @var ModelValidator|null
     */
    protected $_validator = null;

    /**
     * @param false|int|string|array{
     *     id?: false|int|string,
     *     table?: string|false|null,
     *     ds?: string|null,
     *     name?: string,
     *     alias?: string
     * } $id
     * @param string|false|null $table
     * @param string|null $ds
     */
    public function __construct($id = false, $table = null, $ds = null) {}

    /**
     * @return array<string, array{callable: string, passParams: bool}>
     */
    public function implementedEvents() {}

    /**
     * @return CakeEventManager
     */
    public function getEventManager() {}

    /**
     * @param array<string, array<string|array<string, mixed>> $params
     * @param bool $reset
     * @return bool
     */
    public function bindModel($params, $reset = true) {}

    /**
     * @param array<string, string|array<string>> $params
     * @param bool $reset
     * @return bool
     */
    public function unbindModel($params, $reset = true) {}

    /**
     * @return void
     */
    protected function _createLinks() {}

    /**
     * @param string $assoc
     * @param string|null $className
     * @param string|null $plugin
     * @return void
     */
    protected function _constructLinkedModel($assoc, $className = null, $plugin = null) {}

    /**
     * @param 'belongsTo'|'hasOne'|'hasMany'|'hasAndBelongsToMany' $type
     * @param string $assocKey
     * @return void
     */
    protected function _generateAssociation($type, $assocKey) {}

    /**
     * @param string $tableName
     * @throws MissingTableException
     * @return void
     */
    public function setSource($tableName) {}

    /**
     * @param string|array<string, mixed>|SimpleXmlElement|DomNode $one
     * @param mixed|null $two
     * @return array<string, mixed>|null
     */
    public function set($one, $two = null) {}

    /**
     * Move values to alias
     *
     * @param array<string, mixed> $data Data.
     * @return array<string, mixed>
     */
    protected function _setAliasData($data) {}

    /**
     * @param array<string, mixed> $xml
     * @return array<string, mixed>
     */
    protected function _normalizeXmlData(array $xml) {}

    /**
     * @param string $field
     * @param array<string, mixed>|object $data
     * @return mixed
     */
    public function deconstruct($field, $data) {}

    /**
     * @phpstan-type FieldSchema array{
     *     type: string,
     *     null: bool,
     *     default: mixed,
     *     length: int|mixed|null,
     *     key?: 'primary'|'index'|'unique',
     *     extra?: mixed,
     *     unsigned?: bool,
     *     charset?: string,
     *     collate?: string,
     *     comment?: string
     * }
     *
     * @param bool|string $field
     * @return ($field is string ? FieldSchema : array<string, FieldSchema>)|null
     */
    public function schema($field = false) {}

    /**
     * @return array<string, string>
     */
    public function getColumnTypes() {}

    /**
     * @param string $column
     * @return string|null
     */
    public function getColumnType($column) {}

    /**
     * @param string|array $name
     * @param bool $checkVirtual
     * @return ($name is string ? bool : string|false)
     */
    public function hasField($name, $checkVirtual = false) {}

    /**
     * @param string $method
     * @return bool
     */
    public function hasMethod($method) {}

    /**
     * @param string $field
     * @return bool
     */
    public function isVirtualField($field) {}

    /**
     * @param string|null $field
     * @return ($field is null ? array<string, string>|false : string|false)
     */
    public function getVirtualField($field = null) {}

    // TODO - got to here!

    /**
     * Initializes the model for writing a new record, loading the default values
     * for those fields that are not defined in $data, and clearing previous validation errors.
     * Especially helpful for saving data in loops.
     *
     * @param bool|array $data Optional data array to assign to the model after it is created. If null or false,
     *   schema data defaults are not merged.
     * @param bool $filterKey If true, overwrites any primary key input with an empty value
     * @return array The current Model::data; after merging $data and/or defaults from database
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-create-array-data-array
     */
    public function create($data = array(), $filterKey = false) {
        $defaults = array();
        $this->id = false;
        $this->data = array();
        $this->validationErrors = array();

        if ($data !== null && $data !== false) {
            $schema = (array)$this->schema();
            foreach ($schema as $field => $properties) {
                if ($this->primaryKey !== $field && isset($properties['default']) && $properties['default'] !== '') {
                    $defaults[$field] = $properties['default'];
                }
            }

            $this->set($defaults);
            $this->set($data);
        }

        if ($filterKey) {
            $this->set($this->primaryKey, false);
        }

        return $this->data;
    }

    /**
     * This function is a convenient wrapper class to create(false) and, as the name suggests, clears the id, data, and validation errors.
     *
     * @return bool Always true upon success
     * @see Model::create()
     */
    public function clear() {
        $this->create(false);
        return true;
    }

    /**
     * Returns a list of fields from the database, and sets the current model
     * data (Model::$data) with the record found.
     *
     * @param string|array $fields String of single field name, or an array of field names.
     * @param int|string $id The ID of the record to read
     * @return array|false Array of database fields, or false if not found
     * @link https://book.cakephp.org/2.0/en/models/retrieving-your-data.html#model-read
     */
    public function read($fields = null, $id = null) {
        $this->validationErrors = array();

        if ($id) {
            $this->id = $id;
        }

        $id = $this->id;

        if (is_array($this->id)) {
            $id = $this->id[0];
        }

        if ($id !== null && $id !== false) {
            $this->data = $this->find('first', array(
                'conditions' => array($this->alias . '.' . $this->primaryKey => $id),
                'fields' => $fields
            ));

            return $this->data;
        }

        return false;
    }

    /**
     * Returns the content of a single field given the supplied conditions,
     * of the first record in the supplied order.
     *
     * @param string $name The name of the field to get.
     * @param array $conditions SQL conditions (defaults to NULL).
     * @param string|array $order SQL ORDER BY fragment.
     * @return string|false Field content, or false if not found.
     * @link https://book.cakephp.org/2.0/en/models/retrieving-your-data.html#model-field
     */
    public function field($name, $conditions = null, $order = null) {
        if ($conditions === null && !in_array($this->id, array(false, null), true)) {
            $conditions = array($this->alias . '.' . $this->primaryKey => $this->id);
        }

        $recursive = $this->recursive;
        if ($this->recursive >= 1) {
            $recursive = -1;
        }

        $fields = $name;
        $data = $this->find('first', compact('conditions', 'fields', 'order', 'recursive'));
        if (!$data) {
            return false;
        }

        if (strpos($name, '.') === false) {
            if (isset($data[$this->alias][$name])) {
                return $data[$this->alias][$name];
            }
        } else {
            $name = explode('.', $name);
            if (isset($data[$name[0]][$name[1]])) {
                return $data[$name[0]][$name[1]];
            }
        }

        if (isset($data[0]) && count($data[0]) > 0) {
            return array_shift($data[0]);
        }
    }

    /**
     * Saves the value of a single field to the database, based on the current
     * model ID.
     *
     * @param string $name Name of the table field
     * @param mixed $value Value of the field
     * @param bool|array $validate Either a boolean, or an array.
     *   If a boolean, indicates whether or not to validate before saving.
     *   If an array, allows control of 'validate', 'callbacks' and 'counterCache' options.
     *   See Model::save() for details of each options.
     * @return bool|array See Model::save() False on failure or an array of model data on success.
     * @deprecated 3.0.0 To ease migration to the new major, do not use this method anymore.
     *   Stateful model usage will be removed. Use the existing save() methods instead.
     * @see Model::save()
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-savefield-string-fieldname-string-fieldvalue-validate-false
     */
    public function saveField($name, $value, $validate = false) {
        $id = $this->id;
        $this->create(false);

        $options = array('validate' => $validate, 'fieldList' => array($name));
        if (is_array($validate)) {
            $options = $validate + array('validate' => false, 'fieldList' => array($name));
        }

        return $this->save(array($this->alias => array($this->primaryKey => $id, $name => $value)), $options);
    }

    /**
     * Saves model data (based on white-list, if supplied) to the database. By
     * default, validation occurs before save. Passthrough method to _doSave() with
     * transaction handling.
     *
     * @param array $data Data to save.
     * @param bool|array $validate Either a boolean, or an array.
     *   If a boolean, indicates whether or not to validate before saving.
     *   If an array, can have following keys:
     *
     *   - atomic: If true (default), will attempt to save the record in a single transaction.
     *   - validate: Set to true/false to enable or disable validation.
     *   - fieldList: An array of fields you want to allow for saving.
     *   - callbacks: Set to false to disable callbacks. Using 'before' or 'after'
     *     will enable only those callbacks.
     *   - `counterCache`: Boolean to control updating of counter caches (if any)
     *
     * @param array $fieldList List of fields to allow to be saved
     * @return mixed On success Model::$data if its not empty or true, false on failure
     * @throws Exception
     * @throws PDOException
     * @triggers Model.beforeSave $this, array($options)
     * @triggers Model.afterSave $this, array($created, $options)
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html
     */
    public function save($data = null, $validate = true, $fieldList = array()) {
        $defaults = array(
            'validate' => true, 'fieldList' => array(),
            'callbacks' => true, 'counterCache' => true,
            'atomic' => true
        );

        if (!is_array($validate)) {
            $options = compact('validate', 'fieldList') + $defaults;
        } else {
            $options = $validate + $defaults;
        }

        if (!$options['atomic']) {
            return $this->_doSave($data, $options);
        }

        $db = $this->getDataSource();
        $transactionBegun = $db->begin();
        try {
            $success = $this->_doSave($data, $options);
            if ($transactionBegun) {
                if ($success) {
                    $db->commit();
                } else {
                    $db->rollback();
                }
            }
            return $success;
        } catch (Exception $e) {
            if ($transactionBegun) {
                $db->rollback();
            }
            throw $e;
        }
    }

    /**
     * Saves model data (based on white-list, if supplied) to the database. By
     * default, validation occurs before save.
     *
     * @param array $data Data to save.
     * @param array $options can have following keys:
     *
     *   - validate: Set to true/false to enable or disable validation.
     *   - fieldList: An array of fields you want to allow for saving.
     *   - callbacks: Set to false to disable callbacks. Using 'before' or 'after'
     *      will enable only those callbacks.
     *   - `counterCache`: Boolean to control updating of counter caches (if any)
     *
     * @return mixed On success Model::$data if its not empty or true, false on failure
     * @throws PDOException
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html
     */
    protected function _doSave($data = null, $options = array()) {
        $_whitelist = $this->whitelist;
        $fields = array();

        if (!empty($options['fieldList'])) {
            if (!empty($options['fieldList'][$this->alias]) && is_array($options['fieldList'][$this->alias])) {
                $this->whitelist = $options['fieldList'][$this->alias];
            } elseif (Hash::dimensions($options['fieldList']) < 2) {
                $this->whitelist = $options['fieldList'];
            }
        } elseif ($options['fieldList'] === null) {
            $this->whitelist = array();
        }

        $this->set($data);

        if (empty($this->data) && !$this->hasField(array('created', 'updated', 'modified'))) {
            $this->whitelist = $_whitelist;
            return false;
        }

        foreach (array('created', 'updated', 'modified') as $field) {
            $keyPresentAndEmpty = (
                isset($this->data[$this->alias]) &&
                array_key_exists($field, $this->data[$this->alias]) &&
                $this->data[$this->alias][$field] === null
            );

            if ($keyPresentAndEmpty) {
                unset($this->data[$this->alias][$field]);
            }
        }

        $exists = $this->exists($this->getID());
        $dateFields = array('modified', 'updated');

        if (!$exists) {
            $dateFields[] = 'created';
        }

        if (isset($this->data[$this->alias])) {
            $fields = array_keys($this->data[$this->alias]);
        }

        if ($options['validate'] && !$this->validates($options)) {
            $this->whitelist = $_whitelist;
            return false;
        }

        $db = $this->getDataSource();
        $now = time();

        foreach ($dateFields as $updateCol) {
            $fieldHasValue = in_array($updateCol, $fields);
            $fieldInWhitelist = (
                count($this->whitelist) === 0 ||
                in_array($updateCol, $this->whitelist)
            );
            if (($fieldHasValue && $fieldInWhitelist) || !$this->hasField($updateCol)) {
                continue;
            }

            $default = array('formatter' => 'date');
            $colType = array_merge($default, $db->columns[$this->getColumnType($updateCol)]);

            $time = $now;
            if (array_key_exists('format', $colType)) {
                $time = call_user_func($colType['formatter'], $colType['format']);
            }

            if (!empty($this->whitelist)) {
                $this->whitelist[] = $updateCol;
            }
            $this->set($updateCol, $time);
        }

        if ($options['callbacks'] === true || $options['callbacks'] === 'before') {
            $event = new CakeEvent('Model.beforeSave', $this, array($options));
            list($event->break, $event->breakOn) = array(true, array(false, null));
            $this->getEventManager()->dispatch($event);
            if (!$event->result) {
                $this->whitelist = $_whitelist;
                return false;
            }
        }

        if (empty($this->data[$this->alias][$this->primaryKey])) {
            unset($this->data[$this->alias][$this->primaryKey]);
        }
        $joined = $fields = $values = array();

        foreach ($this->data as $n => $v) {
            if (isset($this->hasAndBelongsToMany[$n])) {
                if (isset($v[$n])) {
                    $v = $v[$n];
                }
                $joined[$n] = $v;
            } elseif ($n === $this->alias) {
                foreach (array('created', 'updated', 'modified') as $field) {
                    if (array_key_exists($field, $v) && empty($v[$field])) {
                        unset($v[$field]);
                    }
                }

                foreach ($v as $x => $y) {
                    if ($this->hasField($x) && (empty($this->whitelist) || in_array($x, $this->whitelist))) {
                        list($fields[], $values[]) = array($x, $y);
                    }
                }
            }
        }

        if (empty($fields) && empty($joined)) {
            $this->whitelist = $_whitelist;
            return false;
        }

        $count = count($fields);

        if (!$exists && $count > 0) {
            $this->id = false;
        }

        $success = true;
        $created = false;

        if ($count > 0) {
            $cache = $this->_prepareUpdateFields(array_combine($fields, $values));

            if (!empty($this->id)) {
                $this->__safeUpdateMode = true;
                try {
                    $success = (bool)$db->update($this, $fields, $values);
                } catch (Exception $e) {
                    $this->__safeUpdateMode = false;
                    throw $e;
                }
                $this->__safeUpdateMode = false;
            } else {
                if (empty($this->data[$this->alias][$this->primaryKey]) && $this->_isUUIDField($this->primaryKey)) {
                    if (array_key_exists($this->primaryKey, $this->data[$this->alias])) {
                        $j = array_search($this->primaryKey, $fields);
                        $values[$j] = CakeText::uuid();
                    } else {
                        list($fields[], $values[]) = array($this->primaryKey, CakeText::uuid());
                    }
                }

                if (!$db->create($this, $fields, $values)) {
                    $success = false;
                } else {
                    $created = true;
                }
            }

            if ($success && $options['counterCache'] && !empty($this->belongsTo)) {
                $this->updateCounterCache($cache, $created);
            }
        }

        if ($success && !empty($joined)) {
            $this->_saveMulti($joined, $this->id, $db);
        }

        if (!$success) {
            $this->whitelist = $_whitelist;
            return $success;
        }

        if ($count > 0) {
            if ($created) {
                $this->data[$this->alias][$this->primaryKey] = $this->id;
            }

            if ($options['callbacks'] === true || $options['callbacks'] === 'after') {
                $event = new CakeEvent('Model.afterSave', $this, array($created, $options));
                $this->getEventManager()->dispatch($event);
            }
        }

        if (!empty($this->data)) {
            $success = $this->data;
        }

        $this->_clearCache();
        $this->validationErrors = array();
        $this->whitelist = $_whitelist;
        $this->data = false;

        return $success;
    }

    /**
     * Check if the passed in field is a UUID field
     *
     * @param string $field the field to check
     * @return bool
     */
    protected function _isUUIDField($field) {
        $field = $this->schema($field);
        return $field !== null && $field['length'] == 36 && in_array($field['type'], array('string', 'binary', 'uuid'));
    }

    /**
     * Saves model hasAndBelongsToMany data to the database.
     *
     * @param array $joined Data to save
     * @param int|string $id ID of record in this model
     * @param DataSource $db Datasource instance.
     * @return void
     */
    protected function _saveMulti($joined, $id, $db) {
        foreach ($joined as $assoc => $data) {
            if (!isset($this->hasAndBelongsToMany[$assoc])) {
                continue;
            }

            $habtm = $this->hasAndBelongsToMany[$assoc];

            list($join) = $this->joinModel($habtm['with']);

            $Model = $this->{$join};

            if (!empty($habtm['with'])) {
                $withModel = is_array($habtm['with']) ? key($habtm['with']) : $habtm['with'];
                list(, $withModel) = pluginSplit($withModel);
                $dbMulti = $this->{$withModel}->getDataSource();
            } else {
                $dbMulti = $db;
            }

            $isUUID = !empty($Model->primaryKey) && $Model->_isUUIDField($Model->primaryKey);

            $newData = $newValues = $newJoins = array();
            $primaryAdded = false;

            $fields = array(
                $dbMulti->name($habtm['foreignKey']),
                $dbMulti->name($habtm['associationForeignKey'])
            );

            $idField = $db->name($Model->primaryKey);
            if ($isUUID && !in_array($idField, $fields)) {
                $fields[] = $idField;
                $primaryAdded = true;
            }

            foreach ((array)$data as $row) {
                if ((is_string($row) && (strlen($row) === 36 || strlen($row) === 16)) || is_numeric($row)) {
                    $newJoins[] = $row;
                    $values = array($id, $row);

                    if ($isUUID && $primaryAdded) {
                        $values[] = CakeText::uuid();
                    }

                    $newValues[$row] = $values;
                    unset($values);
                } elseif (isset($row[$habtm['associationForeignKey']])) {
                    if (!empty($row[$Model->primaryKey])) {
                        $newJoins[] = $row[$habtm['associationForeignKey']];
                    }

                    $newData[] = $row;
                } elseif (isset($row[$join]) && isset($row[$join][$habtm['associationForeignKey']])) {
                    if (!empty($row[$join][$Model->primaryKey])) {
                        $newJoins[] = $row[$join][$habtm['associationForeignKey']];
                    }

                    $newData[] = $row[$join];
                }
            }

            $keepExisting = $habtm['unique'] === 'keepExisting';
            if ($habtm['unique']) {
                $conditions = array(
                    $join . '.' . $habtm['foreignKey'] => $id
                );

                if (!empty($habtm['conditions'])) {
                    $conditions = array_merge($conditions, (array)$habtm['conditions']);
                }

                $associationForeignKey = $Model->alias . '.' . $habtm['associationForeignKey'];
                $links = $Model->find('all', array(
                    'conditions' => $conditions,
                    'recursive' => empty($habtm['conditions']) ? -1 : 0,
                    'fields' => $associationForeignKey,
                ));

                $oldLinks = Hash::extract($links, "{n}.{$associationForeignKey}");
                if (!empty($oldLinks)) {
                    if ($keepExisting && !empty($newJoins)) {
                        $conditions[$associationForeignKey] = array_diff($oldLinks, $newJoins);
                    } else {
                        $conditions[$associationForeignKey] = $oldLinks;
                    }

                    $dbMulti->delete($Model, $conditions);
                }
            }

            if (!empty($newData)) {
                foreach ($newData as $data) {
                    $data[$habtm['foreignKey']] = $id;
                    if (empty($data[$Model->primaryKey])) {
                        $Model->create();
                    }

                    $Model->save($data, array('atomic' => false));
                }
            }

            if (!empty($newValues)) {
                if ($keepExisting && !empty($links)) {
                    foreach ($links as $link) {
                        $oldJoin = $link[$join][$habtm['associationForeignKey']];
                        if (!in_array($oldJoin, $newJoins)) {
                            $conditions[$associationForeignKey] = $oldJoin;
                            $db->delete($Model, $conditions);
                        } else {
                            unset($newValues[$oldJoin]);
                        }
                    }

                    $newValues = array_values($newValues);
                }

                if (!empty($newValues)) {
                    $dbMulti->insertMulti($Model, $fields, $newValues);
                }
            }
        }
    }

    /**
     * Updates the counter cache of belongsTo associations after a save or delete operation
     *
     * @param array $keys Optional foreign key data, defaults to the information $this->data
     * @param bool $created True if a new record was created, otherwise only associations with
     *   'counterScope' defined get updated
     * @return void
     */
    public function updateCounterCache($keys = array(), $created = false) {
        if (empty($keys) && isset($this->data[$this->alias])) {
            $keys = $this->data[$this->alias];
        }
        $keys['old'] = isset($keys['old']) ? $keys['old'] : array();

        foreach ($this->belongsTo as $parent => $assoc) {
            if (empty($assoc['counterCache'])) {
                continue;
            }

            $Model = $this->{$parent};

            if (!is_array($assoc['counterCache'])) {
                if (isset($assoc['counterScope'])) {
                    $assoc['counterCache'] = array($assoc['counterCache'] => $assoc['counterScope']);
                } else {
                    $assoc['counterCache'] = array($assoc['counterCache'] => array());
                }
            }

            $foreignKey = $assoc['foreignKey'];
            $fkQuoted = $this->escapeField($assoc['foreignKey']);

            foreach ($assoc['counterCache'] as $field => $conditions) {
                if (!is_string($field)) {
                    $field = Inflector::underscore($this->alias) . '_count';
                }

                if (!$Model->hasField($field)) {
                    continue;
                }

                if ($conditions === true) {
                    $conditions = array();
                } else {
                    $conditions = (array)$conditions;
                }

                if (!array_key_exists($foreignKey, $keys)) {
                    $keys[$foreignKey] = $this->field($foreignKey);
                }

                $recursive = (empty($conditions) ? -1 : 0);

                if (isset($keys['old'][$foreignKey]) && $keys['old'][$foreignKey] != $keys[$foreignKey]) {
                    $conditions[$fkQuoted] = $keys['old'][$foreignKey];
                    $count = (int)$this->find('count', compact('conditions', 'recursive'));

                    $Model->updateAll(
                        array($field => $count),
                        array($Model->escapeField() => $keys['old'][$foreignKey])
                    );
                }

                $conditions[$fkQuoted] = $keys[$foreignKey];

                if ($recursive === 0) {
                    $conditions = array_merge($conditions, (array)$conditions);
                }

                $count = (int)$this->find('count', compact('conditions', 'recursive'));

                $Model->updateAll(
                    array($field => $count),
                    array($Model->escapeField() => $keys[$foreignKey])
                );
            }
        }
    }

    /**
     * Helper method for `Model::updateCounterCache()`. Checks the fields to be updated for
     *
     * @param array $data The fields of the record that will be updated
     * @return array Returns updated foreign key values, along with an 'old' key containing the old
     *     values, or empty if no foreign keys are updated.
     */
    protected function _prepareUpdateFields($data) {
        $foreignKeys = array();
        foreach ($this->belongsTo as $assoc => $info) {
            if (isset($info['counterCache']) && $info['counterCache']) {
                $foreignKeys[$assoc] = $info['foreignKey'];
            }
        }

        $included = array_intersect($foreignKeys, array_keys($data));

        if (empty($included) || empty($this->id)) {
            return array();
        }

        $old = $this->find('first', array(
            'conditions' => array($this->alias . '.' . $this->primaryKey => $this->id),
            'fields' => array_values($included),
            'recursive' => -1
        ));

        return array_merge($data, array('old' => $old[$this->alias]));
    }

    /**
     * Backwards compatible passthrough method for:
     * saveMany(), validateMany(), saveAssociated() and validateAssociated()
     *
     * Saves multiple individual records for a single model; Also works with a single record, as well as
     * all its associated records.
     *
     * #### Options
     *
     * - `validate`: Set to false to disable validation, true to validate each record before saving,
     *   'first' to validate *all* records before any are saved (default),
     *   or 'only' to only validate the records, but not save them.
     * - `atomic`: If true (default), will attempt to save all records in a single transaction.
     *   Should be set to false if database/table does not support transactions.
     * - `fieldList`: Equivalent to the $fieldList parameter in Model::save().
     *   It should be an associate array with model name as key and array of fields as value. Eg.
     *   ```
     *   array(
     *       'SomeModel' => array('field'),
     *       'AssociatedModel' => array('field', 'otherfield')
     *   )
     *   ```
     * - `deep`: See saveMany/saveAssociated
     * - `callbacks`: See Model::save()
     * - `counterCache`: See Model::save()
     *
     * @param array $data Record data to save. This can be either a numerically-indexed array (for saving multiple
     *     records of the same type), or an array indexed by association name.
     * @param array $options Options to use when saving record data, See $options above.
     * @return mixed If atomic: True on success, or false on failure.
     *    Otherwise: array similar to the $data array passed, but values are set to true/false
     *    depending on whether each record saved successfully.
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-saveassociated-array-data-null-array-options-array
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-saveall-array-data-null-array-options-array
     */
    public function saveAll($data = array(), $options = array()) {
        $options += array('validate' => 'first');
        if (Hash::numeric(array_keys($data))) {
            if ($options['validate'] === 'only') {
                return $this->validateMany($data, $options);
            }

            return $this->saveMany($data, $options);
        }

        if ($options['validate'] === 'only') {
            return $this->validateAssociated($data, $options);
        }

        return $this->saveAssociated($data, $options);
    }

    /**
     * Saves multiple individual records for a single model
     *
     * #### Options
     *
     * - `validate`: Set to false to disable validation, true to validate each record before saving,
     *   'first' to validate *all* records before any are saved (default),
     * - `atomic`: If true (default), will attempt to save all records in a single transaction.
     *   Should be set to false if database/table does not support transactions.
     * - `fieldList`: Equivalent to the $fieldList parameter in Model::save()
     * - `deep`: If set to true, all associated data will be saved as well.
     * - `callbacks`: See Model::save()
     * - `counterCache`: See Model::save()
     *
     * @param array $data Record data to save. This should be a numerically-indexed array
     * @param array $options Options to use when saving record data, See $options above.
     * @return mixed If atomic: True on success, or false on failure.
     *    Otherwise: array similar to the $data array passed, but values are set to true/false
     *    depending on whether each record saved successfully.
     * @throws PDOException
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-savemany-array-data-null-array-options-array
     */
    public function saveMany($data = null, $options = array()) {
        if (empty($data)) {
            $data = $this->data;
        }

        $options += array('validate' => 'first', 'atomic' => true, 'deep' => false);
        $this->validationErrors = $validationErrors = array();

        if (empty($data) && $options['validate'] !== false) {
            $result = $this->save($data, $options);
            if (!$options['atomic']) {
                return array(!empty($result));
            }

            return !empty($result);
        }

        if ($options['validate'] === 'first') {
            $validates = $this->validateMany($data, $options);
            if ((!$validates && $options['atomic']) || (!$options['atomic'] && in_array(false, $validates, true))) {
                return $validates;
            }
            $options['validate'] = false;
        }

        $transactionBegun = false;
        if ($options['atomic']) {
            $db = $this->getDataSource();
            $transactionBegun = $db->begin();
        }

        try {
            $return = array();
            foreach ($data as $key => $record) {
                $validates = $this->create(null) !== null;
                $saved = false;
                if ($validates) {
                    if ($options['deep']) {
                        $saved = $this->saveAssociated($record, array('atomic' => false) + $options);
                    } else {
                        $saved = (bool)$this->save($record, array('atomic' => false) + $options);
                    }
                }

                $validates = ($validates && ($saved === true || (is_array($saved) && !in_array(false, Hash::flatten($saved), true))));
                if (!$validates) {
                    $validationErrors[$key] = $this->validationErrors;
                }

                if (!$options['atomic']) {
                    $return[$key] = $validates;
                } elseif (!$validates) {
                    break;
                }
            }

            $this->validationErrors = $validationErrors;

            if (!$options['atomic']) {
                return $return;
            }

            if ($validates) {
                if ($transactionBegun) {
                    return $db->commit() !== false;
                }
                return true;
            }

            if ($transactionBegun) {
                $db->rollback();
            }
            return false;
        } catch (Exception $e) {
            if ($transactionBegun) {
                $db->rollback();
            }
            throw $e;
        }
    }

    /**
     * Validates multiple individual records for a single model
     *
     * #### Options
     *
     * - `atomic`: If true (default), returns boolean. If false returns array.
     * - `fieldList`: Equivalent to the $fieldList parameter in Model::save()
     * - `deep`: If set to true, all associated data will be validated as well.
     *
     * Warning: This method could potentially change the passed argument `$data`,
     * If you do not want this to happen, make a copy of `$data` before passing it
     * to this method
     *
     * @param array &$data Record data to validate. This should be a numerically-indexed array
     * @param array $options Options to use when validating record data (see above), See also $options of validates().
     * @return bool|array If atomic: True on success, or false on failure.
     *    Otherwise: array similar to the $data array passed, but values are set to true/false
     *    depending on whether each record validated successfully.
     */
    public function validateMany(&$data, $options = array()) {
        return $this->validator()->validateMany($data, $options);
    }

    /**
     * Saves a single record, as well as all its directly associated records.
     *
     * #### Options
     *
     * - `validate`: Set to `false` to disable validation, `true` to validate each record before saving,
     *   'first' to validate *all* records before any are saved(default),
     * - `atomic`: If true (default), will attempt to save all records in a single transaction.
     *   Should be set to false if database/table does not support transactions.
     * - `fieldList`: Equivalent to the $fieldList parameter in Model::save().
     *   It should be an associate array with model name as key and array of fields as value. Eg.
     *   ```
     *   array(
     *       'SomeModel' => array('field'),
     *       'AssociatedModel' => array('field', 'otherfield')
     *   )
     *   ```
     * - `deep`: If set to true, not only directly associated data is saved, but deeper nested associated data as well.
     * - `callbacks`: See Model::save()
     * - `counterCache`: See Model::save()
     *
     * @param array $data Record data to save. This should be an array indexed by association name.
     * @param array $options Options to use when saving record data, See $options above.
     * @return mixed If atomic: True on success, or false on failure.
     *    Otherwise: array similar to the $data array passed, but values are set to true/false
     *    depending on whether each record saved successfully.
     * @throws PDOException
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-saveassociated-array-data-null-array-options-array
     */
    public function saveAssociated($data = null, $options = array()) {
        if (empty($data)) {
            $data = $this->data;
        }

        $options += array('validate' => 'first', 'atomic' => true, 'deep' => false);
        $this->validationErrors = $validationErrors = array();

        if (empty($data) && $options['validate'] !== false) {
            $result = $this->save($data, $options);
            if (!$options['atomic']) {
                return array(!empty($result));
            }

            return !empty($result);
        }

        if ($options['validate'] === 'first') {
            $validates = $this->validateAssociated($data, $options);
            if ((!$validates && $options['atomic']) || (!$options['atomic'] && in_array(false, Hash::flatten($validates), true))) {
                return $validates;
            }

            $options['validate'] = false;
        }

        $transactionBegun = false;
        if ($options['atomic']) {
            $db = $this->getDataSource();
            $transactionBegun = $db->begin();
        }

        try {
            $associations = $this->getAssociated();
            $return = array();
            $validates = true;
            foreach ($data as $association => $values) {
                $isEmpty = empty($values) || (isset($values[$association]) && empty($values[$association]));
                if ($isEmpty || !isset($associations[$association]) || $associations[$association] !== 'belongsTo') {
                    continue;
                }

                $Model = $this->{$association};

                $validates = $Model->create(null) !== null;
                $saved = false;
                if ($validates) {
                    if ($options['deep']) {
                        $saved = $Model->saveAssociated($values, array('atomic' => false) + $options);
                    } else {
                        $saved = (bool)$Model->save($values, array('atomic' => false) + $options);
                    }
                    $validates = ($saved === true || (is_array($saved) && !in_array(false, Hash::flatten($saved), true)));
                }

                if ($validates) {
                    $key = $this->belongsTo[$association]['foreignKey'];
                    if (isset($data[$this->alias])) {
                        $data[$this->alias][$key] = $Model->id;
                    } else {
                        $data = array_merge(array($key => $Model->id), $data, array($key => $Model->id));
                    }
                    $options = $this->_addToWhiteList($key, $options);
                } else {
                    $validationErrors[$association] = $Model->validationErrors;
                }

                $return[$association] = $validates;
            }

            if ($validates && !($this->create(null) !== null && $this->save($data, array('atomic' => false) + $options))) {
                $validationErrors[$this->alias] = $this->validationErrors;
                $validates = false;
            }
            $return[$this->alias] = $validates;

            foreach ($data as $association => $values) {
                if (!$validates) {
                    break;
                }

                $isEmpty = empty($values) || (isset($values[$association]) && empty($values[$association]));
                if ($isEmpty || !isset($associations[$association])) {
                    continue;
                }

                $Model = $this->{$association};

                $type = $associations[$association];
                $key = $this->{$type}[$association]['foreignKey'];
                switch ($type) {
                    case 'hasOne':
                        if (isset($values[$association])) {
                            $values[$association][$key] = $this->id;
                        } else {
                            $values = array_merge(array($key => $this->id), $values, array($key => $this->id));
                        }

                        $validates = $Model->create(null) !== null;
                        $saved = false;

                        if ($validates) {
                            $options = $Model->_addToWhiteList($key, $options);
                            if ($options['deep']) {
                                $saved = $Model->saveAssociated($values, array('atomic' => false) + $options);
                            } else {
                                $saved = (bool)$Model->save($values, $options);
                            }
                        }

                        $validates = ($validates && ($saved === true || (is_array($saved) && !in_array(false, Hash::flatten($saved), true))));
                        if (!$validates) {
                            $validationErrors[$association] = $Model->validationErrors;
                        }

                        $return[$association] = $validates;
                        break;
                    case 'hasMany':
                        foreach ($values as $i => $value) {
                            if (isset($values[$i][$association])) {
                                $values[$i][$association][$key] = $this->id;
                            } else {
                                $values[$i] = array_merge(array($key => $this->id), $value, array($key => $this->id));
                            }
                        }

                        $options = $Model->_addToWhiteList($key, $options);
                        $_return = $Model->saveMany($values, array('atomic' => false) + $options);
                        if (in_array(false, $_return, true)) {
                            $validationErrors[$association] = $Model->validationErrors;
                            $validates = false;
                        }

                        $return[$association] = $_return;
                        break;
                }
            }
            $this->validationErrors = $validationErrors;

            if (isset($validationErrors[$this->alias])) {
                $this->validationErrors = $validationErrors[$this->alias];
                unset($validationErrors[$this->alias]);
                $this->validationErrors = array_merge($this->validationErrors, $validationErrors);
            }

            if (!$options['atomic']) {
                return $return;
            }
            if ($validates) {
                if ($transactionBegun) {
                    return $db->commit() !== false;
                }

                return true;
            }

            if ($transactionBegun) {
                $db->rollback();
            }
            return false;
        } catch (Exception $e) {
            if ($transactionBegun) {
                $db->rollback();
            }
            throw $e;
        }
    }

    /**
     * Helper method for saveAll() and friends, to add foreign key to fieldlist
     *
     * @param string $key fieldname to be added to list
     * @param array $options Options list
     * @return array options
     */
    protected function _addToWhiteList($key, $options) {
        if (empty($options['fieldList']) && $this->whitelist && !in_array($key, $this->whitelist)) {
            $options['fieldList'][$this->alias] = $this->whitelist;
            $options['fieldList'][$this->alias][] = $key;
            return $options;
        }

        if (!empty($options['fieldList'][$this->alias]) && is_array($options['fieldList'][$this->alias])) {
            $options['fieldList'][$this->alias][] = $key;
            return $options;
        }

        if (!empty($options['fieldList']) && is_array($options['fieldList']) && Hash::dimensions($options['fieldList']) < 2) {
            $options['fieldList'][] = $key;
        }

        return $options;
    }

    /**
     * Validates a single record, as well as all its directly associated records.
     *
     * #### Options
     *
     * - `atomic`: If true (default), returns boolean. If false returns array.
     * - `fieldList`: Equivalent to the $fieldList parameter in Model::save()
     * - `deep`: If set to true, not only directly associated data , but deeper nested associated data is validated as well.
     *
     * Warning: This method could potentially change the passed argument `$data`,
     * If you do not want this to happen, make a copy of `$data` before passing it
     * to this method
     *
     * @param array &$data Record data to validate. This should be an array indexed by association name.
     * @param array $options Options to use when validating record data (see above), See also $options of validates().
     * @return array|bool If atomic: True on success, or false on failure.
     *    Otherwise: array similar to the $data array passed, but values are set to true/false
     *    depending on whether each record validated successfully.
     */
    public function validateAssociated(&$data, $options = array()) {
        return $this->validator()->validateAssociated($data, $options);
    }

    /**
     * Updates multiple model records based on a set of conditions.
     *
     * @param array $fields Set of fields and values, indexed by fields.
     *    Fields are treated as SQL snippets, to insert literal values manually escape your data.
     * @param mixed $conditions Conditions to match, true for all records
     * @return bool True on success, false on failure
     * @link https://book.cakephp.org/2.0/en/models/saving-your-data.html#model-updateall-array-fields-mixed-conditions
     */
    public function updateAll($fields, $conditions = true) {
        return $this->getDataSource()->update($this, $fields, null, $conditions);
    }

    /**
     * Removes record for given ID. If no ID is given, the current ID is used. Returns true on success.
     *
     * @param int|string $id ID of record to delete
     * @param bool $cascade Set to true to delete records that depend on this record
     * @return bool True on success
     * @triggers Model.beforeDelete $this, array($cascade)
     * @triggers Model.afterDelete $this
     * @link https://book.cakephp.org/2.0/en/models/deleting-data.html
     */
    public function delete($id = null, $cascade = true) {
        if (!empty($id)) {
            $this->id = $id;
        }

        $id = $this->id;

        $event = new CakeEvent('Model.beforeDelete', $this, array($cascade));
        list($event->break, $event->breakOn) = array(true, array(false, null));
        $this->getEventManager()->dispatch($event);
        if ($event->isStopped()) {
            return false;
        }

        if (!$this->exists($this->getID())) {
            return false;
        }

        $this->_deleteDependent($id, $cascade);
        $this->_deleteLinks($id);
        $this->id = $id;

        if (!empty($this->belongsTo)) {
            foreach ($this->belongsTo as $assoc) {
                if (empty($assoc['counterCache'])) {
                    continue;
                }

                $keys = $this->find('first', array(
                    'fields' => $this->_collectForeignKeys(),
                    'conditions' => array($this->alias . '.' . $this->primaryKey => $id),
                    'recursive' => -1,
                    'callbacks' => false
                ));
                break;
            }
        }

        if (!$this->getDataSource()->delete($this, array($this->alias . '.' . $this->primaryKey => $id))) {
            return false;
        }

        if (!empty($keys[$this->alias])) {
            $this->updateCounterCache($keys[$this->alias]);
        }

        $this->getEventManager()->dispatch(new CakeEvent('Model.afterDelete', $this));
        $this->_clearCache();
        $this->id = false;

        return true;
    }

    /**
     * Cascades model deletes through associated hasMany and hasOne child records.
     *
     * @param string $id ID of record that was deleted
     * @param bool $cascade Set to true to delete records that depend on this record
     * @return void
     */
    protected function _deleteDependent($id, $cascade) {
        if ($cascade !== true) {
            return;
        }

        if (!empty($this->__backAssociation)) {
            $savedAssociations = $this->__backAssociation;
            $this->__backAssociation = array();
        }

        foreach (array_merge($this->hasMany, $this->hasOne) as $assoc => $data) {
            if ($data['dependent'] !== true) {
                continue;
            }

            $Model = $this->{$assoc};

            if ($data['foreignKey'] === false && $data['conditions'] && in_array($this->name, $Model->getAssociated('belongsTo'))) {
                $Model->recursive = 0;
                $conditions = array($this->escapeField(null, $this->name) => $id);
            } else {
                $Model->recursive = -1;
                $conditions = array($Model->escapeField($data['foreignKey']) => $id);
                if ($data['conditions']) {
                    $conditions = array_merge((array)$data['conditions'], $conditions);
                }
            }

            if (isset($data['exclusive']) && $data['exclusive']) {
                $Model->deleteAll($conditions);
            } else {
                $records = $Model->find('all', array(
                    'conditions' => $conditions, 'fields' => $Model->primaryKey
                ));

                if (!empty($records)) {
                    foreach ($records as $record) {
                        $Model->delete($record[$Model->alias][$Model->primaryKey]);
                    }
                }
            }
        }

        if (isset($savedAssociations)) {
            $this->__backAssociation = $savedAssociations;
        }
    }

    /**
     * Cascades model deletes through HABTM join keys.
     *
     * @param string $id ID of record that was deleted
     * @return void
     */
    protected function _deleteLinks($id) {
        foreach ($this->hasAndBelongsToMany as $data) {
            list(, $joinModel) = pluginSplit($data['with']);
            $Model = $this->{$joinModel};
            $records = $Model->find('all', array(
                'conditions' => $this->_getConditionsForDeletingLinks($Model, $id, $data),
                'fields' => $Model->primaryKey,
                'recursive' => -1,
                'callbacks' => false
            ));

            if (!empty($records)) {
                foreach ($records as $record) {
                    $Model->delete($record[$Model->alias][$Model->primaryKey]);
                }
            }
        }
    }

    /**
     * Returns the conditions to be applied to Model::find() when determining which HABTM records should be deleted via
     * Model::_deleteLinks()
     *
     * @param Model $Model HABTM join model instance
     * @param mixed $id The ID of the primary model which is being deleted
     * @param array $relationshipConfig The relationship config defined on the primary model
     * @return array
     */
    protected function _getConditionsForDeletingLinks(Model $Model, $id, array $relationshipConfig) {
        return array($Model->escapeField($relationshipConfig['foreignKey']) => $id);
    }

    /**
     * Deletes multiple model records based on a set of conditions.
     *
     * @param mixed $conditions Conditions to match
     * @param bool $cascade Set to true to delete records that depend on this record
     * @param bool $callbacks Run callbacks
     * @return bool True on success, false on failure
     * @link https://book.cakephp.org/2.0/en/models/deleting-data.html#deleteall
     */
    public function deleteAll($conditions, $cascade = true, $callbacks = false) {
        if (empty($conditions)) {
            return false;
        }

        $db = $this->getDataSource();

        if (!$cascade && !$callbacks) {
            return $db->delete($this, $conditions);
        }

        $ids = $this->find('all', array_merge(array(
                'fields' => "{$this->alias}.{$this->primaryKey}",
                'order' => false,
                'group' => "{$this->alias}.{$this->primaryKey}",
                'recursive' => 0), compact('conditions'))
        );

        if ($ids === false || $ids === null) {
            return false;
        }

        $ids = Hash::extract($ids, "{n}.{$this->alias}.{$this->primaryKey}");
        if (empty($ids)) {
            return true;
        }

        if ($callbacks) {
            $_id = $this->id;
            $result = true;
            foreach ($ids as $id) {
                $result = $result && $this->delete($id, $cascade);
            }

            $this->id = $_id;
            return $result;
        }

        foreach ($ids as $id) {
            $this->_deleteLinks($id);
            if ($cascade) {
                $this->_deleteDependent($id, $cascade);
            }
        }

        return $db->delete($this, array($this->alias . '.' . $this->primaryKey => $ids));
    }

    /**
     * Collects foreign keys from associations.
     *
     * @param string $type Association type.
     * @return array
     */
    protected function _collectForeignKeys($type = 'belongsTo') {
        $result = array();

        foreach ($this->{$type} as $assoc => $data) {
            if (isset($data['foreignKey']) && is_string($data['foreignKey'])) {
                $result[$assoc] = $data['foreignKey'];
            }
        }

        return $result;
    }

    /**
     * Returns true if a record with particular ID exists.
     *
     * If $id is not passed it calls `Model::getID()` to obtain the current record ID,
     * and then performs a `Model::find('count')` on the currently configured datasource
     * to ascertain the existence of the record in persistent storage.
     *
     * @param int|string $id ID of record to check for existence
     * @return bool True if such a record exists
     */
    public function exists($id = null) {
        if ($id === null) {
            $id = $this->getID();
        }

        if ($id === false) {
            return false;
        }

        if ($this->useTable === false) {
            return false;
        }

        return (bool)$this->find('count', array(
            'conditions' => array(
                $this->alias . '.' . $this->primaryKey => $id
            ),
            'recursive' => -1,
            'callbacks' => false
        ));
    }

    /**
     * Returns true if a record that meets given conditions exists.
     *
     * @param array $conditions SQL conditions array
     * @return bool True if such a record exists
     */
    public function hasAny($conditions = null) {
        return (bool)$this->find('count', array('conditions' => $conditions, 'recursive' => -1));
    }

    /**
     * Queries the datasource and returns a result set array.
     *
     * Used to perform find operations, where the first argument is type of find operation to perform
     * (all / first / count / neighbors / list / threaded),
     * second parameter options for finding (indexed array, including: 'conditions', 'limit',
     * 'recursive', 'page', 'fields', 'offset', 'order', 'callbacks')
     *
     * Eg:
     * ```
     * $model->find('all', array(
     *   'conditions' => array('name' => 'Thomas Anderson'),
     *   'fields' => array('name', 'email'),
     *   'order' => 'field3 DESC',
     *   'recursive' => 1,
     *   'group' => 'type',
     *   'callbacks' => false,
     * ));
     * ```
     *
     * In addition to the standard query keys above, you can provide Datasource, and behavior specific
     * keys. For example, when using a SQL based datasource you can use the joins key to specify additional
     * joins that should be part of the query.
     *
     * ```
     * $model->find('all', array(
     *   'conditions' => array('name' => 'Thomas Anderson'),
     *   'joins' => array(
     *     array(
     *       'alias' => 'Thought',
     *       'table' => 'thoughts',
     *       'type' => 'LEFT',
     *       'conditions' => '`Thought`.`person_id` = `Person`.`id`'
     *     )
     *   )
     * ));
     * ```
     *
     * ### Disabling callbacks
     *
     * The `callbacks` key allows you to disable or specify the callbacks that should be run. To
     * disable beforeFind & afterFind callbacks set `'callbacks' => false` in your options. You can
     * also set the callbacks option to 'before' or 'after' to enable only the specified callback.
     *
     * ### Adding new find types
     *
     * Behaviors and find types can also define custom finder keys which are passed into find().
     * See the documentation for custom find types
     * (https://book.cakephp.org/2.0/en/models/retrieving-your-data.html#creating-custom-find-types)
     * for how to implement custom find types.
     *
     * Specifying 'fields' for notation 'list':
     *
     * - If no fields are specified, then 'id' is used for key and 'model->displayField' is used for value.
     * - If a single field is specified, 'id' is used for key and specified field is used for value.
     * - If three fields are specified, they are used (in order) for key, value and group.
     * - Otherwise, first and second fields are used for key and value.
     *
     * Note: find(list) + database views have issues with MySQL 5.0. Try upgrading to MySQL 5.1 if you
     * have issues with database views.
     *
     * Note: find(count) has its own return values.
     *
     * @param string $type Type of find operation (all / first / count / neighbors / list / threaded)
     * @param array $query Option fields (conditions / fields / joins / limit / offset / order / page / group / callbacks)
     * @return array|int|null Array of records, int if the type is count, or Null on failure.
     * @link https://book.cakephp.org/2.0/en/models/retrieving-your-data.html
     */
    public function find($type = 'first', $query = array()) {
        $this->findQueryType = $type;
        $this->id = $this->getID();

        $query = $this->buildQuery($type, $query);
        if ($query === null) {
            return null;
        }

        return $this->_readDataSource($type, $query);
    }

    /**
     * Read from the datasource
     *
     * Model::_readDataSource() is used by all find() calls to read from the data source and can be overloaded to allow
     * caching of datasource calls.
     *
     * ```
     * protected function _readDataSource($type, $query) {
     *     $cacheName = md5(json_encode($query) . json_encode($this->hasOne) . json_encode($this->belongsTo));
     *     $cache = Cache::read($cacheName, 'cache-config-name');
     *     if ($cache !== false) {
     *         return $cache;
     *     }
     *
     *     $results = parent::_readDataSource($type, $query);
     *     Cache::write($cacheName, $results, 'cache-config-name');
     *     return $results;
     * }
     * ```
     *
     * @param string $type Type of find operation (all / first / count / neighbors / list / threaded)
     * @param array $query Option fields (conditions / fields / joins / limit / offset / order / page / group / callbacks)
     * @return array
     */
    protected function _readDataSource($type, $query) {
        $results = $this->getDataSource()->read($this, $query);
        $this->resetAssociations();

        if ($query['callbacks'] === true || $query['callbacks'] === 'after') {
            $results = $this->_filterResults($results);
        }

        $this->findQueryType = null;

        if ($this->findMethods[$type] === true) {
            return $this->{'_find' . ucfirst($type)}('after', $query, $results);
        }
    }

    /**
     * Builds the query array that is used by the data source to generate the query to fetch the data.
     *
     * @param string $type Type of find operation (all / first / count / neighbors / list / threaded)
     * @param array $query Option fields (conditions / fields / joins / limit / offset / order / page / group / callbacks)
     * @return array|null Query array or null if it could not be build for some reasons
     * @triggers Model.beforeFind $this, array($query)
     * @see Model::find()
     */
    public function buildQuery($type = 'first', $query = array()) {
        $query = array_merge(
            array(
                'conditions' => null, 'fields' => null, 'joins' => array(), 'limit' => null,
                'offset' => null, 'order' => null, 'page' => 1, 'group' => null, 'callbacks' => true,
            ),
            (array)$query
        );

        if ($this->findMethods[$type] === true) {
            $query = $this->{'_find' . ucfirst($type)}('before', $query);
        }

        if (!is_numeric($query['page']) || (int)$query['page'] < 1) {
            $query['page'] = 1;
        }

        if ($query['page'] > 1 && !empty($query['limit'])) {
            $query['offset'] = ($query['page'] - 1) * $query['limit'];
        }

        if ($query['order'] === null && $this->order !== null) {
            $query['order'] = $this->order;
        }

        if (is_object($query['order'])) {
            $query['order'] = array($query['order']);
        } else {
            $query['order'] = (array)$query['order'];
        }

        if ($query['callbacks'] === true || $query['callbacks'] === 'before') {
            $event = new CakeEvent('Model.beforeFind', $this, array($query));
            list($event->break, $event->breakOn, $event->modParams) = array(true, array(false, null), 0);
            $this->getEventManager()->dispatch($event);

            if ($event->isStopped()) {
                return null;
            }

            $query = $event->result === true ? $event->data[0] : $event->result;
        }

        return $query;
    }

    /**
     * Handles the before/after filter logic for find('all') operations. Only called by Model::find().
     *
     * @param string $state Either "before" or "after"
     * @param array $query Query.
     * @param array $results Results.
     * @return array
     * @see Model::find()
     */
    protected function _findAll($state, $query, $results = array()) {
        if ($state === 'before') {
            return $query;
        }

        return $results;
    }

    /**
     * Handles the before/after filter logic for find('first') operations. Only called by Model::find().
     *
     * @param string $state Either "before" or "after"
     * @param array $query Query.
     * @param array $results Results.
     * @return array
     * @see Model::find()
     */
    protected function _findFirst($state, $query, $results = array()) {
        if ($state === 'before') {
            $query['limit'] = 1;
            return $query;
        }

        if (empty($results[0])) {
            return array();
        }

        return $results[0];
    }

    /**
     * Handles the before/after filter logic for find('count') operations. Only called by Model::find().
     *
     * @param string $state Either "before" or "after"
     * @param array $query Query.
     * @param array $results Results.
     * @return int|false The number of records found, or false
     * @see Model::find()
     */
    protected function _findCount($state, $query, $results = array()) {
        if ($state === 'before') {
            if (!empty($query['type']) && isset($this->findMethods[$query['type']]) && $query['type'] !== 'count') {
                $query['operation'] = 'count';
                $query = $this->{'_find' . ucfirst($query['type'])}('before', $query);
            }

            $db = $this->getDataSource();
            $query['order'] = false;
            if (!method_exists($db, 'calculate')) {
                return $query;
            }

            if (!empty($query['fields']) && is_array($query['fields'])) {
                if (!preg_match('/^count/i', current($query['fields']))) {
                    unset($query['fields']);
                }
            }

            if (empty($query['fields'])) {
                $query['fields'] = $db->calculate($this, 'count');
            } elseif (method_exists($db, 'expression') && is_string($query['fields']) && !preg_match('/count/i', $query['fields'])) {
                $query['fields'] = $db->calculate($this, 'count', array(
                    $db->expression($query['fields']), 'count'
                ));
            }

            return $query;
        }

        foreach (array(0, $this->alias) as $key) {
            if (isset($results[0][$key]['count'])) {
                if ($query['group']) {
                    return count($results);
                }

                return (int)$results[0][$key]['count'];
            }
        }

        return false;
    }

    /**
     * Handles the before/after filter logic for find('list') operations. Only called by Model::find().
     *
     * @param string $state Either "before" or "after"
     * @param array $query Query.
     * @param array $results Results.
     * @return array Key/value pairs of primary keys/display field values of all records found
     * @see Model::find()
     */
    protected function _findList($state, $query, $results = array()) {
        if ($state === 'before') {
            if (empty($query['fields'])) {
                $query['fields'] = array("{$this->alias}.{$this->primaryKey}", "{$this->alias}.{$this->displayField}");
                $list = array("{n}.{$this->alias}.{$this->primaryKey}", "{n}.{$this->alias}.{$this->displayField}", null);
            } else {
                if (!is_array($query['fields'])) {
                    $query['fields'] = CakeText::tokenize($query['fields']);
                }

                if (count($query['fields']) === 1) {
                    if (strpos($query['fields'][0], '.') === false) {
                        $query['fields'][0] = $this->alias . '.' . $query['fields'][0];
                    }

                    $list = array("{n}.{$this->alias}.{$this->primaryKey}", '{n}.' . $query['fields'][0], null);
                    $query['fields'] = array("{$this->alias}.{$this->primaryKey}", $query['fields'][0]);
                } elseif (count($query['fields']) === 3) {
                    for ($i = 0; $i < 3; $i++) {
                        if (strpos($query['fields'][$i], '.') === false) {
                            $query['fields'][$i] = $this->alias . '.' . $query['fields'][$i];
                        }
                    }

                    $list = array('{n}.' . $query['fields'][0], '{n}.' . $query['fields'][1], '{n}.' . $query['fields'][2]);
                } else {
                    for ($i = 0; $i < 2; $i++) {
                        if (strpos($query['fields'][$i], '.') === false) {
                            $query['fields'][$i] = $this->alias . '.' . $query['fields'][$i];
                        }
                    }

                    $list = array('{n}.' . $query['fields'][0], '{n}.' . $query['fields'][1], null);
                }
            }

            if (!isset($query['recursive']) || $query['recursive'] === null) {
                $query['recursive'] = -1;
            }
            list($query['list']['keyPath'], $query['list']['valuePath'], $query['list']['groupPath']) = $list;

            return $query;
        }

        if (empty($results)) {
            return array();
        }

        return Hash::combine($results, $query['list']['keyPath'], $query['list']['valuePath'], $query['list']['groupPath']);
    }

    /**
     * Detects the previous field's value, then uses logic to find the 'wrapping'
     * rows and return them.
     *
     * @param string $state Either "before" or "after"
     * @param array $query Query.
     * @param array $results Results.
     * @return array
     */
    protected function _findNeighbors($state, $query, $results = array()) {
        extract($query);

        if ($state === 'before') {
            $conditions = (array)$conditions;
            if (isset($field) && isset($value)) {
                if (strpos($field, '.') === false) {
                    $field = $this->alias . '.' . $field;
                }
            } else {
                $field = $this->alias . '.' . $this->primaryKey;
                $value = $this->id;
            }

            $query['conditions'] = array_merge($conditions, array($field . ' <' => $value));
            $query['order'] = $field . ' DESC';
            $query['limit'] = 1;
            $query['field'] = $field;
            $query['value'] = $value;

            return $query;
        }

        unset($query['conditions'][$field . ' <']);
        $return = array();
        if (isset($results[0])) {
            $prevVal = Hash::get($results[0], $field);
            $query['conditions'][$field . ' >='] = $prevVal;
            $query['conditions'][$field . ' !='] = $value;
            $query['limit'] = 2;
        } else {
            $return['prev'] = null;
            $query['conditions'][$field . ' >'] = $value;
            $query['limit'] = 1;
        }

        $query['order'] = $field . ' ASC';
        $neighbors = $this->find('all', $query);
        if (!array_key_exists('prev', $return)) {
            $return['prev'] = isset($neighbors[0]) ? $neighbors[0] : null;
        }

        if (count($neighbors) === 2) {
            $return['next'] = $neighbors[1];
        } elseif (count($neighbors) === 1 && !$return['prev']) {
            $return['next'] = $neighbors[0];
        } else {
            $return['next'] = null;
        }

        return $return;
    }

    /**
     * In the event of ambiguous results returned (multiple top level results, with different parent_ids)
     * top level results with different parent_ids to the first result will be dropped
     *
     * @param string $state Either "before" or "after".
     * @param array $query Query.
     * @param array $results Results.
     * @return array Threaded results
     */
    protected function _findThreaded($state, $query, $results = array()) {
        if ($state === 'before') {
            return $query;
        }

        $parent = 'parent_id';
        if (isset($query['parent'])) {
            $parent = $query['parent'];
        }

        return Hash::nest($results, array(
            'idPath' => '{n}.' . $this->alias . '.' . $this->primaryKey,
            'parentPath' => '{n}.' . $this->alias . '.' . $parent
        ));
    }

    /**
     * Passes query results through model and behavior afterFind() methods.
     *
     * @param array $results Results to filter
     * @param bool $primary If this is the primary model results (results from model where the find operation was performed)
     * @return array Set of filtered results
     * @triggers Model.afterFind $this, array($results, $primary)
     */
    protected function _filterResults($results, $primary = true) {
        $event = new CakeEvent('Model.afterFind', $this, array($results, $primary));
        $event->modParams = 0;
        $this->getEventManager()->dispatch($event);
        return $event->result;
    }

    /**
     * This resets the association arrays for the model back
     * to those originally defined in the model. Normally called at the end
     * of each call to Model::find()
     *
     * @return bool Success
     */
    public function resetAssociations() {
        if (!empty($this->__backAssociation)) {
            foreach ($this->_associations as $type) {
                if (isset($this->__backAssociation[$type])) {
                    $this->{$type} = $this->__backAssociation[$type];
                }
            }

            $this->__backAssociation = array();
        }

        foreach ($this->_associations as $type) {
            foreach ($this->{$type} as $key => $name) {
                if (property_exists($this, $key) && !empty($this->{$key}->__backAssociation)) {
                    $this->{$key}->resetAssociations();
                }
            }
        }

        $this->__backAssociation = array();
        return true;
    }

    /**
     * Returns false if any fields passed match any (by default, all if $or = false) of their matching values.
     *
     * Can be used as a validation method. When used as a validation method, the `$or` parameter
     * contains an array of fields to be validated.
     *
     * @param array $fields Field/value pairs to search (if no values specified, they are pulled from $this->data)
     * @param bool|array $or If false, all fields specified must match in order for a false return value
     * @return bool False if any records matching any fields are found
     */
    public function isUnique($fields, $or = true) {
        if (is_array($or)) {
            $isRule = (
                array_key_exists('rule', $or) &&
                array_key_exists('required', $or) &&
                array_key_exists('message', $or)
            );
            if (!$isRule) {
                $args = func_get_args();
                $fields = $args[1];
                $or = isset($args[2]) ? $args[2] : true;
            }
        }
        if (!is_array($fields)) {
            $fields = func_get_args();
            $fieldCount = count($fields) - 1;
            if (is_bool($fields[$fieldCount])) {
                $or = $fields[$fieldCount];
                unset($fields[$fieldCount]);
            }
        }

        foreach ($fields as $field => $value) {
            if (is_numeric($field)) {
                unset($fields[$field]);

                $field = $value;
                $value = null;
                if (isset($this->data[$this->alias][$field])) {
                    $value = $this->data[$this->alias][$field];
                }
            }

            if (strpos($field, '.') === false) {
                unset($fields[$field]);
                $fields[$this->alias . '.' . $field] = $value;
            }
        }

        if ($or) {
            $fields = array('or' => $fields);
        }

        if (!empty($this->id)) {
            $fields[$this->alias . '.' . $this->primaryKey . ' !='] = $this->id;
        }

        return !$this->find('count', array('conditions' => $fields, 'recursive' => -1));
    }

    /**
     * Returns a resultset for a given SQL statement. Custom SQL queries should be performed with this method.
     *
     * The method can options 2nd and 3rd parameters.
     *
     * - 2nd param: Either a boolean to control query caching or an array of parameters
     *    for use with prepared statement placeholders.
     * - 3rd param: If 2nd argument is provided, a boolean flag for enabling/disabled
     *   query caching.
     *
     * If the query cache param as 2nd or 3rd argument is not given then the model's
     * default `$cacheQueries` value is used.
     *
     * @param string $sql SQL statement
     * @return mixed Resultset array or boolean indicating success / failure depending on the query executed
     * @link https://book.cakephp.org/2.0/en/models/retrieving-your-data.html#model-query
     */
    public function query($sql) {
        $params = func_get_args();
        // use $this->cacheQueries as default when argument not explicitly given already
        if (count($params) === 1 || count($params) === 2 && !is_bool($params[1])) {
            $params[] = $this->cacheQueries;
        }
        $db = $this->getDataSource();
        return call_user_func_array(array(&$db, 'query'), $params);
    }

    /**
     * Returns true if all fields pass validation. Will validate hasAndBelongsToMany associations
     * that use the 'with' key as well. Since _saveMulti is incapable of exiting a save operation.
     *
     * Will validate the currently set data. Use Model::set() or Model::create() to set the active data.
     *
     * @param array $options An optional array of custom options to be made available in the beforeValidate callback
     * @return bool True if there are no errors
     */
    public function validates($options = array()) {
        return $this->validator()->validates($options);
    }

    /**
     * Returns an array of fields that have failed the validation of the current model.
     *
     * Additionally it populates the validationErrors property of the model with the same array.
     *
     * @param array|string $options An optional array of custom options to be made available in the beforeValidate callback
     * @return array|bool Array of invalid fields and their error messages
     * @see Model::validates()
     */
    public function invalidFields($options = array()) {
        return $this->validator()->errors($options);
    }

    /**
     * Marks a field as invalid, optionally setting the name of validation
     * rule (in case of multiple validation for field) that was broken.
     *
     * @param string $field The name of the field to invalidate
     * @param mixed $value Name of validation rule that was not failed, or validation message to
     *    be returned. If no validation key is provided, defaults to true.
     * @return void
     */
    public function invalidate($field, $value = true) {
        $this->validator()->invalidate($field, $value);
    }

    /**
     * Returns true if given field name is a foreign key in this model.
     *
     * @param string $field Returns true if the input string ends in "_id"
     * @return bool True if the field is a foreign key listed in the belongsTo array.
     */
    public function isForeignKey($field) {
        $foreignKeys = array();
        if (!empty($this->belongsTo)) {
            foreach ($this->belongsTo as $data) {
                $foreignKeys[] = $data['foreignKey'];
            }
        }

        return in_array($field, $foreignKeys);
    }

    /**
     * Escapes the field name and prepends the model name. Escaping is done according to the
     * current database driver's rules.
     *
     * @param string $field Field to escape (e.g: id)
     * @param string $alias Alias for the model (e.g: Post)
     * @return string The name of the escaped field for this Model (i.e. id becomes `Post`.`id`).
     */
    public function escapeField($field = null, $alias = null) {
        if (empty($alias)) {
            $alias = $this->alias;
        }

        if (empty($field)) {
            $field = $this->primaryKey;
        }

        $db = $this->getDataSource();
        if (strpos($field, $db->name($alias) . '.') === 0) {
            return $field;
        }

        return $db->name($alias . '.' . $field);
    }

    /**
     * Returns the current record's ID
     *
     * @param int $list Index on which the composed ID is located
     * @return mixed The ID of the current record, false if no ID
     */
    public function getID($list = 0) {
        if (empty($this->id) || (is_array($this->id) && isset($this->id[0]) && empty($this->id[0]))) {
            return false;
        }

        if (!is_array($this->id)) {
            return $this->id;
        }

        if (isset($this->id[$list]) && !empty($this->id[$list])) {
            return $this->id[$list];
        }

        if (isset($this->id[$list])) {
            return false;
        }

        return current($this->id);
    }

    /**
     * Returns the ID of the last record this model inserted.
     *
     * @return mixed Last inserted ID
     */
    public function getLastInsertID() {
        return $this->getInsertID();
    }

    /**
     * Returns the ID of the last record this model inserted.
     *
     * @return mixed Last inserted ID
     */
    public function getInsertID() {
        return $this->_insertID;
    }

    /**
     * Sets the ID of the last record this model inserted
     *
     * @param int|string $id Last inserted ID
     * @return void
     */
    public function setInsertID($id) {
        $this->_insertID = $id;
    }

    /**
     * Returns the number of rows returned from the last query.
     *
     * @return int Number of rows
     */
    public function getNumRows() {
        return $this->getDataSource()->lastNumRows();
    }

    /**
     * Returns the number of rows affected by the last query.
     *
     * @return int Number of rows
     */
    public function getAffectedRows() {
        return $this->getDataSource()->lastAffected();
    }

    /**
     * Sets the DataSource to which this model is bound.
     *
     * @param string $dataSource The name of the DataSource, as defined in app/Config/database.php
     * @return void
     * @throws MissingConnectionException
     */
    public function setDataSource($dataSource = null) {
        $oldConfig = $this->useDbConfig;

        if ($dataSource) {
            $this->useDbConfig = $dataSource;
        }

        $db = ConnectionManager::getDataSource($this->useDbConfig);
        if (!empty($oldConfig) && isset($db->config['prefix'])) {
            $oldDb = ConnectionManager::getDataSource($oldConfig);

            if (!isset($this->tablePrefix) || (!isset($oldDb->config['prefix']) || $this->tablePrefix === $oldDb->config['prefix'])) {
                $this->tablePrefix = $db->config['prefix'];
            }
        } elseif (isset($db->config['prefix'])) {
            $this->tablePrefix = $db->config['prefix'];
        }

        $schema = $db->getSchemaName();
        $defaultProperties = get_class_vars(get_class($this));
        if (isset($defaultProperties['schemaName'])) {
            $schema = $defaultProperties['schemaName'];
        }
        $this->schemaName = $schema;
    }

    /**
     * Gets the DataSource to which this model is bound.
     *
     * @return DataSource A DataSource object
     */
    public function getDataSource() {
        if (!$this->_sourceConfigured && $this->useTable !== false) {
            $this->_sourceConfigured = true;
            $this->setSource($this->useTable);
        }

        return ConnectionManager::getDataSource($this->useDbConfig);
    }

    /**
     * Get associations
     *
     * @return array
     */
    public function associations() {
        return $this->_associations;
    }

    /**
     * Gets all the models with which this model is associated.
     *
     * @param string $type Only result associations of this type
     * @return array|null Associations
     */
    public function getAssociated($type = null) {
        if (!$type) {
            $associated = array();
            foreach ($this->_associations as $assoc) {
                if (!empty($this->{$assoc})) {
                    $models = array_keys($this->{$assoc});
                    foreach ($models as $m) {
                        $associated[$m] = $assoc;
                    }
                }
            }

            return $associated;
        }

        if (in_array($type, $this->_associations)) {
            if (empty($this->{$type})) {
                return array();
            }

            return array_keys($this->{$type});
        }

        $assoc = array_merge(
            $this->hasOne,
            $this->hasMany,
            $this->belongsTo,
            $this->hasAndBelongsToMany
        );

        if (array_key_exists($type, $assoc)) {
            foreach ($this->_associations as $a) {
                if (isset($this->{$a}[$type])) {
                    $assoc[$type]['association'] = $a;
                    break;
                }
            }

            return $assoc[$type];
        }

        return null;
    }

    /**
     * Gets the name and fields to be used by a join model. This allows specifying join fields
     * in the association definition.
     *
     * @param string|array $assoc The model to be joined
     * @param array $keys Any join keys which must be merged with the keys queried
     * @return array
     */
    public function joinModel($assoc, $keys = array()) {
        if (is_string($assoc)) {
            list(, $assoc) = pluginSplit($assoc);
            return array($assoc, array_keys($this->{$assoc}->schema()));
        }

        if (is_array($assoc)) {
            $with = key($assoc);
            return array($with, array_unique(array_merge($assoc[$with], $keys)));
        }

        trigger_error(
            __d('cake_dev', 'Invalid join model settings in %s. The association parameter has the wrong type, expecting a string or array, but was passed type: %s', $this->alias, gettype($assoc)),
            E_USER_WARNING
        );
    }

    /**
     * Called before each find operation. Return false if you want to halt the find
     * call, otherwise return the (modified) query data.
     *
     * @param array $query Data used to execute this query, i.e. conditions, order, etc.
     * @return mixed true if the operation should continue, false if it should abort; or, modified
     *  $query to continue with new $query
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#beforefind
     */
    public function beforeFind($query) {
        return true;
    }

    /**
     * Called after each find operation. Can be used to modify any results returned by find().
     * Return value should be the (modified) results.
     *
     * @param mixed $results The results of the find operation
     * @param bool $primary Whether this model is being queried directly (vs. being queried as an association)
     * @return mixed Result of the find operation
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#afterfind
     */
    public function afterFind($results, $primary = false) {
        return $results;
    }

    /**
     * Called before each save operation, after validation. Return a non-true result
     * to halt the save.
     *
     * @param array $options Options passed from Model::save().
     * @return bool True if the operation should continue, false if it should abort
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#beforesave
     * @see Model::save()
     */
    public function beforeSave($options = array()) {
        return true;
    }

    /**
     * Called after each successful save operation.
     *
     * @param bool $created True if this save created a new record
     * @param array $options Options passed from Model::save().
     * @return void
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#aftersave
     * @see Model::save()
     */
    public function afterSave($created, $options = array()) {
    }

    /**
     * Called before every deletion operation.
     *
     * @param bool $cascade If true records that depend on this record will also be deleted
     * @return bool True if the operation should continue, false if it should abort
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#beforedelete
     */
    public function beforeDelete($cascade = true) {
        return true;
    }

    /**
     * Called after every deletion operation.
     *
     * @return void
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#afterdelete
     */
    public function afterDelete() {
    }

    /**
     * Called during validation operations, before validation. Please note that custom
     * validation rules can be defined in $validate.
     *
     * @param array $options Options passed from Model::save().
     * @return bool True if validate operation should continue, false to abort
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
     * @see Model::save()
     */
    public function beforeValidate($options = array()) {
        return true;
    }

    /**
     * Called after data has been checked for errors
     *
     * @return void
     */
    public function afterValidate() {
    }

    /**
     * Called when a DataSource-level error occurs.
     *
     * @return void
     * @link https://book.cakephp.org/2.0/en/models/callback-methods.html#onerror
     */
    public function onError() {
    }

    /**
     * Clears cache for this model.
     *
     * @param string $type If null this deletes cached views if Cache.check is true
     *     Will be used to allow deleting query cache also
     * @return mixed True on delete, null otherwise
     */
    protected function _clearCache($type = null) {
        if ($type !== null || Configure::read('Cache.check') !== true) {
            return;
        }
        $pluralized = Inflector::pluralize($this->alias);
        $assoc = array(
            strtolower($pluralized),
            Inflector::underscore($pluralized)
        );
        foreach ($this->_associations as $association) {
            foreach ($this->{$association} as $className) {
                $pluralizedAssociation = Inflector::pluralize($className['className']);
                if (!in_array(strtolower($pluralizedAssociation), $assoc)) {
                    $assoc = array_merge($assoc, array(
                        strtolower($pluralizedAssociation),
                        Inflector::underscore($pluralizedAssociation)
                    ));
                }
            }
        }
        clearCache(array_unique($assoc));
        return true;
    }

    /**
     * Returns an instance of a model validator for this class
     *
     * @param ModelValidator $instance Model validator instance.
     *  If null a new ModelValidator instance will be made using current model object
     * @return ModelValidator
     */
    public function validator(ModelValidator $instance = null) {
        if ($instance) {
            $this->_validator = $instance;
        } elseif (!$this->_validator) {
            $this->_validator = new ModelValidator($this);
        }

        return $this->_validator;
    }

}
