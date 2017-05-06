<?php
declare(strict_types=1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Port\Adapter\Service;

use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\Data\FlightData;

class AmeAviaFlightDataCsvAdapter implements \ArrayAccess
{
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

    private function anteil1() { }

    private function mitgliedsnummer2(): string
    {
        return (string) $this->flightData->getAttendantmemberid();
    }

    private function anteil2() { }

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
            case 0: return $this->landeskennung();
            case 1: return $this->kennzeichen();
            case 2: return $this->datum();
            case 3: return $this->startzeit();
            case 4: return $this->landezeit();
            case 5: return $this->flugzeit();
            case 6: return $this->startort();
            case 7: return $this->landeort();
            case 8: return $this->anzahlLandungen();
            case 9: return $this->ausland();
            case 10: return $this->preiskategorie();
            case 11: return $this->pic1();
            case 12: return $this->mitgliedsnummer1();
            case 13: return $this->anteil1();
            case 14: return $this->mitgliedsnummer2();
            case 15: return $this->anteil2();
            case 16: return $this->mitgliedsnummer3();
            case 17: return $this->anteil3();
            case 18: return $this->mitgliedsnummer4();
            case 19: return $this->anteil4();
            case 20: return $this->bemerkung();
            case 21: return $this->hoehenmeter();
            case 22: return $this->einheiten();
            case 23: return $this->vls1();
            case 24: return $this->vls1pk();
            case 25: return $this->vls2();
            case 26: return $this->vls2pk();
            case 27: return $this->flugart();
            case 28: return $this->startart();
            case 29: return $this->luftfahrzeugart();
            case 30: return $this->einheitenZaehlerstandAlt();

        }
    }

    public function __toString(): string
    {
        $self = $this;
        return
            implode(
                ';',
                array_map(function($item) use ($self) {
                    return $self[$item];
                }, range(0,30))
            );
    }

    public function offsetExists($offset)
    {
        return $offset >=0 && $offset <= 30;
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
