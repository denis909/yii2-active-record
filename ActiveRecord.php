<?php

namespace denis909\yii;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

class ActiveRecord extends \yii\db\ActiveRecord implements ModelInterface
{

    use RefreshAttributesTrait;
    
    use ModelTrait;
    
    use ActiveRecordTrait;

    use LoggerAwareTrait;

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();

        $this->setLogger(new NullLogger);
    }

}