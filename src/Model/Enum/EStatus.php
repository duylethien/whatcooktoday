<?php

namespace App\Model\Enum;


abstract class EStatus {
    const ACTIVE = 1;
    const INACTIVE = 0;

    public static function getStatusString($status) {
        switch ($status) {
            case EStatus::ACTIVE:
                return 'Active';
            case EStatus::INACTIVE:
                return 'Inactive';
        }
        return null;
    }

    public static function valueToName($val) {
        switch ($val) {
            case self::ACTIVE:
                return 'Active';
            case self::INACTIVE:
                return 'Inactive';
        }
        return null;
    }
}
