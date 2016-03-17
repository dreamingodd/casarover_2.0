<?php

namespace App\Services;

use App\Area;

class AreaService {
    /**
     * With the input area_id, get the parent(parent of parent...).
     * Return the text of the full path of the area.
     * e.g. 浙江 杭州 白乐桥
     *
     * @param int $id
     */
    public function getLeafFullName($id) {
        return $this->nameRecursion($id, '');
    }
    protected function nameRecursion($id, $areaText) {
        $area = Area::find($id);
        $areaText = $area->value.' '.$areaText;
        if (empty($area->parentid) || $area->parentid == 1) {
            return $areaText;
        } else {
            return $this->nameRecursion($area->parentid, $areaText);
        }
    }
}
