<?php

namespace App\Console\Commands;

use App\Models\ExchangeRate;
use Illuminate\Console\Command;

class FetchExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rates:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TCMB\'den güncel döviz kurlarını çeker';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Döviz kurları güncelleniyor...');

        if (ExchangeRate::fetchCurrentRates()) {
            $this->info('Döviz kurları başarıyla güncellendi.');
            return Command::SUCCESS;
        }

        $this->error('Döviz kurları güncellenirken bir hata oluştu!');
        return Command::FAILURE;
    }
}
