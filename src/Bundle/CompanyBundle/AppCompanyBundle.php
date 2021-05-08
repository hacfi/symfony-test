<?php

declare(strict_types=1);

namespace App\Bundle\CompanyBundle;

use App\Bundle\CompanyBundle\DependencyInjection\AppCompanyExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AppCompanyBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new AppCompanyExtension();
    }
}
