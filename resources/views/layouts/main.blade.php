<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/0546d73a27.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('storage/assets/img/logo.png') }}" />
    <title>{{ $title }}</title>

</head>

<body class="bg-gray-200">
    <a href="{{ route('claim.index') }}">
        <h1 class="text-center text-2xl text-gray-800 font-semibold pt-4">
            DCN RSI KOTA MAGELANG
        </h1>
    </a>
    <div class="container mx-auto p-4 text-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-card.card bg="gray-50" class="order-1 md:order-first">
                <div class="grid grid-cols-1">
                    <div>
                        @if ($status == 1)
                            <x-alert.primary>
                                1. Klaim BPJS
                                <x-slot:addon>
                                    <x-icon.arrow-right />
                                </x-slot:addon>
                            </x-alert.primary>
                        @else
                            <x-alert.success>
                                1. Klaim BPJS
                                <x-slot:addon>
                                    <x-icon.check />
                                </x-slot:addon>
                            </x-alert.success>
                        @endif
                    </div>
                    <div>
                        @if ($status == 1)
                            <x-alert.secondary>
                                2. Rawat Jalan / Bayi
                            </x-alert.secondary>
                        @elseif ($status == 2)
                            <x-alert.primary>
                                2. Rawat Jalan / Bayi
                                <x-slot:addon>
                                    <x-icon.arrow-right />
                                </x-slot:addon>
                            </x-alert.primary>
                        @else
                            <x-alert.success>
                                2. Rawat Jalan / Bayi
                                <x-slot:addon>
                                    <x-icon.check />
                                </x-slot:addon>
                            </x-alert.success>
                        @endif
                    </div>
                    <div>
                        @if ($status == 3)
                            <x-alert.primary>
                                3. Selesai
                                <x-slot:addon>
                                    <x-icon.arrow-right />
                                </x-slot:addon>
                            </x-alert.primary>
                        @else
                            <x-alert.secondary>
                                3. Selesai
                            </x-alert.secondary>
                        @endif
                    </div>
                </div>
            </x-card.card>
            <x-card.card class="md:col-span-3">
                @yield('container')
            </x-card.card>
        </div>
    </div>
    @stack('script')
</body>

</html>
