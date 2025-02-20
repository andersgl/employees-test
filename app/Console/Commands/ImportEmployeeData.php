<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Employee;

class ImportEmployeeData extends Command
{
    protected $signature = 'import:employee-data {file : Path to JSON file}';
    protected $description = 'Import employee data from JSON file';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $data = json_decode(file_get_contents($filePath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON file');
            return 1;
        }

        $this->info('Processing data...');

        // Group entries by email and get the last entry for each
        $entries = collect($data)
            ->groupBy('email')
            ->map(function ($entries) {
                $lastEntry = $entries->last();
                // Log information about dropped entries if there were multiple
                if (count($entries) > 1) {
                    $this->warn(sprintf(
                        'Multiple entries found for email %s. Using latest entry (ID: %s), dropping %d older entries.',
                        $lastEntry['email'],
                        $lastEntry['id'],
                        count($entries) - 1
                    ));
                }
                return $lastEntry;
            })
            ->filter(function ($entry) {
                // Filter out entries with invalid ID format
                if (!is_numeric($entry['id']) || !(int) $entry['id']) {
                    $this->warn("Skipping entry with invalid ID format: {$entry['id']}");
                    return false;
                }
                return true;
            })
            ->values();

        $this->info("Found {$entries->count()} unique employees after deduplication");

        DB::beginTransaction();

        try {
            foreach ($entries as $entry) {
                $employeeData = [
                    'original_id' => $entry['id'],
                    'email' => $entry['email'],
                    'ssn' => (string)$entry['ssn'],
                    'phone' => $entry['phone'],
                    'firstname' => $entry['firstname'],
                    'lastname' => $entry['lastname'],
                    'dob' => $this->parseDate($entry['dob']),
                    'salary' => (int)$entry['salary'],
                    'employment_from' => $this->parseDate($entry['employmentfrom']),
                    'employment_to' => $this->parseDate($entry['employmentto']),
                ];

                $validator = Validator::make($employeeData, Employee::getCreationRules());

                if ($validator->fails()) {
                    $this->warn("Validation failed for ID {$entry['id']}: " . $validator->errors()->first());
                    continue;
                }

                try {
                    DB::table('employees')->insert($employeeData);
                } catch (\Illuminate\Database\QueryException $e) {
                    $this->warn("Failed to insert entry with ID {$entry['id']}");
                    throw $e;
                }
            }

            DB::commit();

            $this->info("\nImport completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Import failed: " . $e->getMessage());
            return 1;
        }

        return 0;
    }

    private function parseDate($date): ?string
    {
        if (empty($date) || $date === 'null') {
            return null;
        }

        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
