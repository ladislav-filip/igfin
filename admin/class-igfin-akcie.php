<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class akcieDTO {

    private $validErrors = array();
    
    public $id;
    public $code;
    public $name;
    public $price;
    public $desc;

    public function isValid() {
        $result = true;
        $state = !empty($this->code) && strlen($this->code) < 21;
        if (!$state) $this->validErrors[] = __("Kód akcie je povinný. Maximální velikost je 20 znaků.");
        $result = $state;
        
        $state = !empty($this->name) && strlen($this->name) < 151;
        if (!$state) $this->validErrors[] = __("Název akcie je povinný. Maximální velikost je 150 znaků.");
        $result = $state && $result;
        
        $state = !empty($this->price) && floatval($this->price) >= 0;
        if (!$state) $this->validErrors[] = __("Cena akcie je povinná. Musí být větší než nula.");
        $result = $state && $result;
        
        return $result;
    }
    
    public function getValidErrors() {
        return join('<br/>', $this->validErrors);
    }

}

/**
 * Description of class-igfin-akcie
 *
 * @author ladis
 */
class class_igfin_akcie {

    private $table;
    private $lastError = null;
    private $editor = false;
    
    /**
     *
     * @var akceDTO
     */
    private $dto = null;

    public function __construct() {
        global $wpdb;
        $this->table = $wpdb->prefix . 'akcie';

        if ($this->isPost()) {
            $this->saveNew();
        }

        $this->show();
    }

    private function isPost() {        
        return ($_SERVER['REQUEST_METHOD'] === 'POST');
    }

    private function post($name) {
        $d = $_POST[$name];
        return empty($d) ? null : $d;
    }

    /**
     * 
     * @return akceDTO
     */
    private function getPostData() {
        if (is_null($this->dto)) {
            $dto = new akcieDTO();
            $dto->code = $this->post('code');
            $dto->name = $this->post('name');
            $dto->price = $this->post('price');
            $dto->desc = $this->post('desc');
            $this->dto = $dto;
        }
        return $this->dto;
    }

    private function load() {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$this->table} LIMIT 30");
        return $result;
    }

    private function show() {
        include plugin_dir_path(dirname(__FILE__)) . 'admin/partials/igfin-admin-akcie.php';
    }

    private function saveNew() {
        global $wpdb;
        $dto = $this->getPostData();
        if (!$dto->isValid()) {
            $this->lastError = $dto->getValidErrors();
            $this->editor = true;
        } else {
            $wpdb->insert(
                $this->table, array(
                    'akcie_code' => $dto->code,
                    'akcie_name' => $dto->name,
                    'akcie_price' => $dto->price,
                    'akcie_description' => $dto->desc
                )
            );
            $this->dto = new akcieDTO();
            $this->editor = false;
        }
    }

    private function lastErrorMessage() {
        return $this->lastError;
    }
    
    private function isEditor() {
        return $this->editor;
    }

}
