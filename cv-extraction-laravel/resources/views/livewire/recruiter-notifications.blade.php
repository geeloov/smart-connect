<div class="relative" 
    x-data="{ open: false, previousCount: 0 }" 
    x-init="
        previousCount = {{ $unreadCount }};
        $watch('{{ $unreadCount }}', value => {
            if (value > previousCount) {
                const toast = document.getElementById('recruiter-notification-toast');
                if (toast) {
                    toast.classList.remove('hidden');
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 5000);
                }
            }
            previousCount = value;
        });
    "
    wire:poll.15s>
    
    <!-- Notification Toast -->
    <div id="recruiter-notification-toast" class="fixed top-4 right-4 z-50 bg-[#B9FF66] text-dark p-4 rounded-lg shadow-lg hidden transform transition-transform duration-300 ease-in-out">
        <div class="flex items-center">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="font-medium">New job application received!</span>
        </div>
    </div>
    
    <!-- Notification Bell Icon -->
    <button @click="open = !open" class="relative rounded-full p-1 text-gray-600 hover:text-[#B9FF66] focus:outline-none">
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        
        <!-- Notification Badge -->
        @if($unreadCount > 0)
        <span class="absolute top-0 right-0 block h-4 w-4 rounded-full bg-[#B9FF66] text-xs text-dark font-bold flex items-center justify-center">
            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>
        @endif
    </button>

    <!-- Dropdown Panel -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100" 
         x-transition:enter-start="transform opacity-0 scale-95" 
         x-transition:enter-end="transform opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-75" 
         x-transition:leave-start="transform opacity-100 scale-100" 
         x-transition:leave-end="transform opacity-0 scale-95" 
         class="absolute right-0 mt-2 w-80 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
        <div class="p-4">
            <div class="flex items-center justify-between border-b border-gray-200 pb-2 mb-2">
                <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
                @if($unreadCount > 0)
                    <button wire:click="markAllAsRead" class="text-sm text-[#B9FF66] hover:text-[#a7e85c]">
                        Mark all as read
                    </button>
                @endif
            </div>

            <div class="divide-y divide-gray-200">
                @forelse($notifications as $notification)
                    <div class="py-3 {{ !$notification['is_read'] ? 'bg-[#f0ffdb]' : '' }}">
                        <a href="{{ $notification['link'] }}" wire:click.prevent="markAsRead({{ $notification['id'] }})" class="block hover:bg-gray-50">
                            <p class="text-sm font-medium text-gray-900">{{ $notification['message'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $notification['time'] }}</p>
                        </a>
                    </div>
                @empty
                    <div class="py-4 text-center text-sm text-gray-500">
                        No new notifications
                    </div>
                @endforelse
            </div>

            <div class="mt-2 pt-2 border-t border-gray-200">
                <a href="{{ route('recruiter.applications.index') }}" class="block text-center text-sm font-medium text-[#B9FF66] hover:text-[#a7e85c]">
                    View all applications
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('showNotification', (data) => {
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    new Notification(data.title, {
                        body: data.body,
                        icon: '/images/logo.png' // Add your logo path
                    });
                } else if (Notification.permission !== 'denied') {
                    Notification.requestPermission().then(permission => {
                        if (permission === 'granted') {
                            new Notification(data.title, {
                                body: data.body,
                                icon: '/images/logo.png' // Add your logo path
                            });
                        }
                    });
                }
            }
        });
    });
</script>
@endpush 