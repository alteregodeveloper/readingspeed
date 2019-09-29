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

function show_case($readingspeedid) {
    global $DB;

    $query = 'SELECT mdl_reading_cases.id, mdl_reading_cases.intro FROM mdl_reading_cases INNER JOIN mdl_readingspeed ON mdl_reading_cases.category = mdl_readingspeed.category AND mdl_reading_cases.complexity = mdl_readingspeed.complexity WHERE mdl_readingspeed.id = ' . $readingspeedid . ' ORDER BY RAND() LIMIT 1';
    $case = $DB->get_record_sql($query);

    $qnas = '';

    $query = 'SELECT id, caseid, intro FROM mdl_reading_questions WHERE caseid = ' . $case->id . ' ORDER BY RAND()';
    $questions = $DB->get_records_sql($query);
    foreach($questions as $question) {
        $query = 'SELECT id, questionid, correct, intro FROM mdl_reading_answers WHERE questionid = ' . $question->id . ' ORDER BY RAND()';
        $answers = $DB->get_records_sql($query);
        $qnas .= question_show($question,$answers);
    }
    require_once('localview/case_exercise.php');
}

function question_show($question,$answers) {
    $html = '<div class="form-group question border-bottom mb-5"><input type="hidden" class="quiz-value" name="quiz_' . $question->id . '" value="0"><p>' . $question->intro . '</p>';  
    foreach($answers as $answer) {
        $html .= '<p class="answer" data-correct="' . $answer->correct . '"><i class="fas fa-square"></i> ' .$answer->intro . '</p class="answer">';
    }
    $html .= '</div>';
    return $html;
}

function show_addcase_form($activity) {
    $complexityranges = get_complexity_ranges();
    $categories = get_readingspeed_categories();
    require_once('localview/addcase_form.php');
}

function set_case($category,$complexity,$introtext) {
    global $DB;
    $record = new stdClass();
    $record->category = $category;
    $record->complexity = $complexity;
    $words = str_word_count($introtext,0);
    $record->words = $words;
    $record->intro = $introtext;
    $currentDate = new DateTime();
    $record->timecreated = $currentDate->getTimestamp();
    $record->timemodified = $currentDate->getTimestamp();
    $caseid = $DB->insert_record('reading_cases', $record, true);
    if($caseid > 0) {
        return array('status' => 'success', 'message' => 'The file was saved successfully. Now you can create the questions', 'caseid' => $caseid, 'words' => $words, 'resume' => substr($introtext,0,100));
    } else {
        return array('status' => 'danger', 'message' => 'An error occurred while trying to save the image. Try again');
    }
}

function set_category($category) {
    global $DB;
    $record = new stdClass();
    $record->category = $category;
    $currentDate = new DateTime();
    $record->timecreated = $currentDate->getTimestamp();
    $record->timemodified = $currentDate->getTimestamp();
    $idcategory = $DB->insert_record('reading_categories', $record, true);
    if($idcategory > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'Category successfully added', 'idcategory' => $idcategory, 'category' => $category));
    } else {
        echo json_encode(array('status' => 'danger', 'message' => 'It was not possible to create a new category'));
    }
}

function show_addquestion_form($activity,$caseid,$category,$complexity,$words,$resume) {
    require_once('localview/addquestion_form.php');
}

function show_alert($status, $message) {
    echo '<div class="alert alert-' . $status . ' alert-dismissible fade show" role="alert"><i class="fas fa-bell"></i> ' . $message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

function set_question($caseid,$question) {
    global $DB;
    $record = new stdClass();
    $record->caseid = $caseid;
    $record->intro = $question;
    $currentDate = new DateTime();
    $record->timecreated = $currentDate->getTimestamp();
    $record->timemodified = $currentDate->getTimestamp();
    $questionid = $DB->insert_record('reading_questions', $record, true);
    if($questionid > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'Question successfully added', 'questionid' => $questionid, 'question' => $question));
    } else {
        echo json_encode(array('status' => 'danger', 'message' => 'It was not possible to create a new question'));
    }
}

function set_answer($questionid,$correct,$intro) {
    global $DB;
    $record = new stdClass();
    $record->questionid = $questionid;
    $record->correct = $correct;
    $record->intro = $intro;
    $currentDate = new DateTime();
    $record->timecreated = $currentDate->getTimestamp();
    $record->timemodified = $currentDate->getTimestamp();
    $answerid = $DB->insert_record('reading_answers', $record, true);
    if($answerid > 0) {
        echo json_encode(array('status' => 'success', 'correct' => $correct, 'answer' => $intro));
    } else {
        echo json_encode(array('status' => 'warning'));
    }
}

function set_result($userid,$testid,$caseid,$speed,$result) {
    global $DB;
    $record = new stdClass();
    $record->userid = $userid;
    $record->testid = $testid;
    $record->caseid = $caseid;
    $record->speed = $speed;
    $record->result = $result;
    $currentDate = new DateTime();
    $record->timecreated = $currentDate->getTimestamp();
    $record->timemodified = $currentDate->getTimestamp();
    $answerid = $DB->insert_record('reading_result', $record, true);
    if($answerid > 0) {
        echo json_encode(array('status' => 'success', 'result' => $result));
    } else {
        echo json_encode(array('status' => 'warning', 'message' => 'It was not possible to save the result'));
    }
}