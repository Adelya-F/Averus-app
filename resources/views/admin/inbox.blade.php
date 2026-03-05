<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Notifikasi - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#faf6ef] min-h-screen p-6">

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="p-2 bg-white rounded-xl shadow-sm border border-gray-200 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Inbox Notifikasi</h1>
            </div>
            <div class="text-right">
                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-md shadow-blue-200">
                    {{ $unreadCount ?? 0 }} Pesan Baru
                </span>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($messages as $msg)
                <div class="flex items-center justify-between p-5 rounded-2xl border transition-all duration-300 {{ $msg->is_read ? 'bg-white border-gray-100 opacity-80' : 'bg-white border-blue-300 shadow-lg shadow-blue-50 ring-1 ring-blue-100' }}">
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-10 h-10 flex-shrink-0 rounded-full flex items-center justify-center {{ $msg->is_read ? 'bg-gray-100 text-gray-400' : 'bg-blue-600 text-white shadow-md shadow-blue-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        
                        <div>
                            <h3 class="font-bold {{ $msg->is_read ? 'text-gray-600' : 'text-gray-800' }}">
                                {{ $msg->title }}
                                @if(!$msg->is_read)
                                    <span class="ml-2 inline-block w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                @endif
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 italic leading-relaxed">
                                "{{ $msg->message }}"
                            </p>
                            <div class="flex items-center gap-2 mt-3 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $msg->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin.inbox.read', $msg->id) }}" class="flex-shrink-0 ml-4 bg-gray-800 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all transform hover:scale-105 active:scale-95 shadow-sm">
                        CEK DETAIL →
                    </a>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-16 text-center border-2 border-dashed border-gray-200">
                    <div class="text-6xl mb-4">🧘‍♂️</div>
                    <h3 class="text-lg font-bold text-gray-800">Inbox Kosong</h3>
                    <p class="text-gray-400 text-sm">Semua pendaftaran sudah kamu proses. Kerja bagus!</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>