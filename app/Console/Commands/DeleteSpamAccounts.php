<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class DeleteSpamAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'src:delete-spam-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Spam Accounts from Users';

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
            $filename = storage_path('app/deleteSpamRecords.csv');
            $file = fopen($filename, "r");

            $larr_CSVFile = array();
            while (!feof($file)) {
                array_push($larr_CSVFile, fgetcsv($file));
            } // while(! feof($file)){
            fclose($file);

            $ids = [];
            //transfer ids from csv to array
            foreach ($larr_CSVFile as $lch_Key => $larr_Value) {
                $ids[] =  $larr_Value[0];
            }

            //loop thru students using $ids array
            $students = Student::with('user')->whereIn('id', $ids)->get();

            //delete related user table of students
            $userIds = [];
            foreach ($students as $student) {
                if ($student->user) {
                    $userIds[] = $student->user->id;
                }
            }

            //delete selected students row
            Student::whereIn('id', $ids)->get();
            User::whereIn('id', $userIds)->get();
            //Student::whereIn('id', $ids)->delete();
            //User::whereIn('id', $userIds)->delete();

            $this->info('Spam records have been deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            $this->error('Failed to delete spam records: ' . $e->getMessage());
        }
    }
}
