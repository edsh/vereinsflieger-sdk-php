<?php
declare(strict_types=1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\Data;

class FlightData
{
    public const CHARGEMODE_NONE = '1';
    public const CHARGEMODE_PILOT = '2';
    public const CHARGEMODE_ATTENDANT = '3';
    public const CHARGEMODE_GUEST = '4';
    public const CHARGEMODE_PILOT_AND_ATTENDANT = '5';
    public const CHARGEMODE_DIFFERENT_MEMBER = '7';

    /** @var string */ private $flid;
    /** @var string */ private $createtime;
    /** @var string */ private $modifytime;
    /** @var string */ private $apid;
    /** @var string */ private $callsign;
    /** @var string */ private $uidpilot;
    /** @var string */ private $pilotname;
    /** @var string */ private $uidattendant;
    /** @var string */ private $attendantname;
    /** @var string */ private $uidattendant2;
    /** @var string */ private $attendantname2;
    /** @var string */ private $uidattendant3;
    /** @var string */ private $attendantname3;
    /** @var string */ private $departuretime;
    /** @var string */ private $departurelocation;
    /** @var string */ private $arrivaltime;
    /** @var string */ private $arrivallocation;
    /** @var string */ private $flighttime;
    /** @var string */ private $landingcount;
    /** @var string */ private $starttype;
    /** @var string */ private $flightmode;
    /** @var string */ private $comment;
    /** @var string */ private $ftid;
    /** @var string */ private $offblock;
    /** @var string */ private $onblock;
    /** @var string */ private $uidfi;
    /** @var string */ private $blocktime;
    /** @var string */ private $uidcharge;
    /** @var string */ private $flidtow;
    /** @var string */ private $motorstart;
    /** @var string */ private $motorend;
    /** @var string */ private $finame;
    /** @var string */ private $pilotmemberid;
    /** @var string */ private $attendantmemberid;
    /** @var string */ private $chargemode;

    public static function fromRepresentation(array $flightRepresentation): FlightData
    {
        $flightData = new self();
        foreach ($flightRepresentation as $key => $value) {
            $setterName = 'set'.ucfirst($key);
            if (method_exists(self::class, $setterName)) {
                $flightData->$setterName($value ?? '');
            }
        }
        return $flightData;
    }

    public function getFlid(): string { return $this->flid; }

    private function setFlid(string $flid) { $this->flid = $flid; }

    public function getCreatetime(): string { return $this->createtime; }

    private function setCreatetime(string $createtime) { $this->createtime = $createtime; }

    public function getModifytime(): string { return $this->modifytime; }

    private function setModifytime(string $modifytime) { $this->modifytime = $modifytime; }

    public function getApid(): string { return $this->apid; }

    private function setApid(string $apid) { $this->apid = $apid; }

    public function getCallsign(): string { return $this->callsign; }

    private function setCallsign(string $callsign) { $this->callsign = $callsign; }

    public function getUidpilot(): string { return $this->uidpilot; }

    private function setUidpilot(string $uidpilot) { $this->uidpilot = $uidpilot; }

    public function getPilotname(): string { return $this->pilotname; }

    private function setPilotname(string $pilotname) { $this->pilotname = $pilotname; }

    public function getUidattendant(): string { return $this->uidattendant; }

    private function setUidattendant(string $uidattendant) { $this->uidattendant = $uidattendant; }

    public function getAttendantname(): string { return $this->attendantname; }

    private function setAttendantname(string $attendantname) { $this->attendantname = $attendantname; }

    public function getUidattendant2(): string { return $this->uidattendant2; }

    private function setUidattendant2(string $uidattendant2) { $this->uidattendant2 = $uidattendant2; }

    public function getAttendantname2(): string { return $this->attendantname2; }

    private function setAttendantname2(string $attendantname2) { $this->attendantname2 = $attendantname2; }

    public function getUidattendant3(): string { return $this->uidattendant3; }

    private function setUidattendant3(string $uidattendant3) { $this->uidattendant3 = $uidattendant3; }

    public function getAttendantname3(): string { return $this->attendantname3; }

    private function setAttendantname3(string $attendantname3) { $this->attendantname3 = $attendantname3; }

    public function getDeparturetime(): string { return $this->departuretime; }

    private function setDeparturetime(string $departuretime) { $this->departuretime = $departuretime; }

    public function getDeparturelocation(): string { return $this->departurelocation; }

    private function setDeparturelocation(string $departurelocation) { $this->departurelocation = $departurelocation; }

    public function getArrivaltime(): string { return $this->arrivaltime; }

    private function setArrivaltime(string $arrivaltime) { $this->arrivaltime = $arrivaltime; }

    public function getArrivallocation(): string { return $this->arrivallocation; }

    private function setArrivallocation(string $arrivallocation) { $this->arrivallocation = $arrivallocation; }

    public function getFlighttime(): string { return $this->flighttime; }

    private function setFlighttime(string $flighttime) { $this->flighttime = $flighttime; }

    public function getLandingcount(): string { return $this->landingcount; }

    private function setLandingcount(string $landingcount) { $this->landingcount = $landingcount; }

    public function getStarttype(): string { return $this->starttype; }

    private function setStarttype(string $starttype) { $this->starttype = $starttype; }

    public function getFlightmode(): string { return $this->flightmode; }

    private function setFlightmode(string $flightmode) { $this->flightmode = $flightmode; }

    public function getComment(): string { return $this->comment; }

    private function setComment(string $comment) { $this->comment = $comment; }

    public function getFtid(): string { return $this->ftid; }

    private function setFtid(string $ftid) { $this->ftid = $ftid; }

    public function getOffblock(): string { return $this->offblock; }

    private function setOffblock(string $offblock) { $this->offblock = $offblock; }

    public function getOnblock(): string { return $this->onblock; }

    private function setOnblock(string $onblock) { $this->onblock = $onblock; }

    public function getUidfi(): string { return $this->uidfi; }

    private function setUidfi(string $uidfi) { $this->uidfi = $uidfi; }

    public function getBlocktime(): string { return $this->blocktime; }

    private function setBlocktime(string $blocktime) { $this->blocktime = $blocktime; }

    public function getUidcharge(): string { return $this->uidcharge; }

    private function setUidcharge(string $uidcharge) { $this->uidcharge = $uidcharge; }

    public function getFlidtow(): string { return $this->flidtow; }

    private function setFlidtow(string $flidtow) { $this->flidtow = $flidtow; }

    public function getMotorstart(): string { return $this->motorstart; }

    private function setMotorstart(string $motorstart) { $this->motorstart = $motorstart; }

    public function getMotorend(): string { return $this->motorend; }

    private function setMotorend(string $motorend) { $this->motorend = $motorend; }

    public function getFiname(): ?string { return $this->finame; }

    private function setFiname(string $finame = null) { $this->finame = $finame; }

    public function getPilotmemberid(): string { return $this->pilotmemberid; }

    private function setPilotmemberid(string $pilotmemberid) { $this->pilotmemberid = $pilotmemberid; }

    public function getAttendantmemberid(): ?string { return $this->attendantmemberid; }

    private function setAttendantmemberid(string $attendantmemberid = null) { $this->attendantmemberid = $attendantmemberid; }

    public function getChargemode(): string { return $this->chargemode; }

    private function setChargemode(string $chargemode) { $this->chargemode = $chargemode; }
}
