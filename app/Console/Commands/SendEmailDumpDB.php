<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Storage;

class SendEmailDumpDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump-sql:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza respaldo de base de datos y envia a un correo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      
        $data = array(
            'name' => "xxx"
       );

        $date = date("d_m_yxH_i_s");
        $fileBase="investment_capital_$date";
        $file = "$fileBase.sql";
        $fileZip ="$fileBase.zip";

        $comando =" mysqldump --user=root --password=F3rM1st3rCap1tal444 --lock-tables --databases invesment_capital >  backup/$file && ".
            "zip backup/$fileZip backup/$file";
        $process = new Process($comando);
        $process->run();
        if (!$process->isSuccessful()) {
               Mail::raw("No fue posible realizar respaldo. {$process->getExitCodeText()}", function ($message) {
                $message->from('notificaciones@capital444.com');
                $message->to('invesment.capital.notification@gmail.com')->subject('Error a crear Respaldo');
            });
            throw new ProcessFailedException($process); 
        }

        Mail::html(" <b> Enviando Respaldo de Base de datos Investment Capital 444 </b> " ,  function ($message) use ($fileZip) {
            $message->from('notificaciones@capital444.com');
            $message->to('invesment.capital.notification@gmail.com')->subject('Respaldo de base de datos SQL Server');
            $message->attach( "backup/$fileZip" , [ "as" => $fileZip , "mime" =>"application/zip" ]  );
        });



        $process = new Process("rm  backup/$file &&  rm backup/$fileZip");
        $process->run();
        if (!$process->isSuccessful()) {
               Mail::raw("No fue posible realizar eliminar archivos.", function ($message) {
                $message->from('notificaciones@capital444.com');
                $message->to('invesment.capital.notification@gmail.com')->subject('Error a eliminar archivos de respaldo');
            });
            throw new ProcessFailedException($process); 
        }

        $this->info('Proceso de respaldo y envio de correo completo');




    }
}
