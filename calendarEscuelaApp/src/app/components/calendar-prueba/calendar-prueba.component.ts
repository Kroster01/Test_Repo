import { Component, Input, OnInit } from '@angular/core';
import { Asignaturas, Tarea } from '../model/contanst';

@Component({
  selector: 'app-calendar-prueba',
  templateUrl: './calendar-prueba.component.html',
  styleUrls: ['./calendar-prueba.component.scss']
})
export class CalendarPruebaComponent implements OnInit {

  @Input() taressas!: Tarea[];
  meses: string[] = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  fechaAnioMes!: string;
  mes!: number;
  aanio!: number;
  tareas: Tarea[] = [];
  asignaturasTemplete = new Asignaturas();

  constructor() { }

  ngOnInit(): void {
    let fecha = new Date();
    this.mes = fecha.getMonth();
    this.aanio = 2020;//fecha.getFullYear();
    // TODO: completar con un cero a la izquierda si el mes es de in digito
    const countMes: number = ('' + this.mes).length;
    if (countMes === 1) {
      this.fechaAnioMes = this.aanio + '-0' + this.mes;
    } else {
      this.fechaAnioMes = this.aanio + '-' + this.mes;
    }

    this.loadTareas();
  }

  private loadTareas(): void {
    let tarea: Tarea = new Tarea(13, 9, this.asignaturasTemplete.Lenguaje, 'Dictado vocaublario y sinonimos', 'Dictado');
    this.tareas.push(tarea);

    tarea = new Tarea(25, 9, this.asignaturasTemplete.Lenguaje, 'Libro "El cronograma de Beatriz"', 'Libro');
    this.tareas.push(tarea);

    tarea = new Tarea(28, 9, this.asignaturasTemplete.Lenguaje, 'Libro "El cronograma de Beatriz"', 'Poema');
    this.tareas.push(tarea);

    tarea = new Tarea(27, 9, this.asignaturasTemplete.Ciencias, 'Elaboración de afiche con acciones que evidencien el cuidado del agua y acciones que malgastar', 'Afiche');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Matematicas, 'tarea uno', 'N del o al 1000');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Matematicas, 'tarea dos', 'N del o al 1000');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Matematicas, 'tarea tres', 'N del o al 1000');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Tecnologia, 'tarea Cero', 'Adorno Cero');
    this.tareas.push(tarea);

    tarea = new Tarea(14, 9, this.asignaturasTemplete.Musica, 'Canción Uno', 'Llevar Instrumento');
    this.tareas.push(tarea);

    tarea = new Tarea(7, 9, this.asignaturasTemplete.Tecnologia, 'tarea Uno', 'Adorno');
    this.tareas.push(tarea);

    tarea = new Tarea(11, 9, this.asignaturasTemplete.ArtesVisuales, 'tarea Uno', 'Materiales');
    this.tareas.push(tarea);

    tarea = new Tarea(27, 9, this.asignaturasTemplete.Musica, 'tarea Uno', 'Cantar');
    this.tareas.push(tarea);

    tarea = new Tarea(29, 9, this.asignaturasTemplete.Historia, 'tarea Uno', 'Lencción 2-3');
    this.tareas.push(tarea);

    /*
    tarea = new Tarea(3, 10, this.asignaturasTemplete.Ingles, 'tarea Uno', 'Vocabulario y Numeros');
    this.tareas.push(tarea);
    */
  }

  obtenerSeleccionCategoria(event: any) {

    let auxFechaAnioMes: string = event?.target?.value;
    let aux = auxFechaAnioMes.split('-');
    console.log('aux[0]: ' + aux[0]);
    console.log('aux[1]: ' + aux[1]);
    this.aanio = +aux[0];
    this.mes = +aux[1];
    //debugger
  }

}
