@if (session()->has('success') || session()->has('error'))
    <div 
        x-data="{ show: true, type: '{{ session()->has('success') ? 'success' : 'error' }}', message: '{{ session('success') ?? session('error') }}' }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 rounded-lg shadow-lg border-l-4"
        :class="{
            'bg-green-100 text-green-800 border-green-500': type === 'success',
            'bg-red-100 text-red-800 border-red-500': type === 'error'
        }"
        role="alert"
    >
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full"
             :class="{
                 'text-green-500 bg-green-200': type === 'success',
                 'text-red-500 bg-red-200': type === 'error'
             }">
            <template x-if="type === 'success'">
                <i class="fas fa-check"></i>
            </template>
            <template x-if="type === 'error'">
                <i class="fas fa-exclamation"></i>
            </template>
        </div>
        <div class="ml-3 text-sm font-medium" x-text="message"></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-gray-900 bg-transparent hover:bg-gray-200" @click="show = false" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif
