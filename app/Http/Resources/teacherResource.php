<?php

namespace App\Http\Resources;

use App\Teacher;
use Illuminate\Http\Resources\Json\JsonResource;

class teacherResource extends JsonResource
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
        "id"=> $this->id,
        "studentname"=> $this->name,
       "studentcourse"=> $this->course,
       "teacher_details"=> Teacher::find($this->teacher_id)

       ] ; 

       
    }
}
