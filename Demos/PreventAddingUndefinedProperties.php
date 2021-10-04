<?php
class person
{
    public $firstname;
    public $lastname;

    public function __toString()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function __set($name, $value)
    {
        unset($value);
        throw new Exception($name .' is not a defined property');
    }
}

$prsn = new person();
$prsn->firstname = 'Islam';
$prsn->last = 'kahled';

echo $prsn;
echo $prsn->last;

