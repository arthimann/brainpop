<?php

namespace App\School\Period;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Symfony\Component\HttpFoundation\JsonResponse;

class StudentService implements PeriodContract
{
    public function store(array $details): object
    {
        $user = User::findOrFail($details['id']);

        // Check if user not a teacher, otherwise decline request
        if (!!Teacher::firstWhere('user_id', $user->id))
            abort(JsonResponse::HTTP_FORBIDDEN, "The user cannot be set as a student as this user is a teacher!");

        return Student::create([
            'user_id' => $user->id,
        ]);
    }

    /**
     * Re-assign the user
     * @param array $details
     * @return object
     */
    public function reassign(array $details): object
    {
        User::findOrFail($details['id']);
        Teacher::where('user_id', $details['id'])->delete();
        return Student::create([
            'user_id' => $details['id'],
        ]);
    }
}
