<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * CleanURLS URL Parser for: / (root).
 *
 * @package     local_cleanurls
 * @author      Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright   2017 Catalyst IT Australia {@link http://www.catalyst-au.net}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_cleanurls\local\uncleaner\root_uncleaner;
use local_cleanurls\local\uncleaner\selftest_uncleaner;

defined('MOODLE_INTERNAL') || die();
require_once(__DIR__ . '/../../cleanurls_testcase.php');

/**
 * Tests for flexsections_support.
 *
 * @package     local_cleanurls
 * @author      Daniel Thee Roperto <daniel.roperto@catalyst-au.net>
 * @copyright   2017 Catalyst IT Australia {@link http://www.catalyst-au.net}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class selftest_uncleaner_test extends local_cleanurls_testcase {
    public function test_it_has_the_proper_parameters() {
        $root = new root_uncleaner('/local/cleanurls/tests/this/is/my/path');
        $selftest = $root->get_child();

        self::assertInstanceOf(selftest_uncleaner::class, $selftest);
        self::assertSame('this/is/my/path', $selftest->get_mypath());
        self::assertSame([], $selftest->get_subpath());
    }

    public function test_it_always_cleans_the_test_url() {
        // Test with cleaning on.
        set_config('cleaningon', true, 'local_cleanurls');
        static::assert_clean_unclean('/local/cleanurls/tests/foo.php',
                                     'http://www.example.com/moodle/local/cleanurls/tests/bar');

        // Test with cleaning off.
        set_config('cleaningon', false, 'local_cleanurls');
        static::assert_clean_unclean('/local/cleanurls/tests/foo.php',
                                     'http://www.example.com/moodle/local/cleanurls/tests/bar');
    }

    public function test_it_always_cleans_the_webservice_test() {
        // Test with cleaning on.
        set_config('cleaningon', true, 'local_cleanurls');
        static::assert_clean_unclean('/local/cleanurls/tests/foo.php',
                                     'http://www.example.com/moodle/local/cleanurls/tests/bar');

        // Test with cleaning off.
        set_config('cleaningon', false, 'local_cleanurls');
        static::assert_clean_unclean('/local/cleanurls/tests/webserver/index.php',
                                     'http://www.example.com/moodle/local/cleanurls/tests/webcheck');
    }
}
