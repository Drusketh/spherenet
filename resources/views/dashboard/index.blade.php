<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach ($ufac as $factory)
        @php
            $data = explode(":", str_replace(',', ':', str_replace(['[', ']', '{', '}', '"'], '', $factory)));
            $name = [];
            $count = [];

            foreach ($data as $u => $v) {
                if ($u % 2 == 0) {
                    $name[] = $v;
                }
                else {
                    $count[] = $v;
                    $usrfac[$name[$u/2-0.5]] = $count[$u/2-0.5];
                }
            }
            
        @endphp
    @endforeach

    @php
        $tland = [];
        $tcost = [];
        $tin = [];
        $tout = [];
    @endphp
    
    <div class="flex flex-row justify-center">
        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg max-h-[75vh] overflow-auto">
                    <div class="p-6 text-gray-900">
                        @foreach ($factories as $k => $factory)
                            @php
                                $land = explode(":", str_replace(";", "", $factory->land));                            
                                $cost = explode(":", str_replace(",", ":", $factory->cost));
                                $input = explode(":", str_replace(",", ":", $factory->input));
                                $output = explode(":", str_replace(",", ":", $factory->output));
                            @endphp
                            
                            
                            <div class="icard resource-card min-w-72 max-w-72 max-h-md overflow-auto bg-zinc-100">
                                <div class="flex items-center justify-between align-middle">
                                    <div class="factory-name flex-auto w-14">{{ $factory->name  }}</div>
                                    <input data-count="{{ $name[$k] }}" type="number" class="collection-input flex-none w-1/4" min="0" value="{{ $count[$k] }}">
                                    <button data-collapse-target="collapse{{ $factory->name }}" class="flex-none w-1/6 float-right rounded-md bg-slate-800 py-2 px-2 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"><path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" /></svg></button>
                                </div>
                                

                                <div data-collapse="collapse{{ $factory->name }}" class="block h-0 w-full basis-full overflow-hidden transition-all duration-300 ease-in-out">
                                    <div class="factory-section">
                                        <div class="resource-label">LAND USAGE</div>
                                        <div class="factory-value align-middle">
                                            <img class="resource-icon" src="images/{{ $land[0] }}.webp"><p>{{ (int)$land[1]*$count[$k] }}</p>
                                        </div> 
                                    </div>
                                    <div class="factory-section">
                                        <div class="resource-label">COSTS</div>
                                        <div class="factory-value">
                                            @foreach($cost as $c)
                                                @if(is_numeric($c) == false)
                                                    <img class="resource-icon" src="images/{{ $c }}.webp" alt="{{ $c }}">
                                                @elseif(is_numeric($c) == true)
                                                    <p>{{ $c*$count[$k] }}</p>
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
                                                    <p>{{ $c*$count[$k]*24 }}</p>
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
                                                    <p>{{ $c*$count[$k]*24 }}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <input hidden type="text" name="counts" value="{{ json_encode($data, true); }}">
                <button class="create-button block margin-auto justify-center">UPDATE</button>
            </form>
        </div>

        <div class="py-12">
            <div class="max-w- mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg max-h-[75vh] overflow-auto">
                    <div class="p-6 text-gray-900">
                        @php
                            $tland = combineAssoc($factories, 0, 'land', $usrfac);
                            $tcost = combineAssoc($factories, 0, 'cost', $usrfac);
                            $tinput = combineAssoc($factories, 0, 'input', $usrfac);
                            $toutput = combineAssoc($factories, 0, 'output', $usrfac);
                        @endphp

                        <div class="flex flex-row"> 
                            <ul>
                                <div class="icard h-screen resource-card min-w-72">
                                    <div class="icard-header">
                                        <span class="icard-name">FACTORY TOTAL COST</span>
                                    </div>
                                    <div class="list h-5/6 overflow-scroll">
                                        @foreach ($tcost[0] as $k => $v)
                                            <div class="flex justify-between items-center border-b-2">
                                                <img src="{{ url('images/' . $tcost[1][$k] . '.webp') }}" class="resource-icon" alt=""/>
                                                <p> {{$tcost[0][$k]}} </p>
                                            </div>
                                        @endforeach
                                    <div>
                                </div>
                            </ul>
                            <ul>
                                <div class="icard h-screen resource-card min-w-72">
                                    <div class="icard-header">
                                        <span class="icard-name">LAND TOTALS</span>
                                    </div>
                                    <div class="list h-5/6 overflow-scroll">
                                        @foreach ($tland[0] as $k => $v)
                                            <div class="flex justify-between items-center border-b-2">
                                                <img src="{{ url('images/' . $tland[1][$k] . '.webp') }}" class="resource-icon" alt=""/>
                                                <p> {{$tland[0][$k]}} </p>
                                            </div>
                                        @endforeach
                                    <div>
                                </div>
                            </ul>
                            <ul>
                                <div class="icard h-screen resource-card min-w-72">
                                    <div class="icard-header">
                                        <span class="icard-name">USAGE TOTALS</span>
                                    </div>
                                    <div class="list h-5/6 overflow-scroll">
                                        @foreach ($tinput[0] as $k => $v)
                                            <div class="flex justify-between items-center border-b-2">
                                                <img src="{{ url('images/' . $tinput[1][$k] . '.webp') }}" class="resource-icon" alt=""/>
                                                <p> {{$tinput[0][$k]}} </p>
                                            </div>
                                        @endforeach
                                    <div>
                                </div>
                            </ul>
                            <ul>
                                <div class="icard h-screen resource-card min-w-72">
                                    <div class="icard-header">
                                        <span class="icard-name">PRODUCTION TOTALS</span>
                                    </div>
                                    <div class="list h-5/6 overflow-scroll">
                                        @foreach ($toutput[0] as $k => $v)
                                            <div class="flex justify-between items-center border-b-2">
                                                <img src="{{ url('images/' . $toutput[1][$k] . '.webp') }}" class="resource-icon" alt=""/>
                                                @php 
                                                    if (array_key_exists($k, $tinput[0])) {
                                                        if ($v > $tinput[0][$k]) {
                                                            echo('<p class="text-green-500">'. $toutput[0][$k] .'</p>');
                                                        } else {
                                                            echo('<p class="text-red-500">'. $toutput[0][$k] .'</p>');
                                                        }
                                                    } else {
                                                        echo('<p>'. $toutput[0][$k] .'</p>');
                                                    }
                                                @endphp
                                                
                                            </div>
                                        @endforeach
                                    <div>
                                </div>
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>