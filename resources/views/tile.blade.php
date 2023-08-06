<x-dashboard-tile :position="$position">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div class="text-lg leading-none mb-2">
            {{ __('Plausible Analytics') }}
        </div>
        <div wire:poll.{{ $refreshIntervalInSeconds }}s class="grid auto-rows-auto grid-cols-4">
            @foreach($data as $key => $value)
                <div>
                    <div class="inline-block align-bottom">
                        <span class="font-medium">{{ \Illuminate\Support\Str::replace('_', '.', $key) }}</span>
                        @if(isset($value['realtime_visitors']))
                            <span class="block">
                                <svg
                                    class="inline-block w-1 mr-0.5 {{ ($value['realtime_visitors'] > 0) ? 'text-green-500' : 'text-gray-300' }} fill-current"
                                    viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><circle cx="8" cy="8" r="8"></circle></svg>
                                <span
                                    class="inline-block text-xs text-gray-600 dark:text-gray-700">{{ $value['realtime_visitors'] . ' ' . trans_choice('{1} current visitor|[*]current visitors', $value['realtime_visitors']) }}</span>
                            </span>
                        @endif
                    </div>
                    <div class="grid grid-rows-2 grid-cols-2 gap-2 leading-none">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ isset($value['bounce_rate']) ? $value['bounce_rate'] . '%' : 'N/A' }}
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ isset($value['pageviews']) ? $value['pageviews'] : 'N/A' }}
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ isset($value['visit_duration']) ? $value['visit_duration'] . 's' : 'N/A' }}
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ isset($value['visitors']) ? $value['visitors'] : 'N/A' }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-tile>
