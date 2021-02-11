<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Notifications\SlackNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use GuzzleHttp\Client as HttpClient;

class SlackMessage extends Command
{

    public $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia uma notificação para um canal do slack';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new HttpClient();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $message = new Message();
        $send = $message->notify(new SlackNotification());
        if($send instanceof Exception){
            return $this->error('Algo deu errado ao tentar enviar mensagem para o canal do Slack');
        }
        $this->info('Mensagem Enviada para o canal: ' .Carbon::now()->timezone('America/Sao_Paulo'));
    }
}
