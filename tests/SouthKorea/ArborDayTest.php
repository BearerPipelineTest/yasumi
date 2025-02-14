<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\SouthKorea;

use DateTime;
use DateTimeZone;
use Exception;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing day after Arbor Day in South Korea.
 */
class ArborDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was removed.
     */
    public const REMOVED_YEAR = 2005;

    /**
     * The year in which the holiday was not celebrated.
     */
    public const YEAR_NOT_CELEBRATED = 1960;
    /**
     * The name of the holiday.
     */
    private const HOLIDAY = 'arborDay';

    /**
     * The year in which the holiday was first established.
     */
    private const ESTABLISHMENT_YEAR = 1949;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::REMOVED_YEAR);
        if (self::YEAR_NOT_CELEBRATED === $year) {
            $this->assertNotHoliday(
                self::REGION,
                self::HOLIDAY,
                $year
            );
        } else {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new DateTime("$year-4-5", new DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * Tests the holiday defined in this test after removal.
     *
     * @throws Exception
     */
    public function testHolidayAfterRemoval(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::REMOVED_YEAR + 1)
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::REMOVED_YEAR);
        if (self::YEAR_NOT_CELEBRATED !== $year) {
            $this->assertTranslatedHolidayName(
                self::REGION,
                self::HOLIDAY,
                $year,
                [self::LOCALE => '식목일']
            );
        }
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::REMOVED_YEAR);
        if (self::YEAR_NOT_CELEBRATED !== $year) {
            $this->assertHolidayType(
                self::REGION,
                self::HOLIDAY,
                $year,
                Holiday::TYPE_OFFICIAL
            );
        }
    }
}
