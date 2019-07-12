<?php

namespace common\components\helpers;

use yii\helpers\Json;

class XmlArrayHelpers
{
    /**
     * Convert SimpleXMLElement to array.
     *
     * @param SimpleXMLElement $xmlObjects
     * @return array
     */

    public static function xmlObjectsToArray($xmlObjects)
    {
        return call_user_func_array('array_merge', Json::decode(Json::encode($xmlObjects), true));
    }
}