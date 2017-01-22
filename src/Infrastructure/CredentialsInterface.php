<?php
declare(strict_types = 1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure;

interface CredentialsInterface
{
    public function username(): string;
    public function password(): string;
}
