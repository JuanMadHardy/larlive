<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vista de Nodos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="max-w-full bg-white overflow-hidden sm:rounded-lg">
                <div class="bg-white">
                    <!-- component -->
                    <div class="md:flex-auto items-center gap-x-4 ml-2 mb-8">
                        @if( $activenodes)
                            @foreach( $activenodes  as $anodo)
                                <div class="flex float-left mt-2 ml-3 mb-3">
                                    <button id="{{ $anodo }}" data-name="{{ $anodo }}" class="bg-red-600 hover:bg-red-400
                                    transition-colors rounded-[8px] px-[15px] py-[4px] text-white focus:ring-2"
                                            onclick="getnodedata(this)">
                                        {{ $anodo }}
                                    </button>
                                </div>
                            @endforeach

                        @endif
                        @if( $listnodes )
                            @foreach ( $listnodes as $listnode)
                                    <div class="flex float-left mt-2 ml-3 mb-3">
                                        <button id="{{ $listnode->id }}" data-name="{{ $listnode->name }}" class="@if ( $listnode->ping == 0 )  bg-green-500  @else bg-orange-600 @endif
                                        @if( $listnode->ping == 0 ) hover:bg-green-400 @else hover:bg-orange-400 @endif
                                            transition-colors rounded-[8px] px-[15px] py-[4px] text-white focus:ring-2
                                            @if( $listnode->ping == 0) ring-green-500 @else ring-orange-400 @endif" onclick="getnodedata(this)">
                                            {{ $listnode->name.' '.$listnode->ip }}
                                        </button>
                                    </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="max-w-2xl">
            {{ $listnodes->links() }}
        </div>  --}}       
    </div>
    <script type="text/javascript">
        function getnodedata(obj) {
            var request = new XMLHttpRequest();
            var _token = document.getElementsByName('_token');
            console.log(_token[0].value);
            request.onreadystatechange = function(){
            if(request.readyState === 4) {
                console.log('cuatro'); 
                if(request.status === 200) { 
                    let objrsp = JSON.parse(request.responseText);
                    alert('ultimo registro: ' + objrsp['success'][0].created_at);
                console.log(request.responseText);
                } else {
                console.log('An error occurred during your request: ' 
                            +  request.status + ' ' + request.statusText);
                } 
            }
            }
            request.open('GET','getlastdata/'+obj.dataset.name+'?_token='+_token[0].value);
            request.send();
        }

        setTimeout(function(){
            location.reload();
        },3 * 60 * 1000);    

    </script>
</x-app-layout>
