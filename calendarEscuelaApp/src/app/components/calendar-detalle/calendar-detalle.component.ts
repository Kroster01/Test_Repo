import { Component, OnInit } from '@angular/core';
import { Asignatura, Asignaturas, Tarea } from '../model/contanst';

@Component({
  selector: 'app-calendar-detalle',
  templateUrl: './calendar-detalle.component.html',
  styleUrls: ['./calendar-detalle.component.scss']
})
export class CalendarDetalleComponent implements OnInit {

  tareas: Tarea[] = [];
  asignaturas: Asignatura[] = [];
  asignaturasTemplete = new Asignaturas();

  constructor() { }

  ngOnInit(): void {
    Object.entries(this.asignaturasTemplete).forEach(([key, value]) => {
      //console.log(value);
      let sdsd: Asignatura = value;
      this.asignaturas.push(sdsd);
      //console.log('nombre: ' + nombre);
      //console.log('color: ' + color);
      //console.log('*****************************************************');console.log('*****************************************************');
    });
  }

}

