@extends('../layouts.coordinador')

@section('container')
    <div id="app">

    </div>
@endsection

@section('script-area')
    <script>
        // console.log(JSON.parse("{{ json_encode($areaid) }}"))
        window.areaid= {!! json_encode($areaid) !!};
        console.log(areaid)
    </script>

    <script src="{{ asset('js/preguntas.js') }}" defer></script>
@endsection