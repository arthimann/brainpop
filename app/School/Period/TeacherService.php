<?php
namespace App\School\Period;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Symfony\Component\HttpFoundation\JsonResponse;

class TeacherService implements PeriodContract
{
    public function store(array $details): object
    {
        $user = User::firstWhere('email', $details['email']);
        if (!$user) abort(JsonResponse::HTTP_FORBIDDEN, "User not found!");

        // Check if user not a student, otherwise decline request
        if (!!Student::firstWhere('user_id', $user->id))
            abort(JsonResponse::HTTP_FORBIDDEN, "The user cannot be set as a teacher as this user is a student!");

        return Teacher::create([
            'user_id' => $user->id,
        ]);
    }
}
