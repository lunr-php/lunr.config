<?php

/**
 * This file contains the ConfigurationLoadFileTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2011 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Core\Tests;

/**
 * This tests loading configuration files via the Configuration class.
 *
 * @depends    Lunr\Core\Tests\ConfigurationConvertArrayToClassTest::testConvertArrayToClassWithMultidimensionalArrayValue
 * @covers     Lunr\Core\Configuration
 */
class ConfigurationLoadFileTest extends ConfigurationTest
{

    /**
     * TestCase Constructor.
     */
    public function setUp(): void
    {
        $this->setUpArray($this->construct_test_array());
    }

    /**
     * Test loading a correct config file.
     *
     * @depends Lunr\Core\Tests\ConfigurationArrayConstructorTest::testToArrayEqualsInput
     */
    public function testLoadCorrectFile(): void
    {
        $this->class->load_file('correct');

        $this->config['load']        = [];
        $this->config['load']['one'] = 'Value';
        $this->config['load']['two'] = 'String';

        $this->assertEquals($this->config, $this->class->toArray());
    }

    /**
     * Test loading a correct config file.
     *
     * @depends Lunr\Core\Tests\ConfigurationArrayConstructorTest::testToArrayEqualsInput
     */
    public function testLoadFileOverwritesValues(): void
    {
        $this->class->load_file('overwrite');

        $config                   = [];
        $config['test1']          = 'Value';
        $config['test2']          = [];
        $config['test2']['test3'] = 1;
        $config['test2']['test4'] = FALSE;

        $this->assertEquals($config, $this->class->toArray());
    }

    /**
     * Test loading a correct config file.
     *
     * @depends Lunr\Core\Tests\ConfigurationArrayConstructorTest::testToArrayEqualsInput
     */
    public function testLoadFileMergesArrays(): void
    {
        $this->class->load_file('merge');

        $config                   = [];
        $config['test1']          = 'String';
        $config['test2']          = [];
        $config['test2']['test3'] = 1;
        $config['test2']['test4'] = FALSE;
        $config['test2']['test5'] = 'Value';

        $this->assertEquals($config, $this->class->toArray());
    }

    /**
     * Test loading an invalid config file.
     */
    public function testLoadInvalidFile(): void
    {
        $before = $this->get_reflection_property_value('config');

        $this->class->load_file('not_array');

        $after = $this->get_reflection_property_value('config');

        $this->assertEquals($before, $after);
    }

    /**
     * Test loading a non-existing file.
     */
    public function testLoadNonExistingFile(): void
    {
        $this->expectException('\PHPUnit\Framework\Error\Error');

        $before = $this->get_reflection_property_value('config');

        $this->class->load_file('not_exists');

        $after = $this->get_reflection_property_value('config');

        $this->assertEquals($before, $after);
    }

    /**
     * Test that loading a file invalidates the cached size value.
     */
    public function testLoadFileInvalidatesSize(): void
    {
        $this->assertPropertyEquals('size_invalid', FALSE);

        $this->class->load_file('correct');

        $this->assertPropertyEquals('size_invalid', TRUE);
    }

}

?>
