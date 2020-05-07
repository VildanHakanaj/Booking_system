<?php
namespace App\Traits;

use App\Http\Requests\UserRequest;
use App\Reason;
use App\User;
use Illuminate\Http\Request;

trait ParseRosterFile
{
    protected function parseRosterFile(Request $request, $filename)
    {
        $data = $this->getDataFromCSV($filename);
        $this->validateRosterData($request, $data);
    }

    protected function getDataFromCSV($filename)
    {
        $handler = fopen($filename, 'r');
        $count = 0;
        $users = [];
        $reason = '';

        while ($csvLine = fgetcsv($handler, 1000, ',')) {
            if ($count < 2) {
                $count++;
            } else {
                if (!isset($reason['reason'])) {
                    $reason = $csvLine[4];
                }
                array_push(
                    $users,
                    new User([
                        'stdn' => $csvLine[0],
                        'name' => $csvLine[1] . ' ' . $csvLine[2],
                        'email' => $csvLine[3],
                    ])
                );
            }
        }
        
        return ['users' => $users, 'reason' => $reason];
    }

    protected function getOrInsertReason($title)
    {
        return Reason::firstOrCreate(['title' => $title], ['expires_at' => Reason::setExpiry($title)]);
    }

    protected function validateRosterData(Request $request, $data)
    {
        foreach ($data['users'] as $user) {
            $validatedAttributes = $request->merge([
                'name' => $user->name,
                'email' => $user->email,
                'stdn' => $user->stdn

            ])->validate(
                [
                    'name' => 'required|min:2|max:255',
                    'email' => 'required|email',
                    'stdn' => 'required|min:7|max:255',
                ]
            );

            $reason = $this->getOrInsertReason($data['reason']);

            $addedUser = User::firstOrCreate(
                ['email' => $user->email],
                $validatedAttributes
            );

            $addedUser->reasons()->sync([Reason::getDefaultReason()->id, $reason->id]);
        }
    }
}
