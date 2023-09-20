import { Component, OnInit } from '@angular/core';
import { Asignaturas, Tarea } from '../model/contanst';

@Component({
  selector: 'app-calendar-prueba',
  templateUrl: './calendar-prueba.component.html',
  styleUrls: ['./calendar-prueba.component.scss']
})
export class CalendarPruebaComponent implements OnInit {

  tareas: Tarea[] = [];
  asignaturasTemplete = new Asignaturas();

  constructor() { }

  ngOnInit(): void {
    this.loadTareas();
  }

  private loadTareas(): void {
    let tarea: Tarea = new Tarea(13, 9, this.asignaturasTemplete.Lenguaje, 'Dictado vocaublario y sinonimos');
    this.tareas.push(tarea);

    tarea = new Tarea(25, 9, this.asignaturasTemplete.Lenguaje, 'Libro "El cronograma de Beatriz"');
    this.tareas.push(tarea);

    tarea = new Tarea(28, 9, this.asignaturasTemplete.Lenguaje, 'Libro "El cronograma de Beatriz"');
    this.tareas.push(tarea);

    tarea = new Tarea(27, 9, this.asignaturasTemplete.Ciencias, 'Elaboración de afiche co acciones que evidencien el cuidado del agua y acciones que malgastar');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Matematicas, 'tarea uno');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Matematicas, 'tarea dos');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Matematicas, 'tarea tres');
    this.tareas.push(tarea);

    tarea = new Tarea(7, 9, this.asignaturasTemplete.Tecnologia, 'tarea Uno');
    this.tareas.push(tarea);

    tarea = new Tarea(3, 10, this.asignaturasTemplete.Ingles, 'tarea Uno');
    this.tareas.push(tarea);

    tarea = new Tarea(11, 9, this.asignaturasTemplete.ArtesVisuales, 'tarea Uno');
    this.tareas.push(tarea);

    tarea = new Tarea(27, 9, this.asignaturasTemplete.Musica, 'tarea Uno');
    this.tareas.push(tarea);

    tarea = new Tarea(7, 9, this.asignaturasTemplete.Historia, 'tarea Uno');
    this.tareas.push(tarea);

    tarea = new Tarea(29, 9, this.asignaturasTemplete.Historia, 'tarea Uno');
    this.tareas.push(tarea);
  }

}
