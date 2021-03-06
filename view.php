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
    if($useredit){
        if($_POST['action'] == 'addcategory') {
            echo set_category($_POST['category']);
        } else if($_POST['action'] == 'addquestion') {
            echo set_question($_POST['caseid'],$_POST['question']);
        } else if($_POST['action'] == 'addanswer') {
            echo set_answer($_POST['questionid'],$_POST['correct'],$_POST['intro']);
        } else if($_POST['action'] == 'addcase') {
            $PAGE->set_url('/mod/readingspeed/view.php', array('id' => $cm->id));
            $PAGE->set_title(format_string($readingspeed->name));
            $PAGE->requires->css(new moodle_url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'));
            $PAGE->set_heading(format_string($course->fullname));
            $PAGE->set_context($modulecontext);
            echo $OUTPUT->header();
            echo $OUTPUT->heading(get_string('addnewcase', 'readingspeed'));
            
            $case = set_case($_POST['category'],$_POST['complexity'],$_POST['intro']);
            show_alert($case['status'],$case['message']);
            if($case['caseid'] > 0) {
                show_addquestion_form($cm->id,$case['caseid'],$_POST['categoryname'],$_POST['complexityname'],$case['words'],$case['resume']);
            } else {
                show_addcase_form($cm->id);
            }
            
            $PAGE->requires->js(new moodle_url('https://code.jquery.com/jquery-3.4.1.min.js'));
            $PAGE->requires->js(new moodle_url('https://kit.fontawesome.com/8368a92b51.js'));
            $PAGE->requires->js(new moodle_url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'));
            $PAGE->requires->js(new moodle_url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'));
            $PAGE->requires->js(new moodle_url($CFG->wwwroot . '/mod/readingspeed/assets/js/readingspeed.js'));
            echo $OUTPUT->footer();
        }
    }  
    if($_POST['action'] == 'addresult') {
        $speed = ($_POST['words'] * 60) / $_POST['readingtime'];
        echo set_result($USER->id,$_POST['testid'],$_POST['caseid'],$speed,$_POST['readingtime'],$_POST['words'],$_POST['complexity'],$_POST['result']);
    }
} else {
    $PAGE->set_url('/mod/readingspeed/view.php', array('id' => $cm->id));
    $PAGE->set_title(format_string($readingspeed->name));
    $PAGE->requires->css(new moodle_url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'));
    $PAGE->requires->css(new moodle_url($CFG->wwwroot . '/mod/readingspeed/assets/css/readingspeed.css'));
    $PAGE->set_heading(format_string($course->fullname));
    $PAGE->set_context($modulecontext);
    echo $OUTPUT->header();
    if($useredit) {
        if(isset($_GET['action'])) {
            echo $OUTPUT->heading(get_string('addnewcase', 'readingspeed'));
            show_addcase_form($cm->id);
        }  else {
            echo $OUTPUT->heading($readingspeed->name);
            show_addcasesbutton();
            echo $readingspeed->intro;
        }
    } else {
        echo $OUTPUT->heading($readingspeed->name);
        echo $readingspeed->intro;
    }
    show_case($readingspeed->id);
    $PAGE->requires->js(new moodle_url('https://code.jquery.com/jquery-3.4.1.min.js'));
    $PAGE->requires->js(new moodle_url('https://kit.fontawesome.com/8368a92b51.js'));
    $PAGE->requires->js(new moodle_url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'));
    $PAGE->requires->js(new moodle_url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'));
    $PAGE->requires->js(new moodle_url($CFG->wwwroot . '/mod/readingspeed/assets/js/readingspeed.js'));
    echo $OUTPUT->footer();
}