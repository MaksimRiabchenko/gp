<?php

namespace backend\models\forms;

use yii\base\DynamicModel;
use yii\db\ActiveRecord;
use yii\db\Exception;
use common\models\ItemOption;
use common\traits\ModelTrait;

/**
 * Class ItemForm
 *
 * @property array $tmpItemOptions
 */
class ItemForm extends \yii\base\Model
{

    use ModelTrait;

    public $title;
    public $description;
    public $article;
    public $category_id;
    public $price;
    public $video_url;

    public $file;

    private $tmpItemOptions = [];

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        foreach ($this->tmpItemOptions as $value) {
            $optionItem = ItemOption::findOne(['id' => $value->id]);
            if ($optionItem) {

                switch ($optionItem->type) {
                    case 0:
                        /** @var DynamicModel $value */
                        $value->addRule(['value'], 'integer', ['message' => '{attribute} must be an integer type']);
                        break;

                    case 2:
                        $value->addRule(['value'], 'string', ['message' => '{attribute} must be an integer type']);
                        break;

                    default:
                        throw new \Exception('There is no option type to create validator rule');
                }
            } else {
                throw new \Exception('Cant find item option');
            }
        }

        return parent::validate($attributeNames, $clearErrors); // TODO: Change the autogenerated stub
    }

    public function load($data, $formName = null)
    {
        foreach ($data[$this->getClassShortName($this)] as $title => $value) {
            if (strpos($title, 'option_id_') !== false) {
                $exploded = explode('option_id_', $title);
                if (array_key_exists(1, $exploded)) {
                    $this->tmpItemOptions[] = new DynamicModel(['id' => $exploded[1], 'value' => $value]);
                    //                            $model->addRule(['name', 'email'], 'string', ['max' => 128])
                    //                                ->addRule('email', 'email')
                    //
                } else {
                    throw new \Exception('Cant parse iption id');
                }
            }
        }

        return parent::load($data, $formName); // TODO: Change the autogenerated stub
    }

    public function getTmpItemOptions()
    {
        return $this->tmpItemOptions;
    }

    public function getFileName()
    {
        return $this->file->baseName .
            '.' .
            $this->file->extension;
    }

}