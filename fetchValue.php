<?php

class fetchValue {

    private $str;
    private $find_start;
    private $find_end;

    public function set($str, $find_start, $find_end) {
        $this->str = $str;
        $this->find_start = $find_start;
        $this->find_end = $find_end;
        return $this;
    }

    public function getValue() {
        $start = @strpos($this->str, $this->find_start);
        if ($start === false) {
            return "";
        }
        $length = strlen($this->find_start);


        $end = strpos(substr($this->str, $start + $length), $this->find_end);
        return trim(substr($this->str, $start + $length, $end));
    }

}
