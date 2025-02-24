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
    
    <div class="flex flex-row justify-center max-h-1 overflow-none">
        <div class="flex w-[25%] max-h-[20%] h-[20%] py-12">
            <div class="h-[25%] w-[100%] mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white shadow-sm sm:rounded-lg max-h-[75vh] overflow-auto">
                    <form id="pop" action="{{ route('user.pop') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="max-h-6 max-w-44 place-content-center rounded-lg factory-name overflow-auto">Population</div>
                        <input type="number" name="pop" id="pop" class="h-10 w-24 place-content-center rounded-lg bg-zinc-200" min="0" value="{{ $pop }}">
                    </form>
                    
                    
                    <div class="max-h-6 max-w-44 place-content-center rounded-lg factory-name overflow-auto">Continent</div>
                    <input type="text" class="h-10 w-24 place-content-center rounded-lg bg-zinc-200">

                    <div class="max-h-6 max-w-44 place-content-center rounded-lg factory-name overflow-auto">EXPAND BORDERS</div>
                    <ul>
                        <li>
                            <p> money: {{ $pop/10 }} </p>
                        </li>
                        <li>
                            <p> food: {{ $pop/50 }} </p>
                        </li>
                        <li>
                            <p> bms: {{ $pop/50 }} </p>
                        </li>
                        <li>
                            <p> cgs: {{ $pop/200 }} </p>
                        </li>
                    </ul>

                    </br></br>

                    <div class="max-h-6 place-content-center rounded-lg factory-name overflow-auto">POPULATION GROWTH CALCULATOR</div>
                    <input type="text" id="goalpop" class="h-10 w-24 place-content-center rounded-lg bg-zinc-200">

                    <div> 
                        It will take 
                        <span id="goalpopturns"> ? </span> turns, or 
                        <span id="goalpopdays"> ? </span> in order to reach 
                        <span id="goalpopview"> ? </span> population. 
                    </div>
                </div>
            </div>
        </div>

        <div class="flex w-[60%] py-12 col-start-1 flex flex-col min-h-screen gap-4">
            <div class="w-[100%] max-h-[20%] mx-auto sm:px-2 lg:px-8 flex flex-1">
                <div class="bg-white shadow-sm sm:rounded-lg w-[100%] overflow-auto">
                    <div class="p-2 text-gray-900 col-start-1 row-start-1 flex flex-wrap gap-2">
                        @foreach ($factories as $k => $factory)
                            @php
                                $land = explode(":", str_replace(";", "", $factory->land));
                                $cost = explode(":", str_replace(",", ":", $factory->cost));
                                $input = explode(":", str_replace(",", ":", $factory->input));
                                $output = explode(":", str_replace(",", ":", $factory->output));
                            @endphp
                            
                            <div class="flex min-w-44 max-w-64 flex-1">
                                <div class="grid grid-flow-col grid-rows-2 grid-cols-4 m-2 bg-zinc-100 rounded-lg p-2">
                                    <div class="max-h-6 max-w-44 place-content-center rounded-lg factory-name col-span-6 overflow-auto">{{ $factory->name }}</div>
                                    <input data-count="{{ $name[$k] }}" type="number" class="h-10 w-24 place-content-center rounded-lg bg-zinc-200 collection-input grid row-start-2 col-start-1" min="0" value="{{ $count[$k] }}">
                                    <button data-collapse-target="collapse{{ $factory->name }}" class="size-10 place-content-center rounded-lg grid float-right rounded-md row-start-2 col-start-4 bg-zinc-800 py-2 px-2 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-zinc-700 focus:shadow-none active:bg-zinc-700 hover:bg-zinc-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"><path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" /></svg></button>
                                </div>
                            </div> 
                        @endforeach

                        <div data-collapse="collapse{{ $factory->name }}" class="block h-0 w-full basis-full overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="factory-section">
                                <div class="resource-label">LAND USAGE</div>
                                <div class="factory-value align-middle">
                                    <img class="resource-icon" src="images/{{ $land[0] }}.webp"><p>{{ $land[1]*$count[$k] }}</p>
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
                </div>
            </div>
            <div class="w-[100%] h-[20%] mx-auto sm:px-6 lg:px-8 flex flex-1">
                <div class="bg-white shadow-sm sm:rounded-lg w-[100%] h-[75%] overflow-auto">
                    <div class="p-6 text-gray-900">
                        <div>
                            <form id="upd" action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data" target="hiddenFrame">
                                @csrf 
                                <input hidden type="text" name="counts" value="{{ json_encode($data, true); }}">
                            </form>
                        </div>
                        @php
                            $tland = combineAssoc($factories, 0, 'land', $usrfac);
                            $tcost = combineAssoc($factories, 0, 'cost', $usrfac);
                            $tinput = combineAssoc($factories, 0, 'input', $usrfac);
                            $toutput = combineAssoc($factories, 0, 'output', $usrfac);
                        @endphp

                        <div class="flex flex-wrap gap-4 rounded-lg leading-6 text-stone:950"> 
                            <ul class="flex min-w-64 flex-1">
                                <div class="icard h-screen resource-card w-[100%]">
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
                            <ul class="flex min-w-64 flex-1">
                                <div class="icard h-screen resource-card w-[100%]">
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
                            <ul class="flex min-w-64 flex-1">
                                <div class="icard h-screen resource-card w-[100%]">
                                    <div class="icard-header">
                                        <span class="icard-name">USAGE TOTALS</span>
                                    </div>
                                    <div class="list h-5/6 overflow-scroll">
                                        @foreach ($tinput[0] as $k => $v)
                                            <div class="flex justify-between items-center border-b-2">
                                                <img src="{{ url('images/' . $tinput[1][$k] . '.webp') }}" class="resource-icon" alt=""/>
                                                @php 
                                                    if (array_key_exists($k, $toutput[0])) {
                                                        if ($toutput[0][$k] > $v) {
                                                            echo('<p class="text-green-500">'. $tinput[0][$k] .'</p>');
                                                        } else if ($toutput[0][$k] == $v) {
                                                            echo('<p>'. $tinput[0][$k] .'</p>');
                                                        } else {
                                                            echo('<p class="text-red-500">'. $tinput[0][$k] .'</p>');
                                                        }
                                                    } else {
                                                        echo('<p>'. $tinput[0][$k] .'</p>');
                                                    }
                                                @endphp
                                            </div>
                                        @endforeach
                                    <div>
                                </div>
                            </ul>
                            <ul class="flex min-w-64 flex-1">
                                <div class="icard h-screen resource-card w-[100%]">
                                    <div class="icard-header">
                                        <span class="icard-name">PRODUCTION TOTALS</span>
                                    </div>
                                    <div class="list h-5/6 overflow-scroll">
                                        @foreach ($toutput[0] as $k => $v)
                                            <div class="flex justify-between items-center border-b-2">
                                                <img src="{{ url('images/' . $toutput[1][$k] . '.webp') }}" class="resource-icon" alt=""/>
                                                @php 
                                                    if ($toutput[1][$k] == "money") {
                                                        $usage = round($tinput[0][$k]);
                                                        $income = round($toutput[0][$k] + 24*$pop/30);

                                                        if ($v > $usage) {
                                                            echo('<p class="text-green-500">'. $income .'</p>');
                                                        } else if ($v == $usage) {
                                                            echo('<p>'. $income .'</p>');
                                                        } else {
                                                            echo('<p class="text-red-500">'. $income .'</p>');
                                                        }
                                                    } else {
                                                        if (array_key_exists($k, $tinput[0])) {
                                                            if ($v > $tinput[0][$k]) {
                                                                echo('<p class="text-green-500">'. $toutput[0][$k] .'</p>');
                                                            } else if ($v == $tinput[0][$k]) {
                                                                echo('<p>'. $toutput[0][$k] .'</p>');
                                                            } else {
                                                                echo('<p class="text-red-500">'. $toutput[0][$k] .'</p>');
                                                            }
                                                        } else {
                                                            echo('<p>'. $toutput[0][$k] .'</p>');
                                                        }
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
    <iframe name="hiddenFrame" width="0" height="0" style="display: none;"></iframe>
</x-app-layout>