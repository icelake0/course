<?php

namespace App\Exports;

use App\Course;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Get a collection of the course model for CSV conversion
 */
class CoursesExport implements FromCollection
{
    public function collection()
    {
        return Course::all();
    }
}
