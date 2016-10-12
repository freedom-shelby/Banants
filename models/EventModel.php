<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class EventModel extends Eloquent
{
    public $timestamps = true;

    protected $table = 'events';

    protected $fillable = ['tournament_id', 'home_id', 'away_id', 'slug', 'winner', 'status', 'round', 'played_at', 'started_at', 'ended_at'];


    public function tournament()
    {
        return $this->belongsTo('TournamentModel', 'tournament_id')->first();
    }

    public function home()
    {
        return $this->belongsTo('TeamModel', 'home_id')->first();
    }

    public function away()
    {
        return $this->belongsTo('TeamModel', 'away_id')->first();
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::updating(function($model) { // before update() method call this

            $slug = $model->home()->text() . '_' . $model->away()->text(); // todo:: add slugable CLASS by DateTime
            $model->update(['slug' => $slug]);
            // do the rest of the cleanup...
        });

        static::creating(function($model) { // before create() method call this

//            $model->contents()->detach($model->id);
            // do the rest of the cleanup...
        });
    }
}