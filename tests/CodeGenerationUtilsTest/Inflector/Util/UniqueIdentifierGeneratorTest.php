<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

declare(strict_types=1);

namespace CodeGenerationUtilsTest\Inflector\Util;

use PHPUnit\Framework\TestCase;
use CodeGenerationUtils\Inflector\Util\UniqueIdentifierGenerator;

/**
 * Tests for {@see \CodeGenerationUtils\Inflector\Util\UniqueIdentifierGenerator}
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class UniqueIdentifierGeneratorTest extends TestCase
{
    /**
     * @dataProvider getBaseIdentifierNames
     *
     * @covers \CodeGenerationUtils\Inflector\Util\UniqueIdentifierGenerator::getIdentifier
     *
     * @param string $name
     */
    public function testGeneratesUniqueIdentifiers(string $name)
    {
        self::assertNotSame(
            UniqueIdentifierGenerator::getIdentifier($name),
            UniqueIdentifierGenerator::getIdentifier($name)
        );
    }

    /**
     * @dataProvider getBaseIdentifierNames
     *
     * @covers \CodeGenerationUtils\Inflector\Util\UniqueIdentifierGenerator::getIdentifier
     *
     * @param string $name
     */
    public function testGeneratesValidIdentifiers(string $name)
    {
        self::assertRegExp(
            '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/',
            UniqueIdentifierGenerator::getIdentifier($name)
        );
    }

    /**
     * Data provider generating identifier names to be checked
     *
     * @return string[][]
     */
    public function getBaseIdentifierNames() : array
    {
        return array(
            array(''),
            array('1'),
            array('foo'),
            array('Foo'),
            array('bar'),
            array('Bar'),
            array('foo_bar'),
        );
    }
}
