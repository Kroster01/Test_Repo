import { Component, OnInit, Input } from '@angular/core';
import { AgrupaTarea, Asignatura, Asignaturas, Tarea } from '../model/contanst';

@Component({
  selector: 'app-calendar-detalle',
  templateUrl: './calendar-detalle.component.html',
  styleUrls: ['./calendar-detalle.component.scss']
})
export class CalendarDetalleComponent implements OnInit {

  @Input() tareas!: Tarea[];
  asignaturas: Asignatura[] = [];
  asignaturasTemplete = new Asignaturas();

  agrupaTarea: AgrupaTarea[] = [];

  constructor() { }

  ngOnInit(): void {
    this.agruparAsignaturasPorColor();
  }

  private agruparAsignaturasPorColor(): void {
    Object.entries(this.asignaturasTemplete).forEach(([key, value]) => {
      this.asignaturas.push(value);
      let tareas: Tarea[] = this.agruparAsignaturasPorTareas(value.nombre);
      if (tareas.length > 0) {
        let agrupaTareaa: AgrupaTarea = new AgrupaTarea(value, tareas);
        this.agrupaTarea.push(agrupaTareaa);
      }
      tareas = [];
    });
  }

  private agruparAsignaturasPorTareas(nombreAsignatura: string): Tarea[] {
    let tareas: Tarea[] = [];
    for (const index in this.tareas) {
      console.log('' + this.tareas[index].asignatura.nombre);
      if (this.tareas[index].asignatura.nombre === nombreAsignatura) {
        tareas.push(this.tareas[index]);
      }
    }
    return tareas;
  }

}
