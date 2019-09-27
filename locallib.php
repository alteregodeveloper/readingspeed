<?php

/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

function get_complexity_ranges(){
    return array(
    6 => get_string('easy','readingspeed'),
    4 => get_string('medium','readingspeed'),
    2 => get_string('advanced','readingspeed'));
}

function get_readingspeed_categories() {
    global $DB;

    $query = 'SELECT id, category FROM mdl_reading_categories';
    return $DB->get_records_sql_menu($query);
}

function get_user_can_edit($roles) {
    if($roles) {
        $role = key($roles);
        $shortname = $roles[$role]->shortname;
        if($shortname == 'manager' || $shortname == 'coursecreator' || $shortname == 'editingteacher') {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        if(is_siteadmin()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function show_addcasesbutton() {
    $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    echo '<div class="newcasses" style="text-align: right"><a class="printicon" title="Add new case" href="' . $current_url . '&action=addcase"><i class="far fa-plus-square"></i> Add new case</a></div>';
}

function show_addcase_form($activity) {
    $complexityranges = get_complexity_ranges();
    $categories = get_readingspeed_categories();
    require_once('localview/addcase_form.php');
}