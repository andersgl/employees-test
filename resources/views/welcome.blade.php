<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex flex-1 justify-evenly">
                <a
                    href="{{ route('login') }}"
                >
                    <x-secondary-button>
                        {{ __('Log in') }}
                    </x-secondary-button>
                </a>
                <a
                    href="{{ route('register') }}"
                >
                    <x-secondary-button>
                        {{ __('Register') }}
                    </x-secondary-button>
                </a>
            </nav>
        </div>
    </div>
</x-guest-layout>
