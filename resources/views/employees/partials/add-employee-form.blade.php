<form method="post" action="{{ route('employees.store') }}" class="mt-6 space-y-6">
    @csrf

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="ssn" :value="__('SSN')" />
        <x-text-input id="ssn" name="ssn" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('ssn')" />
    </div>

    <div>
        <x-input-label for="phone" :value="__('Phone Number')" />
        <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
    </div>

    <div>
        <x-input-label for="firstname" :value="__('First Name')" />
        <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
    </div>

    <div>
        <x-input-label for="lastname" :value="__('Last Name')" />
        <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
    </div>

    <div>
        <x-input-label for="dob" :value="__('Date of Birth')" />
        <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('dob')" />
    </div>

    <div>
        <x-input-label for="salary" :value="__('Salary Monthly Before Tax')" />
        <x-text-input id="salary" name="salary" type="number" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('salary')" />
    </div>

    <div>
        <x-input-label for="employment_from" :value="__('Employment From')" />
        <x-text-input id="employment_from" name="employment_from" type="date" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('employment_from')" />
    </div>

    <div>
        <x-input-label for="employment_to" :value="__('Employment To')" />
        <x-text-input id="employment_to" name="employment_to" type="date" class="mt-1 block w-full" />
        <x-input-error class="mt-2" :messages="$errors->get('employment_to')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>
