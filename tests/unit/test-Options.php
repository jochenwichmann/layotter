<?php

use Layotter\Components\Options;
use Layotter\Core;
use Layotter\Tests\BaseTest;

/**
 * @group unit
 */
class OptionsTest extends BaseTest {

    public function test_ElementOptions() {
        $options = Core::assemble_new_options('element');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    public function test_ColumnOptions() {
        $options = Core::assemble_new_options('col');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    public function test_RowOptions() {
        $options = Core::assemble_new_options('row');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    public function test_PostOptions() {
        $options = Core::assemble_new_options('post');

        $this->assertTrue($options instanceof Options);
        $this->assertTrue($options->is_enabled());
        $this->assertEquals(1, count($options->get_fields()));
        $this->assertEquals(1, count($options->get_values()));
    }

    public function test_PostTypeContext() {
        $options = Core::assemble_new_options('post');
        $options->set_post_type_context('post');

        $this->assertFalse($options->is_enabled());

        $options->set_post_type_context('page');

        $this->assertTrue($options->is_enabled());
    }

}