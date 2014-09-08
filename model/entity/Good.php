<?php

namespace model\entity;

class Good {
    private $name;
    private $price;
    private $category;
    
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setCategory($category) {
        $this->category = $category;
    }


}
