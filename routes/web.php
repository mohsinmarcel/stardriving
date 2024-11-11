<?php

use App\Contracts\GoogleCalendarContract;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ChargesTypesController;
use App\Http\Controllers\ClassModulesController;
use App\Http\Controllers\ExamQuestionsController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\ExpenceController;
use App\Http\Controllers\TransectionsController;
use App\Http\Controllers\ExamTypesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UserPermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\StudentExtraChargesController;
use App\Http\Controllers\StudentPaymentsController;
use App\Http\Controllers\StudentSessionEvaluationController;
use App\Http\Controllers\EvaluationTypesController;
use App\Http\Controllers\ImportExportStudentsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SmsAndMailingController;
use App\Http\Controllers\StudentAttendancesController;
use App\Http\Controllers\StudentDocumentsController;
use App\Http\Controllers\StudentNotesController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\ExtraStudentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\QuartersController;
use App\Mail\PaymentReciept;
use Illuminate\Support\Facades\Route;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/checking", function(){
    return Artisan::call("db:seed");
});
Route::get("/mail-temp", function(){
    return view("email.payment-receipt");//Artisan::call("db:seed");
});

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('login.forgetPassword');
Route::post('/forget-password', [AuthController::class, 'forgetPasswordPost'])->name('login.forgetPassword.post');

Route::get('/change-password/{token}', [AuthController::class, 'changePassword2']);
Route::post('/change-password/{token}', [AuthController::class, 'changePassword2Post'])->name('login.changePassword.post');

