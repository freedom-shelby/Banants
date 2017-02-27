<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 22.01.2015
 * Time: 11:54
 *
 * @var $item \Football\Tournaments\Types\DoubleRoundRobin
 */
use Helpers\Uri;

?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Round Matches</h3>
    </div>
    <div class="panel-body">

<!--<pre>-->
<?//=  print_r($teams->toArray(), true); ?>
<?//=  $teams ?>
<!--</pre>-->
        <form action="" method="post" id="submit">
            <? for ($i = 0; $i < $item->maxEventsPerRound(); $i++): ?>
<?//= $events[$i] ?>
                <? if (isset($events[$i])): ?>
                    <div class="team-line row">
                        <input type="hidden" name="events[<?= $i ?>][id]" value="<?= $events[$i]->id ?>">
                        <div class="col-md-4">
                            <select name="events[<?= $i ?>][home][team]" id="home-team-1" class="select-team form-control">
                                <option value="0">Select Team</option>

                                <? foreach ($item->getTeams() as $team): ?>
                                    <option value="<?= $team->team()->id ?>" <?= ($team->team()->id == $events[$i]->home()->team()->id) ? 'selected' : '' ?>><?= __($team->team()->text()) ?></option>
                                <? endforeach ?>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="scores">
                                <input type="number" name="events[<?= $i ?>][home][score]" value="<?= $events[$i]->home()->score ?>" min="0">
                                <span class="line"> - </span>
                                <input type="number" name="events[<?= $i ?>][away][score]" value="<?= $events[$i]->away()->score ?>" min="0">
                            </div>
                            <div class="dates">
                                <div class='input-group date datetimepicker'>
                                    <input type='text' name="events[<?= $i ?>][date]" class="form-control" value="<?= $events[$i]->played_at ?>"/>
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
                                <input type="number" name="events[<?= $i ?>][home][additional]" value="" min="0">
                                <span class="line"> - </span>
                                <input type="number" name="events[<?= $i ?>][away][additional]" value="" min="0">
                            </div>
                            <div class="show-inputs show-pen">
                                <input type="number" name="events[<?= $i ?>][home][pen]" value="" min="0">
                                <span class="line"> - </span>
                                <input type="number" name="events[<?= $i ?>][away][pen]" value="" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="events[<?= $i ?>][away][team]" id="away-team-1" class="select-team form-control">
                                <option value="0">Select Team</option>

                                <? foreach ($item->getTeams() as $team): ?>
                                    <option value="<?= $team->team()->id ?>" <?= ($team->team()->id == $events[$i]->away()->team()->id) ? 'selected' : '' ?>><?= __($team->team()->text()) ?></option>
                                <? endforeach ?>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="">
                                <a href="<?= Uri::makeUriFromId('/Admin/Event/Statistic/'. $events[$i]->id)?>" class="btn btn-success">Stats</a>
                                <a href="<?= Uri::makeUriFromId('/Admin/Event/Statistic/'. $events[$i]->id)?>" class="btn btn-info">Player Stats</a>
                            </div>
                        </div>
                    </div>
                <? else: ?>
                    <div class="team-line row">
                        <div class="col-md-5">
                            <select name="events[<?= $i ?>][home][team]" id="home-team-1" class="select-team form-control">
                                <option value="0">Select Team</option>

                                <? foreach ($item->getTeams() as $team): ?>
                                    <option value="<?= $team->team()->id ?>"><?= __($team->team()->text()) ?></option>
                                <? endforeach ?>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="scores">
                                <input type="number" name="events[<?= $i ?>][home][score]" value="" min="0">
                                <span class="line"> - </span>
                                <input type="number" name="events[<?= $i ?>][away][score]" value="" min="0">
                            </div>
                            <div class="dates">
                                <div class='input-group date datetimepicker'>
                                    <input type='text' name="events[<?= $i ?>][date]" class="form-control" />
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
                                <input type="number" name="events[<?= $i ?>][home][additional]" value="" min="0">
                                <span class="line"> - </span>
                                <input type="number" name="events[<?= $i ?>][away][additional]" value="" min="0">
                            </div>
                            <div class="show-inputs show-pen">
                                <input type="number" name="events[<?= $i ?>][home][pen]" value="" min="0">
                                <span class="line"> - </span>
                                <input type="number" name="events[<?= $i ?>][away][pen]" value="" min="0">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <select name="events[<?= $i ?>][away][team]" id="away-team-1" class="select-team form-control">
                                <option value="0">Select Team</option>

                                <? foreach ($item->getTeams() as $team): ?>
                                    <option value="<?= $team->team()->id ?>"><?= __($team->team()->text()) ?></option>
                                <? endforeach ?>

                            </select>
                        </div>
                    </div>
                <? endif ?>
            <? endfor ?>
        </form>
        <div class="panel-footer form-group col-md-12">
            <button type="submit" class="btn btn-primary" form="submit" name="submit">Save</button>
        </div>
</div>

<script type="text/javascript">
    $(function () {
        $('.scores-additional a').on('click', function(e){
             e.preventDefault();
        });

        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:SS',
            viewDate: moment(new Date()).hours(15).minutes(0).seconds(0).milliseconds(0)
        });

        $('.call-additional').on('click', function(){
            $(this).closest('.scores-additional').siblings('.show-add').slideToggle();
        });
        $('.call-penalties').on('click', function(){
            $(this).closest('.scores-additional').siblings('.show-pen').slideToggle();
        });

//        var team_models = <?//= $teams ?>//; // Командий из Модела
        var team_models = [];
        var teams = {};
        var hidden_teams = [];
        var selected_teams =[];
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
                    $('.select-team [value=' + self.val()+']').show();
                }
                if($.inArray($(this).val(), hidden_teams) != -1){//if not in array 'hidden_teams' hide
                    $('.select-team [value=' + self.val()+']').hide();
                }
            });

            $('.selected').each(function(i, el){
                var self = $(el);
                selected_teams[i] = self.val();
            });
            for(var j = 0; j < hidden_teams.length; j++) {
                if($.inArray(hidden_teams[j], selected_teams) == -1){
                    $('.select-team [value=' + hidden_teams[j]+']').show();
                    hidden_teams.splice($.inArray(hidden_teams[j],hidden_teams) , 1 );
                }
            }
        });
    });
</script>