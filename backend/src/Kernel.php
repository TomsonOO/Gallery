<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Dotenv\Dotenv;



class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    public function boot()
    {
        parent::boot();

        if (!$this->booted && $this->environment === 'dev') {
            $dotenv = new Dotenv();
            $dotenv->load('/var/www/backend/.env');
        }
    }
}
