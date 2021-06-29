

    <h3>Señor/a <b>{{$actual->nombre}} {{$actual->apellido}}</h3>
      <p>Los Datos de su turno para el retiro de la tarjeta Sube son los siguientes:</p>
      <br>
      <table border="0">
          <tr>
              <td><b>Número Turno:</b></td>
              <td>{{$actual->nro_turno}}</b></td>
              <td><b>Fecha Turno:</b></td>
              <td>{{$actual->fecha_turno->format('d/m/Y')}}</b></td>
          </tr>
          <tr>
              <td><b>Horario:</b></td>
              <td>{{$actual->hora_turno}}</b></td>
              <td><b>Oficina:</b></td>
              <td>{{$actual->oficina->denominacion}}</b></td>
          </tr>
      </table>
      <hr>
      <p>Recuerde que debe asistir con el documento nacional de identidad con el cuál solicito el turno</p>
      <br/>