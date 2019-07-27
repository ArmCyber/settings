<?php 
namespace Zakhayko\Settings;

class JsonObject {
    private $filename;
    private $attributes;

    private static $objects = [];

    /**
     * @param $filename
     * @throws \Exception
     * @return string
     */
    private static function getRealPath($filename){
        $realpath = realpath($filename);
        if (!$realpath) {
            $pathinfo = pathinfo($filename);
            if (!file_exists($pathinfo['dirname'])) mkdir($pathinfo['dirname'], 0775, true);
            $newpath = realpath($pathinfo['dirname']);
            if (!$newpath) throw new \Exception('Bad path.');
            $realpath = $newpath.DIRECTORY_SEPARATOR.$pathinfo['basename'];
        }
        return $realpath;
    }

    public static function init(string $filename) {
        $filename = self::getRealPath($filename);
        if (array_key_exists($filename, self::$objects)) return self::$objects[$filename];
        $json = (new self($filename));
        self::$objects[$filename] = $json;
        return $json;
    }

    private function __construct($filename)
    {
        $this->filename = $filename;
        if (!file_exists($this->filename)) $this->attributes = [];
        else $this->attributes = json_decode(file_get_contents($this->filename), true);
    }

    public function all(){
        return $this->attributes;
    }

    public function get(string $key, $default = null)
    {
        return $this->attributes[$key]??$default;
    }

    public function has(string $key)
    {
        return array_key_exists($key, $this->attributes);
    }

    public function set($name, $value = null) {
        if (is_array($name)) {
            if (count($name)) $this->attributes = array_merge($this->attributes, $name);
        }
        else {
            $this->attributes[$name] = $value;
        }
        $this->updateFile();
        return $this;
    }

    public function forget(string $key) {
        if (array_key_exists($key, $this->attributes)) {
            unset($this->attributes[$key]);
            $this->updateFile();
        }
        return $this;
    }

    public function flush(){
        if (count($this->attributes)) $this->attributes = [];
        $this->updateFile();
        return $this;
    }

    private function updateFile() {
        if (count($this->attributes)) file_put_contents($this->filename, json_encode($this->attributes, JSON_UNESCAPED_UNICODE));
        else if (file_exists($this->filename)) unlink($this->filename);
    }
}