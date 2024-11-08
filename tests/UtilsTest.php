<?php

namespace Hexlet\Phpunit\Tests;

use PHPUnit\Framework\TestCase;

use function Hexlet\Phpunit\Utils\reverseString;

// Класс UtilsTest наследует класс TestCase
// Имя класса совпадает с именем файла
class UtilsTest extends TestCase
{
    // Создаем фикстуру, общую для всех тестов
    private $fixture1;
    // Создаем метод, который будет сосавлять путь для фикстуры (фикстура в файле)
    public function getFixtureFullPath($fixtureName)
    {
        // 'fixtures' - название директории, $fixtureName - название файла
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
    // Создаем метод, определяющий значение фикстуры, будет запускаться и обновлять значение для каждого теста
    // В данном случае заново создается путь к файлу, но можно нуказать значение прямо тут
    public function setUp(): void
    {
        $this->fixture1 = $this->getFixtureFullPath("something.txt");
    }

    // Метод (функция), определенный внутри класса,
    // Должен начинаться со слова test
    // Ключевое слово public нужно, чтобы PHPUnit мог вызвать этот тест снаружи
    public function testReverse(): void
    {
        $expected = file_get_contents($this->fixture1);
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $this->assertEquals('', reverseString(''));
        $this->assertEquals('olleh', reverseString($expected));
    }
}

// Так же можно сделать функцию перебиратель фикстур, называется "провайдер данных".
// Представляет из себя массив, содержащий другие масивы. Значения массивов подставляются в тестовую функцию.
// что бы работала - надо сделать метод с массивами (фикстурами), а перед тестовым методом указать спец конструкцию:
// Пример:

/**
* @dataProvider additionProvider
*/
    // public function testToHtmlList($expected, $fixture)
    // {
    //     $this->assertEquals($expected, toHtmlList($fixture));
    // }

    // public function additionProvider()
    // {
    //     return [
    //         'case 1' => [file_get_contents($this->getFixtureFullPath("result.html")), $this->getFixtureFullPath("list.csv")],
    //         'case 2' => [file_get_contents($this->getFixtureFullPath("result.html")), $this->getFixtureFullPath("list.json")],
    //         'case 3' => [file_get_contents($this->getFixtureFullPath("result.html")), $this->getFixtureFullPath("list.yaml")]
    //     ];
    // }
