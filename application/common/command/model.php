<?php
/**
 * This is the template for generating the model class of a specified table.
 */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use think\Model;

/**
* This is the model class for table "<?= $tableName ?>".
*
<?php foreach ($tableColumns as $column): ?>
    * @property <?= $column['phpType']." \$".$column['name']."\n";?>
<?php endforeach; ?>
*/
class <?= $className ?> extends Model
{

}
