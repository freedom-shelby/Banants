<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;


class PersonnelModel extends Eloquent
{
    // Article slug
    const SLUG = 'personnel';

    public $timestamps = true;

    protected $table = 'personnels';

    protected $fillable = ['first_name_id', 'last_name_id', 'middle_name_id', 'personnel_type_id', 'photo_id', 'status', 'sort', 'slug', 'was_born', 'article_id'];

    protected $dates = ['was_born'];


    public function firstName()
    {
        return $this->firstNameModel()->first()->text;
    }

    public function lastName()
    {
        return $this->lastNameModel()->first()->text;
    }

    public function middleName()
    {
        $model = $this->middleNameModel()->first();

        return $model ? $model->text : null;
    }

    public function fullName($separator = ' ')
    {
        return __($this->firstName()) . $separator . __($this->lastName()) . $separator . __($this->middleName());
    }

    public function defaultFullName($separator = ' ')
    {
        return $this->firstName() . $separator . $this->lastName() . $separator . $this->middleName();
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

    public function middleNameModel()
    {
        return $this->belongsTo('EntityModel', 'middle_name_id');
    }

    public function article()
    {
        return $this->belongsTo('ArticleModel', 'article_id')->first();
    }

    public function type()
    {
        return $this->belongsTo('PersonnelTypeModel', 'personnel_type_id')->first();
    }

    public function specialization()
    {
        return $this->belongsTo('SpecializationModel', 'specialization_id')->first();
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

            $slug = strtolower($model->defaultFullName('_')); // todo:: add slugable CLASS by DateTime
            $slug = str_replace(' ', '-', $slug); // todo:: add slugable CLASS by DateTime

            if(PersonnelModel::whereSlug($slug)->first())
            {
                $slug .= uniqid();
            }

            $model->update(['slug' => $slug]);
        });

//        static::updated(function($model) { // before create() method call this
//
//            $slug = strtolower($model->defaultFullName('_') .'_'. $model->number); // todo:: add slugable CLASS by DateTime
//
//            // Если есть модел по слагу и не равно текущей
//            if(PersonnelModel::whereSlug($slug)->first() and PersonnelModel::whereSlug($slug)->first()->id != $model->id)
//            {
//                $slug .= uniqid();
//            }
//
//            $model->update(['slug' => $slug]);
//        });
    }
}