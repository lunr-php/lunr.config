<?php

/**
 * This file contains the ConfigurationNonArrayConstructorTest
 * class.
 *
 * SPDX-FileCopyrightText: Copyright 2011 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Core\Tests;

/**
 * Basic tests for the Configuration class,
 * when initialized with a non-array value.
 *
 * @covers     Lunr\Core\Configuration
 */
class ConfigurationNonArrayConstructorTest extends ConfigurationTest
{

    /**
     * TestCase Constructor.
     */
    public function setUp(): void
    {
        $this->setUpNonArray();
    }

    /**
     * Test that the internal config storage is initially empty.
     */
    public function testConfigIsEmpty(): void
    {
        $this->assertPropertyEmpty('config');
    }

    /**
     * Test that the internal position pointer is initially zero.
     */
    public function testPositionIsZero(): void
    {
        $this->assertPropertyEquals('position', 0);
    }

    /**
     * Test that the initial size value is cached.
     */
    public function testSizeInvalidIsFalse(): void
    {
        $this->assertPropertySame('size_invalid', FALSE);
    }

    /**
     * Test that the initial size value is zero.
     */
    public function testSizeIsZero(): void
    {
        $this->assertPropertyEquals('size', 0);
    }

}

?>
