import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-calendar-detalle',
  templateUrl: './calendar-detalle.component.html',
  styleUrls: ['./calendar-detalle.component.scss']
})
export class CalendarDetalleComponent implements OnInit {

  tareas: Tarea[] = [];

  constructor() { }

  ngOnInit(): void {
    this.loadTareas();
  }

  private loadTareas(): void {
    let tarea: Tarea = new Tarea();
    tarea.dia = 13;
    tarea.mes = 9;
    tarea.asignatura = 'Lenguaje';
    tarea.actividad = 'Dictado vocaublario y sinonimos';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 25;
    tarea.mes = 9;
    tarea.asignatura = 'Lenguaje';
    tarea.actividad = 'Libro "El cronograma de Beatriz"';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 28;
    tarea.mes = 9;
    tarea.asignatura = 'Lenguaje';
    tarea.actividad = 'Libro "El cronograma de Beatriz"';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 27;
    tarea.mes = 9;
    tarea.asignatura = 'Ciencias';
    tarea.actividad = 'Elaboración de afiche co acciones que evidencien el cuidado del agua y acciones que malgastar';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 14;
    tarea.mes = 9;
    tarea.asignatura = 'Matematicas';
    tarea.actividad = 'tarea uno ';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 14;
    tarea.mes = 9;
    tarea.asignatura = 'Matematicas';
    tarea.actividad = 'tarea dos';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 14;
    tarea.mes = 9;
    tarea.asignatura = 'Matematicas';
    tarea.actividad = 'tarea tres';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 7;
    tarea.mes = 9;
    tarea.asignatura = 'Tecnología';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 3;
    tarea.mes = 10;
    tarea.asignatura = 'Ingles';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 3;
    tarea.mes = 10;
    tarea.asignatura = 'Ingles';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);


    tarea = new Tarea();
    tarea.dia = 11;
    tarea.mes = 9;
    tarea.asignatura = 'Artes Visuales';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 27;
    tarea.mes = 9;
    tarea.asignatura = 'Musica';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 7;
    tarea.mes = 9;
    tarea.asignatura = 'Historia';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 29;
    tarea.mes = 9;
    tarea.asignatura = 'Historia';
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);
  }
}

export interface Tarea {
  dia: number;
  mes: number;
  asignatura: string;
  actividad: string;
}
export class Tarea { }

export interface Asigntura {
  nombre: number;
  color: number;
}
export class Asigntura { }
