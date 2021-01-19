<?php


namespace App\Models;


class GerichtModel extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'gericht';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function getPreisInternAttribute($value)
    {
        return number_format($this->attributes['preis_intern'],2);
    }

    public function getPreisExternAttribute($value)
    {
        return number_format($this->attributes['preis_extern'],2);
    }

    public function setVegetarischAttribute($value) {
        if (preg_match("/[ ]*[J|j][ ]*[A|a][ ]*/", $value) || preg_match("/[ ]*[Y|y][ ]*[E|e][ ]*[S|s][ ]*/", $value))
            $this->attributes['vegetarisch'] = 1;
        else if (preg_match("/[ ]*[N|n][ ]*[E|e][ ]*[I|i][ ]*[N|n][ ]*/", $value) || preg_match("/[ ]*[N|n][ ]*[O|o][ ]*/", $value))
            $this->attributes['vegetarisch'] = 0;
    }

    public function setVeganAttribute($value) {
        // Wenn Yes
        if (preg_match("/[ ]*[J|j][ ]*[A|a][ ]*/", $value) || preg_match("/[ ]*[Y|y][ ]*[E|e][ ]*[S|s][ ]*/", $value)) {
            $this->attributes['vegan'] = 1;
        }
        // Wenn No
        else if (preg_match("/[ ]*[N|n][ ]*[O|o][ ]*/", $value) || preg_match("/[ ]*[N|n][ ]*[E|e][ ]*[I|i][ ]*[N|n][ ]*/", $value)) {
            $this->attributes['vegan'] = 0;
        }
    }
}
