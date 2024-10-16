<?php
namespace App\Constants;

final class DatabaseEnumConstants{

    public const EVALUATION_TYPE_STRENGTH = "strength";
    public const EVALUATION_TYPE_WEAKNESS = "weakness";
    public const EVALUATION_SESSIONS = ['car session 5','car session 10','car session 15'];
    public const EVALUATION_BY_STUDENT = "student";
    public const EVALUATION_BY_TEACHER = "teacher";
    public const PAYMENT_TYPE_COURSE = "Course Payment";
    public const PAYMENT_TYPE_EXTRA = "Extra Charges Payment";
    public const PAYMENT_RECEIPT_SUBJECT = "Payment Receipt";
    public const STUDENT_STATUSES = ['enrolled','passed','cancelled','certificate given','moved'];
}