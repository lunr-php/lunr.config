<?php

/**
 * This file contains the ConfigurationConvertArrayToClassTest
 * class.
 *
 * SPDX-FileCopyrightText: Copyright 2011 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Core\Tests;

use Lunr\Core\Configuration;

/**
 * Test for the method convertArrayToClass().
 *
 * @covers Lunr\Core\Configuration
 */
class ConfigurationConvertArrayToClassTest extends ConfigurationTestCase
{

    /**
     * TestCase Constructor.
     */
    public function setUp(): void
    {
        $this->setUpArray([]);
    }

    /**
     * Test convertArrayToClass() with an empty array as input.
     *
     * @covers Lunr\Core\Configuration::convertArrayToClass
     */
    public function testConvertArrayToClassWithEmptyArrayValue(): void
    {
        $method = $this->getReflectionMethod('convertArrayToClass');
        $output = $method->invokeArgs($this->class, [ [] ]);

        $this->assertArrayEmpty($output);
    }

    /**
     * Test convertArrayToClass() with an array as input.
     *
     * @covers Lunr\Core\Configuration::convertArrayToClass
     */
    public function testConvertArrayToClassWithArrayValue(): void
    {
        $input          = [];
        $input['test']  = 'String';
        $input['test1'] = 1;

        $method = $this->getReflectionMethod('convertArrayToClass');
        $output = $method->invokeArgs($this->class, [ $input ]);

        $this->assertEquals($input, $output);
    }

    /**
     * Test convertArrayToClass() with a multi-dimensional array as input.
     *
     * @depends testConvertArrayToClassWithArrayValue
     * @covers  Lunr\Core\Configuration::convertArrayToClass
     */
    public function testConvertArrayToClassWithMultidimensionalArrayValue(): void
    {
        $config                   = [];
        $config['test1']          = 'String';
        $config['test2']          = [];
        $config['test2']['test3'] = 1;
        $config['test2']['test4'] = FALSE;

        $method = $this->getReflectionMethod('convertArrayToClass');
        $output = $method->invokeArgs($this->class, [ $config ]);

        $this->assertTrue(is_array($output));

        $this->assertInstanceOf(Configuration::class, $output['test2']);

        $property = $this->getReflectionProperty('isRootConfig');
        $this->assertFalse($property->getValue($output['test2']));

        $property = $this->getReflectionProperty('size');
        $this->assertEquals(2, $property->getValue($output['test2']));

        $property = $this->getReflectionProperty('config');
        $this->assertEquals($config['test2'], $property->getValue($output['test2']));
    }

}

?>
