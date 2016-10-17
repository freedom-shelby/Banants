<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class EventTeamStatisticModel extends Eloquent
{
    public $timestamps = true;

    protected $table = 'event_team_statistics';

    protected $fillable = ['team_id', 'team_formation_id', 'score', 'has_additional_time', 'created_at', 'updated_at'];


    public function team()
    {
        return $this->belongsTo('TeamModel', 'team_id')->first();
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