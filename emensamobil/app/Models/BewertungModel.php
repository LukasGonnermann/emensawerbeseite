<?php


namespace App\Models;

/**
 * Class BewertungModel Nutzt daten aus dem bewertung table in der Datenbank.
 * @package App\Models
 */
class BewertungModel extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'bewertung';
    public $primaryKey = 'bewertung_id';
    public $timestamps = false;

}
