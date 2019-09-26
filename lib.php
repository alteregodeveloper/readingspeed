<?php

/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Add readingspeed instance.
 *
 * @param stdClass $data
 * @param stdClass $mform
 * @return int new readingspeed instance id
 */
function readingspeed_add_instance($data, $mform) {
    global $DB;

    $data->timecreated = time();
    $data->timemodified = $data->timecreated;
    if (!isset($data->customtitles)) {
        $data->customtitles = 0;
    }

    $id = $DB->insert_record('readingspeed', $data);

    $completiontimeexpected = !empty($data->completionexpected) ? $data->completionexpected : null;
    \core_completion\api::update_completion_date_event($data->coursemodule, 'readingspeed', $id, $completiontimeexpected);

    return $id;
}

/**
 * Update readingspeed instance.
 *
 * @param stdClass $data
 * @param stdClass $mform
 * @return bool true
 */
function readingspeed_update_instance($data, $mform) {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    $result = $DB->update_record('readingspeed', $data);

    return true;
}

/**
 * Delete readingspeed instance.
 * @param int $id
 * @return bool true
 */
function readingspeed_delete_instance($id) {
    global $DB;

    if (!$readingspeed = $DB->get_record('readingspeed', array('id'=>$id))) {
        return false;
    }

    $cm = get_coursemodule_from_instance('readingspeed', $id);
    \core_completion\api::update_completion_date_event($cm->id, 'readingspeed', $id, null);

    // note: all context files are deleted automatically

    $DB->delete_records('readingspeed', array('id'=>$readingspeed->id));

    return true;
}