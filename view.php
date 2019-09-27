<?php
/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
require_once('lib.php');
require_once('locallib.php');
 
$id = required_param('id', PARAM_INT);
list ($course, $cm) = get_course_and_cm_from_cmid($id, 'readingspeed');
$readingspeed = $DB->get_record('readingspeed', array('id'=> $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);
$modulecontext = context_module::instance($cm->id);

$useredit = get_user_can_edit(get_user_roles($modulecontext, $USER->id));

if($_SERVER['REQUEST_METHOD'] === 'POST') {

} else {
    $PAGE->set_url('/mod/readingspeed/view.php', array('id' => $cm->id));
    $PAGE->set_title(format_string($readingspeed->name));
    $PAGE->requires->css(new moodle_url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'));
    $PAGE->set_heading(format_string($course->fullname));
    $PAGE->set_context($modulecontext);
    echo $OUTPUT->header();
    if($useredit) {
        if(isset($_GET['action'])) {
            
        }  else {
            echo $OUTPUT->heading($readingspeed->name);
            show_addcasesbutton();
            echo $readingspeed->intro;
        }
    } else {
        echo $OUTPUT->heading($readingspeed->name);
        echo $readingspeed->intro;
    }
    $PAGE->requires->js(new moodle_url('https://code.jquery.com/jquery-3.4.1.min.js'));
    $PAGE->requires->js(new moodle_url('https://kit.fontawesome.com/8368a92b51.js'));
    $PAGE->requires->js(new moodle_url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'));
    $PAGE->requires->js(new moodle_url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'));
    echo $OUTPUT->footer();
}