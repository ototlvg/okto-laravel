@extends('../layouts.coordinador')

@section('script-area')
    <script>
        // console.log(JSON.parse("{{ json_encode($areaid) }}"))
        window.areaid= {!! json_encode($areaid) !!};
        console.log(areaid)
    </script>
@endsection