
<!-- resources/views/components/page-layout.blade.php -->
<div class="bg-gray-100 px-6 py-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>

    <div>
        <!-- Render actions only if the actions slot is provided -->
        @isset($actions)
            {{ $actions }}
        @endisset
    </div>
</div>

<div class=" mx-auto p-6 bg-white rounded-2xl shadow-xl text-gray-800 space-y-10 text-[15px] leading-relaxed">
    {{ $slot }}
</div>
