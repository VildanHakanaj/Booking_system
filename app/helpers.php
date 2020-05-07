<?php

/**
 *  parses the file and extracts all the data from the file
 *
 *
 * @return array
 *
 *TODO
 * [ ] Store the users in an array of arrays.
 * [ ] Only store one of the course nubers
 *      [ ] So it should look like this.
 *          return [ 'user' => [], 'Course' => 'Course_Name' ];
 */
function parseFile($filename)
{
    $handler = fopen($filename, 'r');

    //Count for the empty rows
    $count = 0;
    $users = [];
    $reason = [];
    //Parse the csv file.
    while ($csvLine = fgetcsv($handler, 1000, ',')) {
        if ($count < 2) {
            $count++;
        } else {
            if (!isset($reason['reason'])) {
                $reason = $csvLine[4];
            }
            array_push($users, [
                'stdn' => $csvLine[0],
                'name' => $csvLine[1] . ' ' . $csvLine[2],
                'email' => $csvLine[3],
            ]
            );
        }
    }

    return ['users' => $users, 'reason' => $reason];
}
