<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "student-view",
            "student-create",
            "student-edit",
            "student-delete",
            "student-profile",
            "student-email",
            "student-message",
            "student-status",
            "student-exams-view",
            "student-exams-create",
            "student-exams-edit",
            "student-exams-delete",
            "student-documents-view",
            "student-documents-create",
            "student-documents-edit",
            "student-documents-delete",
            "teacher-view",
            "teacher-create",
            "teacher-edit",
            "teacher-delete",
            "rates-edit",
            "rates-view",
            "payment-view",
            "payment-unpaid-view",
            "payment-paid-view",
            "payment-search-student",
            "payment-total-students",
            "payment-details-view",
            "payment-pay-now",
            "payment-edit",
            "payment-delete",
            "payment-create",
            "payment-invoice",
            "payment-send-email",
            "charges-types-view",
            "charges-types-create",
            "charges-types-edit",
            "charges-types-delete",
            "extra-charges-view",
            "extra-charges-create",
            "extra-charges-edit",
            "extra-charges-delete",
            "exams-view",
            "exams-create",
            "exams-edit",
            "exams-delete",
            "exam-types-view",
            "exam-types-create",
            "exam-types-edit",
            "exam-types-delete",
            "session-evaluation-view",
            "session-evaluation-create",
            "session-evaluation-edit",
            "session-evaluation-delete",
            "session-evaluation-show",
            "session-evaluation-print",
            "evaluation-type-view",
            "evaluation-type-create",
            "evaluation-type-edit",
            "evaluation-type-delete",
            "class-modules-view",
            "class-modules-create",
            "class-modules-edit",
            "attendance-view",
            "attendance-create",
            "attendance-delete",
            "attendance-edit",
            "report-medical",
            "report-phaseone-certificate",
            "report-final-certificate",
            "report-contract",
            "report-exam",
            "report-exam-declaration",
            "report-attendance",
            "report-evaluation",
            "report-invoice",
            "import",
            "export",
            "notes-view",
            "notes-create",
            "notes-edit",
            "notes-delete",
            "notes-show",
            "backup-download",
            "backup-delete",
            "backup-view"
        ];
        foreach ($permissions as $key => $value) {
            if(!Permission::where("name",$value)->exists())
            {
                Permission::firstOrCreate(["guard_name" => "admin","name" => $value]);
            }
        }
        Role::firstOrCreate(["name" => "admin"]);
        Role::firstOrCreate(["name" => "user"]);
    }
}
