@if ($value !== null)
    <div class="mb-2">
        <div class="font-bold">{{ $label }}:</div>
        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
            <div class="bg-blue-600 h-4 rounded-full text-xs font-bold text-white text-center" style="width: {{ $value }}%">
                {{ $value }}%
            </div>

        </div>
    </div>
@endif


