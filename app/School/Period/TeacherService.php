<?php
namespace App\School\Period;

use App\Models\Period;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Symfony\Component\HttpFoundation\JsonResponse;

class TeacherService implements PeriodContract
{
    public function store(array $details): object
    {
        $user = User::findOrFail($details['id']);

        // Check if user not a student, otherwise decline request
        if (!!Student::firstWhere('user_id', $user->id))
            abort(JsonResponse::HTTP_FORBIDDEN, "The user cannot be set as a teacher as this user is a student!");

        return Teacher::create([
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
        Period::findOrFail($details['period']);
        Student::where('user_id', $details['id'])->delete();

        return Teacher::create([
            'user_id' => $details['id'],
            'period' => $details['period'],
        ]);
    }

}
