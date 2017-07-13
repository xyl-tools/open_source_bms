<?php
/**
 * Created by PhpStorm.
 * User: wuang
 * Date: 2017/7/13
 * Time: 15:43
 */

namespace app\common\command;


use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\Db;
use think\Loader;
use think\View;

class MakeModel extends Command
{


    // The following are the supported abstract column data types.
    const TYPE_PK = 'pk';
    const TYPE_UPK = 'upk';
    const TYPE_BIGPK = 'bigpk';
    const TYPE_UBIGPK = 'ubigpk';
    const TYPE_CHAR = 'char';
    const TYPE_STRING = 'string';
    const TYPE_TEXT = 'text';
    const TYPE_SMALLINT = 'smallint';
    const TYPE_INTEGER = 'integer';
    const TYPE_BIGINT = 'bigint';
    const TYPE_FLOAT = 'float';
    const TYPE_DOUBLE = 'double';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DATETIME = 'datetime';
    const TYPE_TIMESTAMP = 'timestamp';
    const TYPE_TIME = 'time';
    const TYPE_DATE = 'date';
    const TYPE_BINARY = 'binary';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_MONEY = 'money';


    public $typeMap = [
        'tinyint' => self::TYPE_SMALLINT,
        'bit' => self::TYPE_INTEGER,
        'smallint' => self::TYPE_SMALLINT,
        'mediumint' => self::TYPE_INTEGER,
        'int' => self::TYPE_INTEGER,
        'integer' => self::TYPE_INTEGER,
        'bigint' => self::TYPE_BIGINT,
        'float' => self::TYPE_FLOAT,
        'double' => self::TYPE_DOUBLE,
        'real' => self::TYPE_FLOAT,
        'decimal' => self::TYPE_DECIMAL,
        'numeric' => self::TYPE_DECIMAL,
        'tinytext' => self::TYPE_TEXT,
        'mediumtext' => self::TYPE_TEXT,
        'longtext' => self::TYPE_TEXT,
        'longblob' => self::TYPE_BINARY,
        'blob' => self::TYPE_BINARY,
        'text' => self::TYPE_TEXT,
        'varchar' => self::TYPE_STRING,
        'string' => self::TYPE_STRING,
        'char' => self::TYPE_CHAR,
        'datetime' => self::TYPE_DATETIME,
        'year' => self::TYPE_DATE,
        'date' => self::TYPE_DATE,
        'time' => self::TYPE_TIME,
        'timestamp' => self::TYPE_TIMESTAMP,
        'enum' => self::TYPE_STRING,
        'varbinary' => self::TYPE_BINARY,
    ];

    /**
     * @var Db\Query $db
     */
    private $db;


    protected function configure()
    {
        $this->setName('make-model')->setDescription('create a new model class');
        $this->addOption("table",'t',Option::VALUE_REQUIRED,'create model class table name');
        $this->addOption("module",'m',Option::VALUE_OPTIONAL,'namespace module','/');
    }



    public function execute(Input $input, Output $output)
    {

        $this->db = new Db\Query();
        $output->writeln('test command:');

        $className = $input->getOption('table');
        $tableName = Config::get('database.prefix').$className;
        $className = Loader::parseName($className,1);

        $module = $input->getOption('module');
        $info = $this->getClassInfo($module);
        $tableColumns = $this->findColumns($tableName);
        /**
         * @var View $view
         */

        $property = '';
        foreach ($tableColumns as $column){
            $property .= "* @property {$column['phpType']} \${$column['name']}\n";
        }

        $this->codeFile($property,$tableName,$className,$info['namespace'],$info['path']);





        $output->writeln($className);
    }


    public function getClassInfo($module)
    {
        if($module == '/')
        {
            //检测是否是多模块
            $isM = Config::get('app_multi_module');
            if(!$isM){
                $module = Config::get('default_module');
            }
        }
        if(substr($module,0,1) != '/'){
            $module = '/'.$module;
        }
        $data = ['path' => '', 'namespace' => ''];
        if($module == '/'){
            $data['path'] = ROOT_PATH.'application/model';
            $data['namespace'] = Config::get('app_namespace').'\model';
        }else{
            $data['path'] = ROOT_PATH.'application'.$module.'/model';
            $data['namespace'] = Config::get('app_namespace').'\\'.substr($module,1).'\model';
        }
        return $data;
    }

