<?php

/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}
 
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/readingspeed/lib.php');
require_once($CFG->dirroot.'/mod/readingspeed/locallib.php');
 
class mod_readingspeed_mod_form extends moodleform_mod {
 
    function definition() {
        global $CFG, $DB, $OUTPUT;
 
        $mform =& $this->_form;

        $mform->addElement('text', 'name', get_string('readingspeedname', 'readingspeed'), array('size'=>'64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
 
        $categories = get_readingspeed_categories();
        $mform->addElement('select', 'category', get_string('category', 'readingspeed'), $categories);
        $mform->setDefault('category', 1);

        $complexityranges = get_complexity_ranges();
        $mform->addElement('select', 'complexity', get_string('complexity', 'readingspeed'), $complexityranges);
        $mform->setDefault('complexity', 1);

        $this->standard_intro_elements();
        $element = $mform->getElement('introeditor');
        $attributes = $element->getAttributes();
        $attributes['rows'] = 10;
        $element->setAttributes($attributes);   
 
        $this->standard_coursemodule_elements();
        
        $this->add_action_buttons();
    }
}