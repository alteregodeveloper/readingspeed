<?php
/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
require_once('lib.php');
 
$id = required_param('id', PARAM_INT);
list ($course, $cm) = get_course_and_cm_from_cmid($id, 'readingspeed');
$readingspeed = $DB->get_record('readingspeed', array('id'=> $cm->instance), '*', MUST_EXIST);
require_login($course, true, $cm);
$modulecontext = context_module::instance($cm->id);
$PAGE->set_url('/mod/readingspeed/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($readingspeed->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($modulecontext);
echo $OUTPUT->header();
echo $OUTPUT->heading($readingspeed->name);
echo $readingspeed->intro;
echo $OUTPUT->footer(); 