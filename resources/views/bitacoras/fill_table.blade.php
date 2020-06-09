<table class="table table-striped">
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
                if(strpos($bitacora->id_modulo,"ATIS Maniobras")!==false && $bitacora->status!=="error"){
                    if(strpos($bitacora->accion,"Cambiada Maniobra S")!==false){
                        $clase="linea_titulo_pistas bg_amarillo titulo_orientacion_maniobras";
                    } else{
                        $clase="linea_titulo_pistas bg_azul_claro txt_blanco titulo_orientacion_maniobras";
                    }
                }
            @endphp
            <td class="{{ $clase }}" style="word-break: break-all;">{{ $bitacora->accion }}</td>
            <td ><span @if($bitacora->status=="ok") class="bg-green-active color-palette" @endif style="padding: 0 5px 0 5px">{{ $bitacora->status }}</span></td>
            <td>{!! beauty_fecha($bitacora->fecha) !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
