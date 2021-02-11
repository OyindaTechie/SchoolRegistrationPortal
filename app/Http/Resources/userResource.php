<?php

namespace App\Http\Resources;

use App\Student;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

return [

            "studentscount" => Student::all()->count(),
            "name" => Student::find($this->id
            )->name,
            

        ];

        
    }
}
