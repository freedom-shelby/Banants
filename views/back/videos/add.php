<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 23.01.2015
 * Time: 12:23
 */
use Lang\Lang;

?>
<!--Begin Container-->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Add Video</h1>
        </div>
        <form method="post" id="form">
            <div class="panel-body">
                <div class="group container-fluid">
                    <div class="form-group col-sm-8">
                        <div class="form-group col-sm-13">
                            <label for="alias">Youtube Video ID</label>
                        </div>
                        <div class="form-group col-sm-5">
                            <input type="text" name="youtube_id" class="form-control" id="youtube_id" placeholder="Video ID">
                        </div>
                        <div class="form-group col-sm-5">
                            <div class="btn-group" role="group" aria-label="...">
                                <input type="submit" name="submit" value="Add" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Container-->
