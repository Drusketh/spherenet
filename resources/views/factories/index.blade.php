<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <div class="max-w-fit mx-auto p-4 sm:p-6 lg:p-8">
        <div class='admanage-container'>
            <div class='admanage-content'>
                @foreach ($factories as $factory)
                    @php
                        $land = explode(":", $factory->land);
                        $cost = explode(":", str_replace(",", ":", $factory->cost));
                        $input = explode(":", str_replace(",", ":", $factory->input));
                        $output = explode(":", str_replace(",", ":", $factory->output));
                    @endphp

                    <!-- <div class="icard resource-card min-w-72 max-w-72 max-h-md overflow-auto">
                        <div class="factory-name">{{ $factory->name  }}</div>
                        <input type="number" class="collection-input"min="1" value="1">
                        <div class="factory-section">
                            <div class="resource-label">LAND USAGE</div>
                            <div class="factory-value">
                                <img class="resource-icon" src="images/{{ $land[0] }}.webp"><p>{{ $land[1] }}</p>
                            </div>
                        </div>
                        <div class="factory-section">
                            <div class="resource-label">COSTS</div>
                            <div class="factory-value">
                                @foreach($cost as $c)
                                    @if(is_numeric($c) == false)
                                        <img class="resource-icon" src="images/{{ $c }}.webp" alt="{{ $c }}">
                                    @elseif(is_numeric($c) == true)
                                        <p>{{ $c }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="factory-section">
                            <div class="resource-label">INPUT</div>
                            <div class="factory-value">
                                @foreach($input as $c)
                                    @if(is_numeric($c) == false)
                                        <img class="resource-icon" src="images/{{ $c }}.webp" alt="{{ $c }}">
                                    @elseif(is_numeric($c) == true)
                                        <p>{{ $c }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="factory-section">
                            <div class="resource-label">OUTPUT</div>
                            <div class="factory-value">
                                @foreach($output as $c)
                                    @if(is_numeric($c) == false)
                                        <img class="resource-icon" src="images/{{ $c }}.webp" alt="{{ $c }}">
                                    @elseif(is_numeric($c) == true)
                                        <p>{{ $c }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <button class="create-button">BUILD</button>
                    </div> -->
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>