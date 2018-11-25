<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\File;
use Storage;

class SendFileAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-file:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de archivos asset por ftp';

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
        

        $process = new Process('npm run prod');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process); 
        }

        $this->sendFile("public/fonts");
        $this->sendFile("public/css");
        $this->sendFile("public/js");
      
       
       $this->info("fin del programa");
    }


    private function sendFile($path){

        Storage::disk('sftp')->deleteDirectory($path);
        Storage::disk('sftp')->makeDirectory($path);

        foreach (File::allFiles($path) as $file) {
            $fileName = $file->getFileName();
            $path= $file->getPathName();
            $this->info("Enviando archivo $fileName");
            $content = $file->getContents();
            Storage::disk('sftp')->put($path,  $content );
            $this->info( "completado");
        }
    }
}
