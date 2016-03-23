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

    /**
     * Get the hierarchy of all areas.
     * 取得地区的全部层级结构，暂时中国以下。
     * key: id, value: Area
     * Note: At first I put areas in area which queried by Laravel,
     * I got Indirect modification of overloaded property Exception,
     * It seems that the entity's(of Laravel query) array cannot be changed.
     * @return Array:Area
     */
    public function getAreaHierarchy() {
        $simpleProvinces = array();
        $provinces = Area::where('level', 2)->get();
        $cities = Area::where('level', 3)->get();
        $districts = Area::where('level', 4)->get();
        foreach ($provinces as $province) {
            $simpleProvince = $this->simpleArea($province);
            $simpleProvinces[$province->id] = $simpleProvince;
            foreach ($province->subAreas as $city) {
                $simpleCity = $this->simpleArea($city);
                $simpleProvince->sub_areas[$city->id] = $simpleCity;
                foreach ($city->subAreas as $district) {
                    $simpleDistrict = $this->simpleArea($district);
                    $simpleCity->sub_areas[$district->id] = $simpleDistrict;
                }
            }
        }
        return $simpleProvinces;
    }

    public function simpleArea($area) {
        $simpleArea = new \stdClass();
        $simpleArea->id = $area->id;
        $simpleArea->name = $area->value;
        $simpleArea->islast = $area->islast;
        $simpleArea->level = $area->level;
        $simpleArea->parentid = $area->parentid;
        $simpleArea->sub_areas = array ();
        return $simpleArea;
    }
}
