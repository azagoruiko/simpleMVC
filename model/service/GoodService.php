<?php
namespace model\service;

use model\entity\Good;

class GoodService {
    function getList($category) {
        $goods = [];
        $files = scandir("/var/www/data/goods/$category/");
        $files = array_slice($files, 2);
        foreach ($files as $file) {
            $filename = "/var/www/data/goods/$category/$file";
            if (file_exists($filename)) {
                $goods[] = unserialize(file_get_contents($filename));
            }
        }
        return $goods;
    }
    
    function getCategoruiesList() {
        $cats = [];
        $files = scandir("/var/www/data/goods/");
        $files = array_slice($files, 2);
        foreach ($files as $file) {
            $filename = "/var/www/data/goods/$file";
            if (is_dir($filename)) {
                $cats[] = $file;
            }
        }
        
        return $cats;
    }
    
    function add(Good $good) {
        $dirname = "/var/www/data/goods/{$good->getCategory()}/";
        if (!file_exists($dirname)) {
            mkdir($dirname);
        }
        $filename = "$dirname/{$good->getName()}";
        file_put_contents($filename, serialize($good));
    }
}
