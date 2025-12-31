<?php

namespace OmarMokhtar\HijriDate\Console;

use Illuminate\Console\Command;
use OmarMokhtar\HijriDate\Services\HijriValidatorService;

class ValidateHijriCommand extends Command
{
    protected $signature = 'hijri:validate';
    protected $description = 'Validate today Hijri date against external source';

    protected HijriValidatorService $validator;

    public function __construct(HijriValidatorService $validator)
    {
        parent::__construct();
        $this->validator = $validator;
    }

    public function handle()
    {
        $result = $this->validator->validateToday();
        $this->info('Hijri date validated: ' . json_encode($result));
    }
}
