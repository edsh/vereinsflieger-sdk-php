<?php
declare(strict_types=1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\Data;

class FlightsData implements \Countable, \IteratorAggregate
{
    /**
     * Raw flights representation as multitim array
     * @var array[]
     */
    private $flightsRepresentation;

    public function __construct(array $flightsRepresentation = [])
    {
        $this->flightsRepresentation = $flightsRepresentation;
    }

    public function withFurther(FlightsData $flightsData)
    {
        return
            new self(
                array_merge($this->flightsRepresentation, $flightsData->flightsRepresentation)
            );
    }

    /**
     * @return \Generator|FlightData[]
     */
    public function getIterator()
    {
        foreach ($this->flightsRepresentation as $flightRepresentation) {
            yield FlightData::fromRepresentation($flightRepresentation);
        }
    }

    public function count()
    {
        return count($this->flightsRepresentation);
    }

    /**
     * @param string $flightsJson
     * @return FlightsData
     */
    public static function fromJsonRepresentation(string $flightsJson): self
    {
        return
            new self(self::sanitizeFlightsData($flightsJson));
    }

    public static function sanitizeFlightsData(string $flightsJson): array
    {
        $plainData = \GuzzleHttp\json_decode($flightsJson, true);
        $sanitized =
            array_filter($plainData, function ($key) {
                return is_int($key) || ctype_digit($key);
            }, ARRAY_FILTER_USE_KEY);
        $representation = array_values($sanitized);
        return $representation;
    }
}
