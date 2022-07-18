<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\Person;
use App\Models\ContactPerson;
use Illuminate\Http\Request;

class PersonController extends Controller
{
 
    public function create()
    {
        return inertia("Contact/Person/Form");
    }

    public function store(Person $request)
    {
        $contactPerson = ContactPerson::create($request->validated());
        return to_route('contact-general.edit', ['contact_general' => $contactPerson->general->id]);
    }

    public function edit(ContactPerson $contactPerson)
    {
        return inertia("Contact/Person/Form", compact('contactPerson'));
    }
  
    public function update(Person $request, ContactPerson $contactPerson)
    {
      $contactPerson->update($request->validated());
      return to_route('contact-general.edit', ['contact_general' => $contactPerson->general->id]);
    }

}
