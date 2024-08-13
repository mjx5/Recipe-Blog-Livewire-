@props(['name'])

<div
    x-data="{ open: false, name: '{{ $name }}' }"
    x-on:open-modal.window="open = ($event.detail.name === name)"
    x-on:close-modal.window="open = false"
    x-on:keydown.escape.window="open = false"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center z-50"
    style="display: none;"
>
    <!-- Modal Background Overlay -->
    <div
        class="absolute inset-0 bg-gray-500 opacity-75"
        @click="open = false">
    </div>

    <!-- Modal Container -->
    <div
        class="relative z-10 w-full max-w-3xl p-6 mx-4 bg-gray-800 rounded-lg"
        style="max-height: 80vh;"
    >
        <div
            class="overflow-y-auto text-white"
            style="max-height: calc(80vh - 3rem);"
        >
            <!-- Main content -->
            {{ $body }}

            <!-- Modal Actions -->
            <div class="mt-4 flex justify-end space-x-2">
                <!-- Cancel Button -->
                <button
                    @click="$dispatch('close-modal')"
                    class="px-4 py-2 bg-white text-gray-800 rounded hover:bg-gray-200"
                >
                    Cancel
                </button>
                <!-- Logout Button -->
                <button
                    wire:click="logout"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                    @click="$dispatch('close-modal')"
                >
                    Logout
                </button>
            </div>
        </div>
    </div>
</div>
