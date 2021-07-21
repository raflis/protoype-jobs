<table>
    <thead>
    <tr>
        <th><strong>Nombre del proyecto</strong></th>
        <th><strong>Descripción de la tarea</strong></th>
        <th><strong>Fecha de inicio</strong></th>
        <th><strong>Fecha de fin</strong></th>
        <th><strong>Días de plazo</strong></th>
        <th><strong>Tipo de entregable</strong></th>
        <th><strong>Comentarios del avance</strong></th>
        <th><strong>Link del archivo</strong></th>
        <th><strong>% de avance</strong></th>
        <th><strong>Status</strong></th>
        <th><strong>Feedback del avance</strong></th>
        <th><strong>Supervisor</strong></th>
        <th><strong>Usuario asignado</strong></th>
        <th><strong>Tipo de usuario</strong></th>
        <th><strong>Fecha de creación</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($progress as $progres)
    @php 
        $end = \Carbon\Carbon::parse($progres->activity->end_date);
        $start = \Carbon\Carbon::parse($progres->activity->start_date);
        $days = ($end->diffInDays($start)==0)?'El mismo día':($end->diffInDays($start)==1)?'1 día':$start->diffInDays($end).' días';
    @endphp
    @php $perc = 0 @endphp
    @if ($progres->file != NULL)
        @php 
            $archivo = asset($progres->file); 
        @endphp
    @else
        @php $archivo = ""; @endphp
    @endif
    @if($progres->activity->user->parent)
        @php $supervisor = $progres->activity->user->parent->full_name @endphp
    @else
        @php $supervisor= "" @endphp
    @endif
        <tr>
            <td style="width: 20px">{{ $progres->activity->name }}</td>
            <td style="width: 20px">{{ $progres->activity->task }}</td>
            <td style="width: 15px">{!! \Carbon\Carbon::parse($progres->activity->start_date)->format('d/m/Y') !!}</td>
            <td style="width: 15px">{!! \Carbon\Carbon::parse($progres->activity->end_date)->format('d/m/Y') !!}</td>
            <td style="width: 12px">{{ $days }}</td>
            <td style="width: 17px">{{ $progres->activity->type->name }}</td>
            <td style="width: 25px">{{ $progres->observation }}</td>
            <td style="width: 27px">{{ $archivo }}</td>
            <td style="width: 15px">{{ $progres->percentage }}%</td>
            <td style="width: 11px">{{ $progres->activity->status->name }}</td>
            <td style="width: 20px">{{ $progres->feedback }}</td>
            <td style="width: 15px">{{ ucwords($supervisor) }}</td>
            <td style="width: 15px">{{ ucwords($progres->activity->user->full_name) }}</td>
            <td style="width: 16px">{{ getRole($progres->activity->user->role) }}</td>
            <td style="width: 18px">{!! \Carbon\Carbon::parse($progres->created_at)->format('d/m/Y H:i:s') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>