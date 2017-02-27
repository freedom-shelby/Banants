<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;


class PlayerModel extends Eloquent
{
    const SLUG = 'players';

    public $timestamps = true;

    protected $table = 'players';

    protected $fillable = ['first_name_id', 'last_name_id', 'team_id', 'country_id', 'position_id', 'photo_id', 'status', 'number', 'place', 'slug', 'height', 'weight', 'was_born', 'article_id'];

    protected $dates = ['was_born'];


    public function firstName()
    {
        return $this->belongsTo('EntityModel', 'first_name_id')->first()->text;
    }

    public function lastName()
    {
        return $this->belongsTo('EntityModel', 'last_name_id')->first()->text;
    }

    public function fullName($separator = ' ')
    {
        return __($this->firstName()) . $separator . __($this->lastName());
    }

    public function slug()
    {
        return static::SLUG .'/'. $this->slug;
    }

    public function firstNameModel()
    {
        return $this->belongsTo('EntityModel', 'first_name_id');
    }

    public function lastNameModel()
    {
        return $this->belongsTo('EntityModel', 'last_name_id');
    }

    public function country()
    {
        return $this->belongsTo('CountryModel', 'country_id')->first();
    }

    public function article()
    {
        return $this->belongsTo('ArticleModel', 'article_id')->first();
    }

    public function position()
    {
        return $this->belongsTo('PositionModel', 'position_id')->first();
    }

    /**
     * Загрузка картинки по-умолчанию
     */
    public function defaultImage()
    {
        return $this->belongsTo('PhotoModel', 'photo_id')->first();
    }

    protected static function boot() {
        parent::boot();

        static::created(function($model) { // before create() method call this

            $slug = strtolower($model->fullName('_') .'_'. $model->number); // todo:: add slugable CLASS by DateTime

            if(PlayerModel::whereSlug($slug)->first())
            {
                $slug .= uniqid();
            }

            $model->update(['slug' => $slug]);
        });

        static::updated(function($model) { // before create() method call this

            $slug = strtolower($model->fullName('_') .'_'. $model->number); // todo:: add slugable CLASS by DateTime

            // Если есть модел по слагу и не равно текущей
            if(PlayerModel::whereSlug($slug)->first() and PlayerModel::whereSlug($slug)->first()->id != $model->id)
            {
                $slug .= uniqid();
            }

            $model->update(['slug' => $slug]);
        });
    }
}