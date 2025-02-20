<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table>
                    <thead>
                        <tr>
                            <th class="px-4 py-2">{{__("Name")}}</th>
                            <th class="px-4 py-2">{{__("Email")}}</th>
                            <th class="px-4 py-2">{{__("Phone")}}</th>
                            <th class="px-4 py-2">{{__("SSN")}}</th>
                            <th class="px-4 py-2">{{__("Date of Birth")}}</th>
                            <th class="px-4 py-2">{{__("Salary")}}</th>
                            <th class="px-4 py-2">{{__("Employment From")}}</th>
                            <th class="px-4 py-2">{{__("Employment To")}}</th>
                            <th class="px-4 py-2">{{__("Currently working")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td class="border px-4 py-2">{{ $employee->firstname }} {{ $employee->lastname }}</td>
                                <td class="border px-4 py-2">{{ $employee->email }}</td>
                                <td class="border px-4 py-2">{{ $employee->phone }}</td>
                                <td class="border px-4 py-2">{{ $employee->ssn }}</td>
                                <td class="border px-4 py-2">{{ $employee->dob }}</td>
                                <td class="border px-4 py-2">{{ $employee->salary }}</td>
                                <td class="border px-4 py-2">{{ $employee->employment_from }}</td>
                                <td class="border px-4 py-2">{{ $employee->employment_to }}</td>
                                <td class="border px-4 py-2">{{ !$employee->isFormerEmployee() ? __("Yes") : __("No") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
