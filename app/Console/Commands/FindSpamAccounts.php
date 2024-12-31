<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FindSpamAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'src:find-spam-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finding Spam Accounts from Users';

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
     * @return int
     */
    public function handle()
    {

        try {
            $fileName = 'studentSpamFilter.csv';
            $file = fopen(storage_path('app/' . $fileName), 'w');
            Student::with('user')->chunk(500, function ($students) use ($file) {
                foreach ($students as $student) {
                    $fullname = $student->last_name . ' ' . $student->first_name;
                    //$isValid = $this->isValidName($fullname);
                    $isValid = $this->isValidName($student->last_name);
                    fputcsv($file, [
                        $student->id,
                        $fullname,
                        $student->last_name,
                        $student->first_name,
                        $student->created_at,
                        $student->year_graduated,
                        $student->user->email,
                        $student->user->verified,
                        ($isValid ? "" : "SPAM")
                    ]);
                }
            });
            //$students = ["Aserit Mark David", "oLsCuwXiJS tKVxzTHIAJWr", "TRZMUIPrEdzvs KcQbORMZpqlh", "lNrekRUKd ZwzTRoGiK", "JINTALAN MARCO", "Amo Camille", "uolPbhtxyJW ZRuKilrwEcoFXWqh", "daKkwzgSBUuY gYERXLbCNfwyn", "VWHZsorvQa DTqmQZRvrPI", "VDZyXziWrpfKwUdb xzFGjCVNZda", "vmRYdrAonpLT zYmkMvdNeFBxT", "Soriano Vincent", "vbRLNyJxGfsq LKNRAQXe"];
            fclose($file);
            $this->info('Spam records have been dumped successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            $this->error('Failed to find spam records: ' . $e->getMessage());
        }
    }

    public function isValidName($inputName)
    {
        if (ctype_lower($inputName)) {
            return true;
        }

        if (ctype_upper($inputName)) {
            return true;
        }

        $pattern = '/^(?:[A-Z][a-z]*|[A-Z]+|[a-z]+)(?:[\s\W][A-Z][a-z]*|[\s\W][A-Z]+|[\s\W][a-z]+)*$/';

        if (preg_match($pattern, $inputName)) {
            return true;
        } else {
            return false;
        }
    }
}
