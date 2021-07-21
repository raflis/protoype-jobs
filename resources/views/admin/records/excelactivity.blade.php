<table>
    <thead>
    <tr>
        <th><strong>Nombre del proyecto</strong></th>
        <th><strong>Descripción de la tarea</strong></th>
        <th><strong>Fecha de inicio</strong></th>
        <th><strong>Fecha de fin</strong></th>
        <th><strong>Días de plazo</strong></th>
        <th><strong>Comentarios</strong></th>
        <th><strong>Tipo de entregable</strong></th>
        <th><strong>Link del archivo</strong></th>
        <th><strong>Progreso actual</strong></th>
        <th><strong>Status</strong></th>
        <th><strong>Feedback</strong></th>
        <th><strong>Usuario asignado</strong></th>
        <th><strong>Tipo de usuario</strong></th>
        <th><strong>Fecha de creación</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($activities as $activity)
    @php 
        $end = \Carbon\Carbon::parse($activity->end_date);
        $start = \Carbon\Carbon::parse($activity->start_date);
        $days = ($end->diffInDays($start)==0)?'El mismo día':($end->diffInDays($start)==1)?'1 día':$start->diffInDays($end).' días';
    @endphp
    @php $perc = 0 @endphp
    @foreach ($activity->progress as $item)
        @if($loop->last)
            @php $perc = $item->percentage @endphp
        @endif
    @endforeach
    @if ($activity->file != NULL)
        @php 
            $archivo = asset($activity->file); 
        @endphp
    @else
        @php $archivo = ""; @endphp
    @endif
        <tr>
            <td style="width: 20px">{{ $activity->name }}</td>
            <td style="width: 20px">{{ $activity->task }}</td>
            <td style="width: 15px">{!! \Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') !!}</td>
            <td style="width: 15px">{!! \Carbon\Carbon::parse($activity->end_date)->format('d/m/Y') !!}</td>
            <td style="width: 12px">{{ $days }}</td>
            <td style="width: 20px">{{ $activity->observation }}</td>
            <td style="width: 17px">{{ $activity->type->name }}</td>
            <td style="width: 27px">{{ $archivo }}</td>
            <td style="width: 15px">{{ $perc }}%</td>
            <td style="width: 11px">{{ $activity->status->name }}</td>
            <td style="width: 20px">{{ $activity->feedback }}</td>
            <td style="width: 15px">{{ ucwords($activity->user->full_name) }}</td>
            <td style="width: 16px">{{ getRole($activity->user->role) }}</td>
            <td style="width: 18px">{!! \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y H:i:s') !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>