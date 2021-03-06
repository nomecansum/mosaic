<table id="tablapuestos" data-toggle="table"
data-locale="es-ES"
data-search="true"
data-show-columns="true"
data-show-columns-toggle-all="true"
data-page-list="[5, 10, 20, 30, 40, 50]"
data-page-size="50"
data-pagination="true"
data-show-pagination-switch="true"
data-show-button-icons="true"
data-toolbar="#all_toolbar"
>
    <thead>
        <tr>
            <th>id_bitacora</th>
            <th>usuario</th>
            <th>id_modulo</th>
            <th>id_seccion</th>
            <th>accion</th>
            <th>status</th>
            <th style="width: 140px">fecha</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bitacoras as $bitacora)
        <tr style="font-size: 13px" @if($bitacora->status=="error" || strpos($bitacora->accion,"ERROR:")!==false) class="bg-red color-palette" @endif>
            <td>{{ $bitacora->id_bitacora }}</td>
            <td>{{ $bitacora->name }}</td>
            <td>{{ $bitacora->id_modulo }}</td>
            <td>{{ $bitacora->id_seccion }}</td>
            @php
                $clase="";
            
            @endphp
            <td class="{{ $clase }}" style="word-break: break-all;">{{ $bitacora->accion }}</td>
            <td ><span @if($bitacora->status=="ok") class="bg-green-active color-palette" @endif style="padding: 0 5px 0 5px">{{ $bitacora->status }}</span></td>
            <td>{!! beauty_fecha($bitacora->fecha) !!}</td>
        </tr>
    @endforeach
    </tbody>

</table>
<script>
    @isset($search)
        $('#tablapuestos').bootstrapTable(); 
    @endisset
</script>
{{-- {!! $bitacoras->render() !!} --}}
