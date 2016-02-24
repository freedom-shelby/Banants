<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class SettingsModel extends Eloquent
{
    protected $table = 'settings';

//    protected $hidden = ['pivot'];

    protected $guarded = ['id'];

    protected $fillable = ['value'];

}