<?php

namespace common\components\formatters;

use yii\i18n\Formatter;

/**
 * Phone number as string with numeric value like 81234567890, 71234567890
 * Mask as string like *(***)**-**-***, *(***)******* and etc
 * If the number and mask do not match - output as is.
 * Use: Yii::$app->formatter->asNumberByMask($number, $mask);
 */
class PhoneNumberFormatter extends Formatter
{

    /**
     * Formatter for phone number.
     *
     * @param string $number the phone number
     * @param string $mask the mask as rule for phone number
     * @param string $masksymbol symbol to replace for mask
     * @return string
     */

    public function asNumberByMask($number, $mask, $masksymbol = '*')
    {
        if ($number and strlen($number) == substr_count($mask, $masksymbol)) {

            $phone = str_split($number);
            $phonemask = str_split($mask);

            $formatter = array_map(
                function ($a) use ($masksymbol, &$phone) {
                    if ($a == $masksymbol) {
                        $num = array_shift($phone);
                    } else {
                        $num = $a;
                    }
                    return $num;
                },
                $phonemask
            );

            $number = implode('', $formatter);
        }

        return $number;
    }
}
