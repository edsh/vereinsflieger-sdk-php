<?php
declare(strict_types=1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\Data;

class FlightsData implements \Countable, \IteratorAggregate
{

    /**
     * @var array[]
     */
    private $flightsRepresentation;

    public function __construct(array $flightsRepresentation)
    {
        $this->flightsRepresentation = $flightsRepresentation;
    }

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
     * @return FlightsData|FlightData[]
     */
    public static function fromJsonRepresentation(string $flightsJson): self
    {
        $plainData = \GuzzleHttp\json_decode($flightsJson, true);
        $sanitized =
            array_filter($plainData, function ($key) {
                return is_int($key) || ctype_digit($key);
            }, ARRAY_FILTER_USE_KEY);
        return new self(array_values($sanitized));
    }
}
