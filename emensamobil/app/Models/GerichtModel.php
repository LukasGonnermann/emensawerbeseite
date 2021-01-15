<?php


namespace App\Models;


class GerichtModel extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'gericht';
    public $primaryKey = 'id';
    public bool $timestamps = false;

    public function getPreisInternAttribute($value)
    {
        return number_format($this->attributes['preis_intern'],2);
    }

    public function getPreisExternAttribute($value)
    {
        return number_format($this->attributes['preis_extern'],2);
    }

    public function setVegetarischAttribute($value) {
        // Wenn Yes
        if (preg_match("/[ ]*[Jj][ ]*[Aa][ ]*]/", $value) || preg_match("/[ ]*[Yy][ ]*[Ee][ ]*[Ss][ ]*]/", $value)) {
            $this->attributes['vegetarisch'] = 1;
        }
        // Wenn No
        else if (preg_match("/[ ]*[Nn][ ]*[Oo][ ]*]/", $value) || preg_match("/[ ]*[Nn][ ]*[Ee][ ]*[Ii][ ]*[Nn][ ]*]/", $value)) {
            $this->attributes['vegetarisch'] = 0;
        }
    }

    public function setVeganAttribute($value) {
        // Wenn Yes
        if (preg_match("/[ ]*[Jj][ ]*[Aa][ ]*]/", $value) || preg_match("/[ ]*[Yy][ ]*[Ee][ ]*[Ss][ ]*]/", $value)) {
            $this->attributes['vegan'] = 1;
        }
        // Wenn No
        else if (preg_match("/[ ]*[Nn][ ]*[Oo][ ]*]/", $value) || preg_match("/[ ]*[Nn][ ]*[Ee][ ]*[Ii][ ]*[Nn][ ]*]/", $value)) {
            $this->attributes['vegan'] = 0;
        }
    }
}
