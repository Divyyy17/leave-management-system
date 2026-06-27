<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                <!-- Dashboard -->
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>

                <!-- Employee Links -->
                @if(auth()->user()->role === 'employee')

                    <x-nav-link href="/leave/apply">
                        Apply Leave
                    </x-nav-link>

                    <x-nav-link href="/my-leaves">
                        My Leaves
                    </x-nav-link>

                @endif

                <!-- Manager Links -->
                @if(auth()->user()->role === 'manager')

                    <x-nav-link href="/manager/leaves">
                        Manage Leaves
                    </x-nav-link>

                @endif

            </div>

            <!-- User Info + Logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <div class="text-gray-700 mr-4">
                    {{ auth()->user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-600 hover:text-gray-900">
                        Logout
                    </button>
                </form>

            </div>

            <!-- Mobile Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="p-2 text-gray-600">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden px-4 pb-4 space-y-2">

        <a href="/dashboard">Dashboard</a>

        @if(auth()->user()->role === 'employee')
            <a href="/leave/apply">Apply Leave</a>
            <a href="/my-leaves">My Leaves</a>
        @endif

        @if(auth()->user()->role === 'manager')
            <a href="/manager/leaves">Manage Leaves</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-left w-full">
                Logout
            </button>
        </form>

    </div>

</nav>