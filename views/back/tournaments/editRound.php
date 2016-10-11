<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 */
use Helpers\Uri;

?>

    <div class="panel panel-primary">
        <div class="panel-heading">
			<h3>Round Matches</h3>
        </div>
		<div class="panel-body">

                <div class="team-line row">
                    <div class="col-md-5">
                        <select name="" id="home-team-1" class="select-team form-control"></select>
                    </div>

                    <div class="col-md-2">
                        <div class="scores">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                        <div class="dates">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <!---buttons-->
                        <div class="scores-additional add">
                            <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                        </div>
                        <div class="scores-additional pen">
                            <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                        </div>
                        <!---inputs-->
                        <div class="show-inputs show-add">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                        <div class="show-inputs show-pen">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <select name="" id="away-team-1" class="select-team form-control"></select>
                    </div>
                </div>
            <hr>
        <div class="team-line row">
                    <div class="col-md-5">
                        <select name="" id="" class="select-team form-control"></select>
                    </div>

                    <div class="col-md-2">
                        <div class="scores">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                        <div class="dates">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <!---buttons-->
                        <div class="scores-additional add">
                            <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                        </div>
                        <div class="scores-additional pen">
                            <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                        </div>
                        <!---inputs-->
                        <div class="show-inputs show-add">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                        <div class="show-inputs show-pen">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <select name="" id="" class="select-team form-control"></select>
                    </div>
                </div>
            <hr>
            <div class="team-line row">
                    <div class="col-md-5">
                        <select name="" id="" class="select-team form-control"></select>
                    </div>

                    <div class="col-md-2">
                        <div class="scores">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                        <div class="dates">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <!---buttons-->
                        <div class="scores-additional add">
                            <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                        </div>
                        <div class="scores-additional pen">
                            <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                        </div>
                        <!---inputs-->
                        <div class="show-inputs show-add">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                        <div class="show-inputs show-pen">
                            <input type="number" value="write score"  min="0">
                            <span> - </span>
                            <input type="number" value="write score"  min="0">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <select name="" id="" class="select-team form-control"></select>
                    </div>
                </div>
            <hr>

        </div>
	</div>


<script type="text/javascript">
    $(function () {
        console.log("ready");
        $('#datetimepicker1').datetimepicker();

        $('.call-additional').on('click', function(){
           $(this).closest('.scores-additional').siblings('.show-add').slideToggle();
        });
        $('.call-penalties').on('click', function(){
           $(this).closest('.scores-additional').siblings('.show-pen').slideToggle();
        });

        var teams = ['team-1', 'team-2', 'team-3', 'team-4', 'team-5', 'team-6', 'team-7', 'team-8'];

        for(var i = 0; i < teams.length; i++){
            $('.select-team').append(
                '<option value="' + teams[i] + '">'  + teams[i] +  '</option>'
            );
        }

            //<option value="team-1">team-1</option>
            //<option value="team-2">team-2</option>
            //<option value="team-3">team-3</option>
            //<option value="team-4">team-4</option>
            //<option value="team-5">team-5</option>
            //<option value="team-6">team-6</option>
            //<option value="team-7">team-7</option>
            //<option value="team-8">team-8</option>


        $('.select-team').on('change', function () {
            var selected_team = $(this).val();
            $(this).find(':selected').addClass('selected')
                .siblings('option').removeClass('selected');

            $(this).find("option:not(.selected)").show();
            console.log($(this).find("option:not(.selected)").val());


            $('.select-team').not(this).find("option").each(function() {

                if($(this).val() == selected_team){
                    console.log($(this).val());
                    $(this).hide();
                }
            });

        });
    });
</script>