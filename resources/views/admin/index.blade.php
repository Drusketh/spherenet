<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <div class="max-w-fit mx-auto p-4 sm:p-6 lg:p-8">
        <div class='admanage-container'>
            <div class='admanage-title'>{{ __('Admin Management Panel') }}</div>
            <div class='admanage-content'>
                <ul>
                    <div class="icard resource-card min-w-72 max-w-72 max-h-md overflow-auto">
                        <div class="icard-header">
                            <span class="icard-name">RESOURCE CREATOR</span>
                        </div>
                        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="resource-label">NAME</div>
                            <input type="text" name="name">
                            <br></br>

                            <div class="resource-label">TIER</div>
                            <input type="number" name="tier" class="icard-tier" min="0" max="10" value="0">
                            <br></br>

                            <div class="resource-label">IMAGE</div>
                            <input type="file" name="image">
                            <br></br>

                            <button type="submit" class="create-button">CREATE</button>
                        </form>
                    </div>
                </ul>
                <ul>
                    <div class="icard resource-card min-w-72 max-w-72 max-h-md overflow-auto">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="icard-header">
                            <span class="icard-name">FACTORY CREATOR</span>
                        </div>
                        <form action="{{ route('factories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="resource-label">NAME</div>
                            <input type="text" name="name">
                            <br></br>

                            <div class="resource-label">TIER</div>
                            <input type="number" name="tier" class="icard-tier" min="0" max="10" value="0">
                            <br></br>

                            <div>
                                <div class="resource-label">LAND USAGE</div>
                                <div class="flex justify-between items-center">
                                    <select name="land" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            @if ($resource->type == 'land')
                                                <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="number" name="landc" class="icard-tier max-w-24" min="0">
                                </div>
                            </div>

                            <div>
                                <div class="resource-label">COST</div>
                                <div class="flex justify-between items-center">
                                    <select name="rc1" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="c1" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="rc2" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="c2" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="rc3" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="c3" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="rc4" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="c4" class="icard-tier max-w-24" min="0">
                                </div>
                            </div>

                            <div>
                                <div class="resource-label">INPUT</div>
                                <div class="flex justify-between items-center">
                                    <select name="ri1" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="i1" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="ri2" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="i2" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="ri3" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="i3" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="ri4" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="i4" class="icard-tier max-w-24" min="0">
                                </div>
                            </div>

                            <div>
                                <div class="resource-label">OUTPUT</div>
                                <div class="flex justify-between items-center">
                                    <select name="ro1" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="o1" class="icard-tier max-w-24" min="0">
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="ro2" class="max-w-40">
                                        <option disabled selected value></option>
                                        @foreach ($resources as $resource)
                                            <option value="{{ $resource->name }}">{{ $resource->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="o2" class="icard-tier max-w-24" min="0">
                                </div>
                            </div>

                            <button type="submit" class="create-button">CREATE</button>
                        </form>
                    </div>
                </ul>
                <ul>
                    <div class="icard h-screen resource-card min-w-72 max-w-72">
                        <div class="icard-header">
                            <span class="icard-name">RESOURCE LIST</span>
                        </div>
                        <div class="list h-5/6 overflow-scroll">
                            @foreach ($resources as $resource)
                                <div class="flex justify-between items-center border-b-2">
                                    <img src="{{ asset($resource->image) }}" class="-icon" alt="{{ $resource->name }}">
                                    <p>{{ $resource->name }}</p>
                                </div>
                            @endforeach
                        <div>
                    </div>
                </ul>
                <ul>
                    <div class="icard h-screen resource-card min-w-72 max-w-72">
                        <div class="icard-header">
                            <span class="icard-name">FACTORY LIST</span>
                        </div>
                        <div class="list h-5/6 overflow-scroll">
                            @foreach ($factories as $factory)
                                <div class="flex justify-between items-center border-b-2">
                                    <p>{{ $factory->name }}</p>
                                    <p>{{ $factory->tier }}</p>
                                </div>
                            @endforeach
                        <div>
                    </div>
                </ul>

                <ul>
                    <div class="icard h-screen resource-card min-w-72 max-w-72">
                        <div class="icard-header">
                            <span class="icard-name">ADD FACS BY JSON</span>
                        </div>
                        <form action="{{ route('factories.jadd') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="resource-label">JSON</div>
                            <input class="min-h-42" type="text" name="json">
                            <br></br>

                            <button type="submit" class="create-button">SUBMIT</button>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
        <!-- <div class="resource-list">
                        <div class="resource-label">INPUT</div>
                            <div class="factory-value">
                                <span style="" data-base-amount="5400" data-current-amount="181344" data-hourly-amount="225"><img src="resources/money_icon.png" alt="money" title="Money" class="resource-icon"> 1.1k</span>                                </div>
                        </div>

                        <div class="resource-list">
                            <div class="resource-label">OUTPUT</div>
                            <div class="factory-value">
                                <span data-base-amount="1800"><img src="resources/food_icon.png" alt="food" title="Food" class="resource-icon"> 375</span>                                </div>
                        </div>

                        <button class="create-button" onclick="collectResource('farm')">
                            CREATE
                        </button>

                        <button class="delete-button" onclick="demolishFactory('farm', {&quot;tier&quot;:1,&quot;name&quot;:&quot;Farm&quot;,&quot;input&quot;:[{&quot;resource&quot;:&quot;money&quot;,&quot;amount&quot;:9}],&quot;output&quot;:[{&quot;resource&quot;:&quot;food&quot;,&quot;amount&quot;:3}],&quot;construction_cost&quot;:[{&quot;resource&quot;:&quot;money&quot;,&quot;amount&quot;:500}],&quot;land&quot;:{&quot;type&quot;:&quot;cleared_land&quot;,&quot;amount&quot;:5},&quot;construction_time&quot;:30,&quot;gp_value&quot;:1})">
                            DELETE
                        </button> -->
    </div>
</x-app-layout>