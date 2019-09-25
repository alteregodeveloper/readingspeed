<?php

/**
 * @package   mod_readingspeed
 * @copyright 2019, alterego developer {@link https://alteregodeveloper.github.io}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/mod/readingspeed/backup/moodle2/backup_readingspeed_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the readingspeed instance
 *
 * @package   mod_readingspeed
 * @category  backup
 * @copyright 2019, alterego developer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class backup_readingspeed_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the vat.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_readingspeed_activity_structure_step('readingspeed_structure', 'readingspeed.xml'));
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, '/');

        // Link to the list of readingspeed's.
        $search = '/('.$base.'\/mod\/readingspeed\/index.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@READINGSPEEDINDEX*$2@$', $content);

        // Link to observationtest view by moduleid.
        $search = '/('.$base.'\/mod\/observationtest\/view.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@READINGSPEEDVIEWBYID*$2@$', $content);

        return $content;
    }
}