Route::middleware('auth:admin')->group(function () {
    Route::get('/database-backup', [BackupController::class, 'view'])->name('database-backup');
    Route::post('/database-backup', [BackupController::class, 'deleteFile'])->name('database-backup.delete');
    Route::get('/database-backup/daily', [BackupController::class, 'daily'])->name('database-backup.daily');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/api/upcoming-exams', [HomeController::class, 'getUpcomingExams']);
    Route::post('/change-password',[AuthController::class, 'changePassword'])->name('admin.change.password');
    Route::post('/students/change-status',[StudentsController::class,'studentStatuschange'])->name('students.change-status');
    Route::get('/students/showById/{id}', [StudentsController::class, 'showById'])->name('students.showById');
    Route::get('/students/blukQrCodeImageDownload/', [StudentsController::class, 'blukQrCodeImageDownload'])->name('students.qrCodeDownload');
    Route::resource("students",StudentsController::class);

    Route::post('/extrastudents/change-status',[ExtraStudentController::class,'studentStatuschange'])->name('extrastudents.change-status');
    Route::get('/extrastudents/showById/{id}', [ExtraStudentController::class, 'showById'])->name('extrastudents.showById');
    Route::get('/extrastudents/blukQrCodeImageDownload/', [ExtraStudentController::class, 'blukQrCodeImageDownload'])->name('extrastudents.qrCodeDownload');
    Route::resource("extrastudents",ExtraStudentController::class);

    Route::resource("teachers",TeachersController::class);
    Route::resource("users",UsersController::class);
    Route::resource("rates",RatesController::class);
    Route::get('/rates/edits/{year}',[RatesController::class,'ratesEdits'])->name('rates.edits');
    Route::get('/rates/show/{classTypeId}',[RatesController::class,'showRates'])->name('rates.show');
    Route::get('/rates/get/{classTypeId}',[RatesController::class,'getRates'])->name('rates.get');
    Route::post('/rates/update/process',[RatesController::class,'ratesUpdateProcess'])->name('rates.update.process');
    Route::resource("student-payments",StudentPaymentsController::class);
    Route::resource("charges-types",ChargesTypesController::class);
    Route::resource("student-notes",StudentNotesController::class);
    Route::resource("class-modules",ClassModulesController::class);

    Route::resource("exams",ExamsController::class);
    Route::resource("transections",TransectionsController::class);
    Route::resource("exam-types",ExamTypesController::class);
    Route::resource("quarters",QuartersController::class);
    Route::resource("supplier",SupplierController::class);
    Route::resource("student-session-evaluation",StudentSessionEvaluationController::class);
    Route::resource("evaluation-types",EvaluationTypesController::class);
    Route::resource("student-attendance",StudentAttendancesController::class);
    Route::resource("student-document",StudentDocumentsController::class);
    // Route::resource("expence",ExpenceController::class);

    Route::get('/exam-questions/{id}', [ExamQuestionsController::class, 'index'])->name('exam-questions.index');
    Route::post('/exam-questions/{id}', [ExamQuestionsController::class, 'store'])->name('exam-questions.store');
    Route::get('/expence/{id}', [ExpenceController::class, 'index'])->name('expence.index');
    Route::get('/expence/{id}/view', [ExpenceController::class, 'view'])->name('expence.view');
    Route::post('/expence/{id}', [ExpenceController::class, 'store'])->name('expence.store');
    Route::delete('/expence/{id}/{additionalId}', [ExpenceController::class, 'destroy'])->name('expence.destroy');
    Route::post('/expence/{id}/update-income', [ExpenceController::class, 'updateIncome'])->name('expence.updateIncome');

    Route::get('/permission/user/{id}', [UserPermissionsController::class, 'permissions'])->name('users.permission');
    Route::post('/permission/user', [UserPermissionsController::class, 'permissionsUpdate'])->name('users.permission.update');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/store',[SettingsController::class, 'store'])->name('settings.store');
    Route::post('settings/username',[SettingsController::class, 'changeUsername'])->name('settings.username');
    Route::post('settings/password',[SettingsController::class, 'changePassword'])->name('settings.password');
    Route::post('settings/databaseReset',[SettingsController::class, 'databaseReset'])->name('settings.databaseReset');

    // routes/web.php

    Route::get('/settings/locations', [SettingsController::class, 'showLocations'])->name('settings.locations');
    Route::post('/settings/locations', [SettingsController::class, 'storeLocation'])->name('settings.storeLocation');
    Route::get('/settings/locations/{id}/edit', [SettingsController::class, 'editLocation'])->name('settings.editLocation');
    Route::put('/settings/locations/{id}', [SettingsController::class, 'updateLocation'])->name('settings.updateLocation');
    Route::delete('/settings/locations/{id}', [SettingsController::class, 'destroyLocation'])->name('settings.destroyLocation');

    Route::get('/settings/template', [SettingsController::class, 'showtemplate'])->name('settings.template');
    Route::post('/settings/template', [SettingsController::class, 'storetemplate'])->name('settings.storetemplate');
    Route::get('/settings/template/{id}/edit', [SettingsController::class, 'edittemplate'])->name('settings.edittemplate');
    Route::put('/settings/template/{id}', [SettingsController::class, 'updatetemplate'])->name('settings.updatetemplate');
    Route::delete('/settings/template/{id}', [SettingsController::class, 'destroytemplate'])->name('settings.destroytemplate');


    Route::get('/ajax/studentPayments/{id}', [StudentPaymentsController::class, 'studentPayment'])->name('ajax.student.payments');
    Route::post('payment/send-receipt-email', [StudentPaymentsController::class, 'sendReceiptEmail'])->name('student-payments.send-receipt-email');

    //Student Exam Controller
    Route::get('/student-exam/index/{id}', [StudentExamController::class, 'index'])->name('student-exams.index');
    Route::post('/student-exam/store', [StudentExamController::class, 'store'])->name('student-exams.store');
    Route::get('/student-exam/exam-list/{id}/{student_id}', [StudentExamController::class, 'examList'])->name('student-exams.exam-list');
    Route::get('/student-exam/exam-fetch/{id}', [StudentExamController::class, 'examFetch'])->name('student-exams.exam-fetch');
    Route::get('/student-exam/show/{id}', [StudentExamController::class, 'show'])->name('student-exams.show');
    Route::get('/student-exam/{id}/edit', [StudentExamController::class, 'edit'])->name('student-exams.edit');
    Route::put('/student-exam-update', [StudentExamController::class, 'update'])->name('student-exams.update');
    Route::delete('/student-exam/{id}', [StudentExamController::class, 'destroy'])->name('student-exams.destroy');

    Route::post('/student-notes/{id}',[StudentNotesController::class,'studentNoteCreate'])->name('student.note');
    Route::post('/student-documents/{id}',[StudentDocumentsController::class,'studentDocumentsCreate'])->name('student.document');

    Route::get('/student-extra-charges',[StudentExtraChargesController::class,'getExtraChargesAmount'])->name('get.extra.charges.amount');
    Route::post('/student-extra-charges/{id}',[StudentExtraChargesController::class,'studentExtraCharges'])->name('student.extra.charges');
    Route::post('/student-extra-charges-store',[StudentExtraChargesController::class,'store'])->name('student.extra.charges.store');
    Route::post('/student-extra-charges/delete/{id}',[StudentExtraChargesController::class,'destroy'])->name('student.extra.charges.destroy');
    Route::get('/student-extra-charges-edit/{id}',[StudentExtraChargesController::class,'edit'])->name('student.extra.charges.edit');
    Route::put('/student-extra-charges-update',[StudentExtraChargesController::class,'update'])->name('student.extra.charges.update');
    Route::get('activity-logs',[HomeController::class, 'activityLogsView'])->name('activity-logs-view');
    Route::get('attendance/create/{id}',[StudentAttendancesController::class, 'createAttendance'])->name('student.attendance.create');
    // Route::post('/student-extra-charges/{id}',[StudentExtraChargesController::class,'studentExtraCharges'])->name('student.extra.charges');

    // Route::get('/charges-types',[ChargesTypesController::class,'addChargesType'])->name('charges.types');
    // Route::post('/charges-types-store',[ChargesTypesController::class,'storeChargesTypes'])->name('charges.types.store');
    // Route::get('/change-charges-types/{id}',[ChargesTypesController::class,'edit'])->name('charges.types.edit');
    // Route::post('/charges-types',[ChargesTypesController::class,'update'])->name('charges.types.update');

    //Reports Routes
    Route::get('/reports/create',[ReportsController::class,'create'])->name('reports.create');
    Route::post('/reports/store',[ReportsController::class,'store'])->name('reports.store');
    Route::get('/reports/session-evaluation/{id}',[ReportsController::class,'sessionEvaluation'])->name('reports.session-evaluation');
    Route::get('/reports/student-contract/{id}',[ReportsController::class,'studentContract'])->name('reports.student-contract');
    Route::get('/reports/student-exam/{id}',[ReportsController::class,'studentExam'])->name('reports.student-exam');
    Route::get('/reports/exam-declaration/{id}',[ReportsController::class,'examDeclaration'])->name('reports.exam-declaration');
    Route::get('/reports/student-attendance/{id}',[ReportsController::class,'studentAttendance'])->name('reports.student-attendance');
    Route::get('/reports/phase-one-certificate/{id}',[ReportsController::class,'phaseOneCertificate'])->name('reports.phase-one-certificate');
    Route::get('/reports/student-medical/{id}',[ReportsController::class,'studentMedical'])->name('reports.student-medical');
    Route::get('/reports/invoice/{id}',[ReportsController::class,'invoice'])->name('reports.invoice');
    Route::get('/reports/final-certificate/{id}',[ReportsController::class,'finalCertificate'])->name('reports.final-certificate');
    Route::get('/reports/get-student-exams/{id}',[ReportsController::class,'getStudentExams'])->name('reports.get-student-exams');
    Route::get('/reports/get-student-evaluation/{id}',[ReportsController::class,'getStudentEvaluation'])->name('reports.get-student-evaluation');

    Route::get('student-evaluation/model-create',[StudentSessionEvaluationController::class,'createModel'])->name('student-evaluation.model-create');
    Route::post('student-evaluation/storeModel',[StudentSessionEvaluationController::class,'storeModel'])->name('student-evaluation.model-store');
    Route::get('student-evaluation/model-edit/{id}',[StudentSessionEvaluationController::class,'editModel'])->name('student-evaluation.model-edit');
    Route::post('student-evaluation/model-update',[StudentSessionEvaluationController::class,'updateModel'])->name('student-evaluation.model-update');

    Route::get('sms-mailing/mail/{id}',[SmsAndMailingController::class,'mail'])->name('sms-mailing.mail');
    Route::post('sms-mailing/mail',[SmsAndMailingController::class,'mailPost'])->name('sms-mailing.mail.post');
    Route::get('sms-mailing/sms/{id}',[SmsAndMailingController::class,'sms'])->name('sms-mailing.sms');
    Route::post('sms-mailing/sms',[SmsAndMailingController::class,'smsPost'])->name('sms-mailing.sms.post');

    Route::get('import-export/import',[ImportExportStudentsController::class,'import'])->name('import-export.import');
    Route::post('import-export/import',[ImportExportStudentsController::class,'importPost'])->name('import-export.importpost');

    Route::get('import-export/export',[ImportExportStudentsController::class,'exportStudents'])->name('import-export.export');

    Route::get('fullcalender', [FullCalenderController::class, 'index']);
});
