<?php

namespace artsoft\parallax\models;

use Yii;
use artsoft\models\OwnerAccess;
use artsoft\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use artsoft\behaviors\DateToTimeBehavior;
use artsoft\behaviors\SluggableBehavior; 
use yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%parallax}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $bg_color
 * @property string $bg_image
 * @property string $parallax_class
 * @property string $background_ratio
 * @property string $content_image
 * @property string $content
 * @property string $countdown
 * @property string $countdown_prompt
 * @property string $start_timestamp
 * @property string $url
 * @property string $btn_icon
 * @property string $btn_name
 * @property string $btn_class
 * @property int $status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Parallax extends ActiveRecord implements OwnerAccess
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    public $start_time;
     
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parallax}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true           
            ],
            [
                'class' => DateToTimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'start_time',
                    ActiveRecord::EVENT_AFTER_FIND => 'start_time',
                ],
                'timeAttribute' => 'start_timestamp',
                'timeFormat' => 'd.m.Y H:i',
            ],            
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bg_image', 'parallax_class', 'background_ratio', 'content', 'name'], 'required'],
            [['content', 'slug'], 'string'],
            [['content'], 'trim'],
            [['start_timestamp'], 'safe'],
            [['status', 'countdown'], 'integer'],
            ['countdown', 'default', 'value' => 0],
            [['countdown_prompt', 'name', 'slug', 'bg_color', 'bg_image', 'parallax_class', 'background_ratio', 'content_image', 'url', 'btn_icon', 'btn_name', 'btn_class'], 'string', 'max' => 127],
            ['start_time', 'date', 'format' => 'php:d.m.Y H:i'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'name' => Yii::t('art', 'Name'),
            'slug' => Yii::t('art', 'Slug'),
            'bg_color' => Yii::t('art/parallax', 'Bg Color'),
            'bg_image' => Yii::t('art/parallax', 'Bg Image'),
            'parallax_class' => Yii::t('art/parallax', 'Parallax Class'),
            'background_ratio' => Yii::t('art/parallax', 'Background Ratio'),
            'content_image' => Yii::t('art/parallax', 'Content Image'),
            'content' => Yii::t('art', 'Content'),
            'countdown' => Yii::t('art/parallax', 'Countdown'),
            'countdown_prompt' => Yii::t('art/parallax', 'Countdown Prompt'),
            'start_time' => Yii::t('art/parallax', 'Start Time'),
            'url' => Yii::t('art/parallax', 'Url'),
            'btn_icon' => Yii::t('art/parallax', 'Btn Icon'),
            'btn_name' => Yii::t('art/parallax', 'Btn Name'),
            'btn_class' => Yii::t('art/parallax', 'Btn Class'),
            'status' => Yii::t('art', 'Status'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
            'created_by' => Yii::t('art', 'Created By'),
            'updated_by' => Yii::t('art', 'Updated By'),
        ];
    }
    
     public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }
    
     public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
     /**
     * getStatusList
     * @return array
     */
    public static function getStatusList()
    {
        return array(
            self::STATUS_ACTIVE => Yii::t('art', 'Active'),
            self::STATUS_INACTIVE => Yii::t('art', 'Inactive'),
        );
    }
    
    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullParallaxAccess';
    }
    
    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
}
