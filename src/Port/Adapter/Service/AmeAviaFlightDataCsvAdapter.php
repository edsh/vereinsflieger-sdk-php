<?php
declare(strict_types=1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Port\Adapter\Service;

use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\Data\FlightData;

final class AmeAviaFlightDataCsvAdapter implements \ArrayAccess
{
    const FIELD_LANDESKENNUNG = 0;
    const FIELD_KENNZEICHEN = 1;
    const FIELD_DATUM = 2;
    const FIELD_STARTZEIT = 3;
    const FIELD_LANDEZEIT = 4;
    const FIELD_FLUGZEIT = 5;
    const FIELD_STARTORT = 6;
    const FIELD_LANDEORT = 7;
    const FIELD_ANZAHL_LANDUNGEN = 8;
    const FIELD_AUSLAND = 9;
    const FIELD_PREISKATEGORIE = 10;
    const FIELD_PIC_1 = 11;
    const FIELD_MITGLIEDSNUMMER_1 = 12;
    const FIELD_ANTEIL_1 = 13;
    const FIELD_MITGLIEDSNUMMER_2 = 14;
    const FIELD_ANTEIL_2 = 15;
    const FIELD_MITGLIEDSNUMMER_3 = 16;
    const FIELD_ANTEIL_3 = 17;
    const FIELD_MITGLIEDSNUMMER_4 = 18;
    const FIELD_ANTEIL_4 = 19;
    const FIELD_BEMERKUNG = 20;
    const FIELD_HOEHENMETER = 21;
    const FIELD_EINHEITEN = 22;
    const FIELD_VLS_1 = 23;
    const FIELD_VSL_1_PK = 24;
    const FIELD_VSL_2 = 25;
    const FIELD_VSL_2_PK = 26;
    const FIELD_FLUGART = 27;
    const FIELD_STARTART = 28;
    const FIELD_LUFTFAHRZEUGART = 29;
    const FIELD_EINHEITEN_ZAEHLERSTAND_ALT = 30;
    /**
     * @var FlightData
     */
    private $flightData;

    public function __construct(FlightData $flightData)
    {
        $this->flightData = $flightData;
    }

    private function landeskennung(): string
    {
        return strtok($this->flightData->getCallsign(), '-');
    }

    private function kennzeichen(): string
    {
        strtok($this->flightData->getCallsign(), '-');
        return strtok('-');
    }

    private function datum(): string
    {
        return
            \DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                $this->flightData->getDeparturetime(),
                new \DateTimeZone('UTC')
            )
            ->format('d.m.Y');
    }

    private function startzeit(): string
    {
        return
            \DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                $this->flightData->getDeparturetime(),
                new \DateTimeZone('UTC')
            )
                ->format('H:i');
    }

    private function landezeit(): string
    {
        return
            \DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                $this->flightData->getArrivaltime(),
                new \DateTimeZone('UTC')
            )
                ->format('H:i');
    }

    private function flugzeit(): string
    {
        return $this->flightData->getFlighttime();
    }

    private function startort(): string
    {
        return $this->flightData->getDeparturelocation();
    }

    private function landeort(): string
    {
        return $this->flightData->getArrivallocation();
    }

    private function anzahlLandungen(): string
    {
        return $this->flightData->getLandingcount();
    }

    private function ausland(): string
    {
        return 'F';
    }

    private function preiskategorie()
    {
        return '';
    }

    private function pic1(): string
    {
        return $this->flightData->getAttendantmemberid() === null ? 'T' : 'F';
    }

    private function mitgliedsnummer1(): string
    {
        return $this->flightData->getPilotmemberid();
    }

    private function anteil1(): string
    {
        $chargeMode = $this->flightData->getChargemode();

        if ($chargeMode === FlightData::CHARGEMODE_NONE
            || $chargeMode === FlightData::CHARGEMODE_PILOT
        ) {
            return '100';
        }

        if ($chargeMode === FlightData::CHARGEMODE_PILOT_AND_ATTENDANT) {
            return '50';
        }

        if ($chargeMode === FlightData::CHARGEMODE_ATTENDANT) {
            return '0';
        }

        return '';
    }

    private function mitgliedsnummer2(): string
    {
        return (string) $this->flightData->getAttendantmemberid();
    }

    private function anteil2(): string
    {
        $chargeMode = $this->flightData->getChargemode();
        if ($chargeMode === FlightData::CHARGEMODE_ATTENDANT) {
            return '100';
        }
        if ($chargeMode === FlightData::CHARGEMODE_PILOT_AND_ATTENDANT) {
            return '50';
        }
        if ($chargeMode === FlightData::CHARGEMODE_PILOT) {
            return '0';
        }
        return '';
    }

    private function mitgliedsnummer3() { }

    private function anteil3() { }

    private function mitgliedsnummer4() { }

    private function anteil4() { }

    private function bemerkung(): string
    {
        return $this->flightData->getComment();
    }

    private function hoehenmeter() { }

    private function einheiten() { }

    private function vls1() { }

    private function vls1pk() { }

    private function vls2() { }

    private function vls2pk() { }

    /**
     * N, S, F, P, L, C, Ü, B, G, W, M, R
     * Must be implemented on one's own since this is client specific.
     */
    private function flugart() { }

    /**
     * W, F, E
     */
    private function startart(): string
    {
        switch ($this->flightData->getStarttype()) {
            case '1': // Eigenstart
                return 'E';
            case '3': // F-Schlepp
                return 'F';
            case '5': // Windenstart
                // intentional fall-through
            case '7': // Gummiseilstart
                // intentional fall-through
            case '9': // Fahrzeugstart
                return 'W';
        }
    }

    /**
     * 1-8, obsolete since 2.43.128
     */
    private function luftfahrzeugart() { }

    private function einheitenZaehlerstandAlt() { }

    public function offsetGet($offset)
    {
        switch ($offset) {
            case self::FIELD_LANDESKENNUNG:
                return $this->landeskennung();
            case self::FIELD_KENNZEICHEN:
                return $this->kennzeichen();
            case self::FIELD_DATUM:
                return $this->datum();
            case self::FIELD_STARTZEIT:
                return $this->startzeit();
            case self::FIELD_LANDEZEIT:
                return $this->landezeit();
            case self::FIELD_FLUGZEIT:
                return $this->flugzeit();
            case self::FIELD_STARTORT:
                return $this->startort();
            case self::FIELD_LANDEORT:
                return $this->landeort();
            case self::FIELD_ANZAHL_LANDUNGEN:
                return $this->anzahlLandungen();
            case self::FIELD_AUSLAND:
                return $this->ausland();
            case self::FIELD_PREISKATEGORIE:
                return $this->preiskategorie();
            case self::FIELD_PIC_1:
                return $this->pic1();
            case self::FIELD_MITGLIEDSNUMMER_1:
                return $this->mitgliedsnummer1();
            case self::FIELD_ANTEIL_1:
                return $this->anteil1();
            case self::FIELD_MITGLIEDSNUMMER_2:
                return $this->mitgliedsnummer2();
            case self::FIELD_ANTEIL_2:
                return $this->anteil2();
            case self::FIELD_MITGLIEDSNUMMER_3:
                return $this->mitgliedsnummer3();
            case self::FIELD_ANTEIL_3:
                return $this->anteil3();
            case self::FIELD_MITGLIEDSNUMMER_4:
                return $this->mitgliedsnummer4();
            case self::FIELD_ANTEIL_4:
                return $this->anteil4();
            case self::FIELD_BEMERKUNG:
                return $this->bemerkung();
            case self::FIELD_HOEHENMETER:
                return $this->hoehenmeter();
            case self::FIELD_EINHEITEN:
                return $this->einheiten();
            case self::FIELD_VLS_1:
                return $this->vls1();
            case self::FIELD_VSL_1_PK:
                return $this->vls1pk();
            case self::FIELD_VSL_2:
                return $this->vls2();
            case self::FIELD_VSL_2_PK:
                return $this->vls2pk();
            case self::FIELD_FLUGART:
                return $this->flugart();
            case self::FIELD_STARTART:
                return $this->startart();
            case self::FIELD_LUFTFAHRZEUGART:
                return $this->luftfahrzeugart();
            case self::FIELD_EINHEITEN_ZAEHLERSTAND_ALT:
                return $this->einheitenZaehlerstandAlt();
        }
    }

    public function fields(): array
    {
        $self = $this;
        return
            array_map(function($item) use ($self) {
                return $self[$item];
            }, range(0,30));
    }

    public function putFile(\SplFileObject $file): void
    {
        $file->fputcsv($this->fields(), ';');
    }

    public function __toString(): string
    {
        return
            implode(
                ';',
                $this->fields()
            );
    }

    public function offsetExists($offset)
    {
        return $offset >= 0 && $offset <= 30;
    }

    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException('CSV data is immutable.');
    }

    public function offsetUnset($offset)
    {
        throw new \RuntimeException('CSV data is immutable.');
    }
}
