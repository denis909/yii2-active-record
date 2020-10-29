<?php

namespace denis909\yii;

class ActiveRecord extends \yii\db\ActiveRecord implements ModelInterface
{

    use ModelTrait;
    
    use ActiveRecordTrait;

}