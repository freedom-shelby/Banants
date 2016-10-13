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

<pre>
<?//=  print_r($teams->toArray(), true); ?>
<?=  $teams ?>
</pre>

        <? for ($i = 0; $i < $item->maxEventsPerRound(); $i++): ?>
            <!--            --><?//= $events[$i] ?>
            <div class="team-line row">
                <div class="col-md-5">
                    <select name="" id="home-team-1" class="select-team form-control">
                        <option value="0">Select Team</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="scores">
                        <input type="number" value="" min="0">
                        <span> - </span>
                        <input type="number" value="" min="0">
                    </div>
                    <div class="dates">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        </div>
                    </div>
                    <div class="scores-additional add">
                        <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                    </div>
                    <div class="scores-additional pen">
                        <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                    </div>
                    <div class="show-inputs show-add">
                        <input type="number" value="" min="0">
                        <span> - </span>
                        <input type="number" value="" min="0">
                    </div>
                    <div class="show-inputs show-pen">
                        <input type="number" value="" min="0">
                        <span> - </span>
                        <input type="number" value="" min="0">
                    </div>
                </div>

                <div class="col-md-5">
                    <select name="" id="away-team-1" class="select-team form-control">
                        <option value="0">Select Team</option>
                    </select>
                </div>
            </div>
        <? endfor ?>

        <div class="team-line row">
            <div class="col-md-5">
                <select name="" id="home-team-1" class="select-team form-control">
                    <option value="0">Select Team</option>
                </select>
            </div>

            <div class="col-md-2">
                <div class="scores">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
                <div class="dates">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="scores-additional add">
                    <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                </div>
                <div class="scores-additional pen">
                    <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                </div>
                <div class="show-inputs show-add">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
                <div class="show-inputs show-pen">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
            </div>

            <div class="col-md-5">
                <select name="" id="away-team-1" class="select-team form-control">
                    <option value="0">Select Team</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="team-line row">
            <div class="col-md-5">
                <select name="" id="home-team-2" class="select-team form-control">
                    <option value="0">Select Team</option>
                </select>
            </div>

            <div class="col-md-2">
                <div class="scores">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
                <div class="dates">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="scores-additional add">
                    <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                </div>
                <div class="scores-additional pen">
                    <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                </div>
                <div class="show-inputs show-add">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
                <div class="show-inputs show-pen">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
            </div>

            <div class="col-md-5">
                <select name="" id="home-away-2" class="select-team form-control">
                    <option value="0">Select Team</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="team-line row">
            <div class="col-md-5">
                <select name="" id="home-team-3" class="select-team form-control">
                    <option value="0">Select Team</option>
                </select>
            </div>

            <div class="col-md-2">
                <div class="scores">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
                <div class="dates">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="scores-additional add">
                    <a href="#" class="call call-additional btn btn-primary">Additional Time</a>
                </div>
                <div class="scores-additional pen">
                    <a href="#" class="call call-penalties btn btn-primary">Penalties</a>
                </div>
                <div class="show-inputs show-add">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
                <div class="show-inputs show-pen">
                    <input type="number" value="" min="0">
                    <span> - </span>
                    <input type="number" value="" min="0">
                </div>
            </div>
            <div class="col-md-5">
                <select name="" id="home-away-3" class="select-team form-control">
                    <option value="0">Select Team</option>
                </select>
            </div>
        </div>
        <hr>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        console.log("ready!!!");
        $('#datetimepicker1').datetimepicker();

        $('.call-additional').on('click', function(){
            $(this).closest('.scores-additional').siblings('.show-add').slideToggle();
        });
        $('.call-penalties').on('click', function(){
            $(this).closest('.scores-additional').siblings('.show-pen').slideToggle();
        });

        var team_models = <?= $teams ?>;
        var teams = {};
        var hidden_teams = [];
//        var team_counts = Object.keys(teams).length;

        for (var key in team_models) {
            teams[key]= team_models[key]["entity"]["text"] ;
        }

        for (var key in teams) {
            $('.select-team').append(
                '<option value="' + key + '">'  + teams[key] +  '</option>'
            );
        }

        $('.select-team').on('change', function () {

            var hide_zero = $(this).val();

                var selected_team = $(this).val();

                // store selected team in array
                if(hide_zero > 0) {
                    hidden_teams.push(selected_team);
                }

                // add 'selected' class to selected element
                $(this).find(':selected').addClass('selected')
                    .siblings('option').removeClass('selected');

                // hide selected element from all elements
                // except the current one
                $('.select-team').not(this).each(function () {

                    $(this).find("option").each(function () {
                        if ($(this).val() == selected_team) {
                            $(this).hide();
                        }
                    });
                });
                // check all 'option' elements in other 'select' tags
                $('.select-team').not(this).find("option").each(function(i, el){
                    var self = $(el);
                        if(self.hasClass("selected")){
                            self.hide();
                        }
                    if($.inArray($(this).val(), hidden_teams) == -1){//if not in array 'hidden_teams' show
                        $('[value=' + self.val()+']').show();
                    }
                    if($.inArray($(this).val(), hidden_teams) != -1){//if not in array 'hidden_teams' hide
                        $('[value=' + self.val()+']').hide();
                    }

                });
                var selected_teams =[];
                $('.selected').each(function(i, el){
                    var self = $(el);
                    selected_teams[i] = self.val();
                });
                for(var j = 0; j < hidden_teams.length; j++) {
                    if($.inArray(hidden_teams[j], selected_teams) == -1){
                        $('[value=' + hidden_teams[j]+']').show();
                        hidden_teams.splice($.inArray(hidden_teams[j],hidden_teams) , 1 );
                    }
                }

        });

    });
</script>