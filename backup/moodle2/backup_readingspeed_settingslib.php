<?php

/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Define the complete readingspeed structure for backup, with file and id annotations
 *
 * @package   mod_readingspeed
 * @category  backup
 * @copyright 2019, alterego developer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_readingspeed_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the backup structure of the module
     *
     * @return backup_nested_element
     */
    protected function define_structure() {

        // Define the root element describing the readingspeed instance
        $readingspeed = new backup_nested_element('readingspeed', array('id'), array('course', 'category', 'complexity', 'intro', 'introformat', 'timecreated', 'timemodified'));
        $readingspeed->set_source_table('readingspeed', array('id' => backup::VAR_ACTIVITYID));

        // Define the observation test categories
        $categories = new backup_nested_element('categories', array('id'), array('category', 'timecreated', 'timemodified'));
        $categories->set_source_table('observation_categories', array('id' => backup::VAR_ACTIVITYID));

        $readingspeed->add_child($categories);

        // Define the observation cases elements
        $cases = new backup_nested_element('cases');
        $case = new backup_nested_element('case', array('id'), array('category', 'complexity', 'words', 'intro', 'introformat', 'timecreated', 'timemodified'));

        $questions = new backup_nested_element('questions');
        $question = new backup_nested_element('question', array('id'), array('caseid', 'intro', 'introformat', 'timecreated', 'timemodified'));

        $answers = new backup_nested_element('answers');
        $answer = new backup_nested_element('answer', array('id'), array('questionid', 'correct', 'intro', 'introformat', 'timecreated', 'timemodified'));

        $readingspeed->add_child($cases);
        $cases->add_child($case);
        $case->add_child($questions);
        $questions->add_child($question);
        $question->add_child($answers);
        $answers->add_child($answer);

        $case->set_source_table('observation_cases', array('id' => backup::VAR_PARENTID));
        $question->set_source_table('observation_questions', array('id' => backup::VAR_PARENTID));
        $answer->set_source_table('observation_answers', array('id' => backup::VAR_PARENTID));

        $case->annotate_files('mod_readingspeed', 'intro', null);
        $question->annotate_files('mod_readingspeed', 'intro', null);
        $answers->annotate_files('mod_readingspeed', 'intro', null);

        // Defines the observation results
        $results = new backup_nested_element('results');
        $result = new backup_nested_element('result', array('id'), array('userid', 'testid', 'caseid', 'speed', 'readingtime', 'words', 'complexity', 'result', 'timecreated', 'timemodified'));

        $readingspeed->add_child($results);
        
        if ($this->get_setting_value('userinfo')) {
            $result->set_source_table('observation_result', array('id' => backup::VAR_PARENTID));
        } else {
            $overrideparams['userid'] = backup_helper::is_sqlparam(null); //  Without userinfo, skip user overrides.
        }

        // Annotate the user id's where required.
        $result->annotate_ids('user', 'userid');

        // Prepare and return the structure we have just created for the obsevationtest module.
        return $this->prepare_activity_structure($readingspeed);

    }
}
