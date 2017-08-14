<?php

use \Layotter\Components\Options;
use \Layotter\Core;

class OptionsTest extends WP_UnitTestCase {

    function test_ElementOptions() {
        $options = Core::assemble_new_options('element');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    function test_ColumnOptions() {
        $options = Core::assemble_new_options('col');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    function test_RowOptions() {
        $options = Core::assemble_new_options('row');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    function test_PostOptions() {
        $options = Core::assemble_new_options('post');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

}