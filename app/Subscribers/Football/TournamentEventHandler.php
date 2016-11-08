<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 5:43
 */
namespace Subscribers\Football;
restrictAccess();


use Football\Tournaments\Types\AbstractType;
use Football\Tournaments\Types\DoubleRoundRobin;
use EventModel;
use Setting;
use SettingsModel;
use Event;
use Message;
use Cache\LocalStorage as Cache;

class TournamentEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением события
     * @param $tournament DoubleRoundRobin
     *
     * todo:: avelacnel AbstracType -um vor @ndhanur sagh turnirneri hamar lini generateTabel -en
     */
    public static function onEventUpdate($tournament){
//        $cache = new Cache();
//        $cache->setLocalPath($tournament->slug.'_article');
//        $cache->clear();

        $tournament->generateTable();
    }

    /**
     * Метод обрабатывающий событие перед обновлением текущего и предедущего события
     * для записи текущего собития в настройках
     * @param $currentEvent \EventModel
     */
    public static function onCurrentEventUpdate($currentEvent){
        $oldCurrentEvent = EventModel::find(Setting::instance()->getSettingVal('football.current_event'));

        // [lt() less than] или Закончился
        if($oldCurrentEvent->isCompleted() or $currentEvent->played_at->lt($oldCurrentEvent->played_at))
        {
            SettingsModel::whereGroup('football')->whereName('current_event')->first()
                ->update([
                    'value' => $currentEvent->id,
                ]);
        }

        $oldLastEvent = EventModel::find(Setting::instance()->getSettingVal('football.last_event'));
        $ownTeam = Setting::instance()->getSettingVal('football.first_team');

        $lastEvent = EventModel::where(['status' => AbstractType::EVENT_STATUS_COMPLETED, 'home_team_id' => $ownTeam])
            ->orWhere(['status' => AbstractType::EVENT_STATUS_COMPLETED, 'away_team_id' => $ownTeam])
            ->orderBy('played_at', 'DESC')
            ->first();

        // lt() less than
        if($lastEvent->played_at->gt($oldLastEvent->played_at))
        {
            SettingsModel::whereGroup('football')->whereName('last_event')->first()
                ->update([
                    'value' => $lastEvent->id,
                ]);
        }

        Event::fire('Admin.settingsUpdate');
    }

    /**
     * Метод обрабатывающий событие обновления собития
     * @param $tournament AbstractType
     */
    public static function onTableUpdate($tournament){
//        Message::instance()->success('Article was successfully saved');
//        $cache = new Cache();
//        $cache->setLocalPath($tournament->slug.'_article');
//        $cache->clear();
//        $cache->setData($tournament);
//        $cache->save();

    }
    
    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Football.eventUpdate',__NAMESPACE__.'\TournamentEventHandler@onEventUpdate');
        $events->listen('Football.tableUpdate',__NAMESPACE__.'\TournamentEventHandler@onTableUpdate');
        $events->listen('Football.currentEventUpdate',__NAMESPACE__.'\TournamentEventHandler@onCurrentEventUpdate');
    }
}