    public function codeFile($property,$tableName,$className,$namespace,$path)
    {
        $php = "<?php";
        $data = <<<html
{$php}

namespace {$namespace};

use think\Model;

/**
* This is the model class for table "{$tableName}".
*
{$property}
*/
class {$className} extends Model
{

}

html;

        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        file_put_contents($path.'/'.$className.'.php',$data);
    }



    protected function getColumnPhpType($type)
    {
        static $typeMap = [
            // abstract type => php type
            'smallint' => 'integer',
            'integer' => 'integer',
            'bigint' => 'integer',
            'boolean' => 'boolean',
            'float' => 'double',
            'double' => 'double',
            'binary' => 'resource',
        ];
        if (isset($typeMap[$type])) {
            if ($type === 'bigint') {
                return PHP_INT_SIZE === 8 ? 'integer' : 'string';
            } elseif ($type === 'integer') {
                return PHP_INT_SIZE === 4 ? 'string' : 'integer';
            } else {
                return $typeMap[$type];
            }
        } else {
            return 'string';
        }
    }

    /**
     * Collects the metadata of table columns.
     * @param string $table the table metadata
     * @return array|bool whether the table exists in the database
     * @throws \Exception if DB query fails
     */
    protected function findColumns($table)
    {
        $sql = 'SHOW FULL COLUMNS FROM ' . $table;
        try {
            $columns = $this->db->query($sql);
        } catch (\Exception $e) {
            $previous = $e->getPrevious();
            if ($previous instanceof \PDOException && strpos($previous->getMessage(), 'SQLSTATE[42S02') !== false) {
                // table does not exist
                // https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_bad_table_error
                return false;
            }
            throw $e;
        }

        $tableColumns = [];
        foreach ($columns as $info) {
            if ($this->db->getConnection()->getPdo()->getAttribute(\PDO::ATTR_CASE) !== \PDO::CASE_LOWER) {
                $info = array_change_key_case($info, CASE_LOWER);
            }

            $column = $this->loadColumnSchema($info);
            $tableColumns[$column['name']] = $column;

        }

        return $tableColumns;
    }

    protected function loadColumnSchema($info)
    {
        $column = [];
        $column['name'] = $info['field'];
        $column['allowNull'] = $info['null'] === 'YES';
        $column['isPrimaryKey'] =  strpos($info['key'], 'PRI') !== false;
        $column['autoIncrement'] = stripos($info['extra'], 'auto_increment') !== false;
        $column['comment'] = $info['comment'];
        $column['dbType'] = $info['type'];
        $column['unsigned'] = stripos($column['dbType'], 'unsigned') !== false;
        $column['type'] = self::TYPE_STRING;
        if (preg_match('/^(\w+)(?:\(([^\)]+)\))?/', $column['dbType'], $matches)) {
            $type = strtolower($matches[1]);
            if (isset($this->typeMap[$type])) {
                $column['type'] = $this->typeMap[$type];
            }
            if (!empty($matches[2])) {
                if ($type === 'enum') {
                    preg_match_all("/'[^']*'/", $matches[2], $values);
                    foreach ($values[0] as $i => $value) {
                        $values[$i] = trim($value, "'");
                    }
                    $column['enumValues'] = $values;
                } else {
                    $values = explode(',', $matches[2]);
                    $column['size'] = $column['precision'] = (int) $values[0];
                    if (isset($values[1])) {
                        $column['scale'] = (int) $values[1];
                    }
                    if ($column['size'] === 1 && $type === 'bit') {
                        $column['type'] = 'boolean';
                    } elseif ($type === 'bit') {
                        if ($column['size'] > 32) {
                            $column['type'] = 'bigint';
                        } elseif ($column['size'] === 32) {
                            $column['type'] = 'integer';
                        }
                    }
                }
            }
        }

        $column['phpType'] = $this->getColumnPhpType($column['type']);
        return $column;
    }

}