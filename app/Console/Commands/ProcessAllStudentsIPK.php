<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Siswa;
use App\Http\Controllers\ipkcountController;

class ProcessAllStudentsIPK extends Command
{
    protected $signature = 'process:students-ipk';
    protected $description = 'Process IPK for all students and save it to ipk_records table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new ipkcountController();

        $siswas = Siswa::all();  // Mengambil semua data siswa

        foreach ($siswas as $siswa) {
            $controller->calculateAndSaveIPK($siswa->id);
            $this->info("Processed IPK for student ID: {$siswa->id}");
        }

        $this->info('All students IPK processed successfully.');
    }
}

