import { Component, OnInit } from '@angular/core';
import { Asignaturas, Dia, Asignatura, Semana, Semanas, Tarea } from '../model/contanst';

@Component({
  selector: 'app-calendar-item',
  templateUrl: './calendar-item.component.html',
  styleUrls: ['./calendar-item.component.scss']
})
export class CalendarItemComponent implements OnInit {

  semanas: Semanas[] = [];
  semana: Semana[] = [];
  diasSemana: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
  asignaturas: Asignatura[] = [];
  tareas: Tarea[] = [];
  asignaturasTemplete = new Asignaturas();

  constructor() { }

  ngOnInit(): void {
    this.loadTareas();
    let fecha = new Date();
    let ames: number = fecha.getMonth() + 1;
    let aanio: number = fecha.getFullYear();
    var diasMes: number = new Date(aanio, ames, 0).getDate();
    let listDia: Dia[] = this.llenarVaciosPrevios(ames, aanio);
    this.llenarCalendario(diasMes, ames, aanio, listDia);
    this.llenarVaciosPosterior();
    this.findtareas();
    console.log(`fin proceso  `);
  }

  private llenarVaciosPrevios(ames: number, aanio: number): Dia[] {
    console.log(`Method: llenarVaciosPrevios`);
    var init = new Date(aanio, ames - 1, 1).getDay();
    let conutDías = 0;
    let listDia: Dia[] = [];
    for (var i = 1; i < init; i++) {
      let dia0: Dia = { diaNumber: -1, diaName: '' };
      listDia.push(dia0);
      conutDías++;
    }
    return listDia;
  }

  private llenarCalendario(diasMes: number, ames: number, aanio: number, listDia: Dia[]): void {
    console.log(`Method: llenarCalendario`);
    for (var dia = 1; dia <= diasMes; dia++) {
      var indice = new Date(aanio, ames - 1, dia).getDay();
      if (indice === 0) {
        indice = 7;
      }
      let dia1: Dia = { diaNumber: dia, diaName: `Día ${dia}` };
      listDia.push(dia1);
      if (indice === 7 || dia === diasMes) {
        this.semana.push({ dias: listDia });
        this.semanas.push({ semana: this.semana });
        this.semana = [];
        listDia = [];
      }
    }
  }

  private llenarVaciosPosterior(): void {
    console.log(`Method: llenarVaciosPosterior`);
    for (var dia = this.semanas.length; dia <= this.semanas.length; dia++) {
      let dia1: Dia = { diaNumber: -1, diaName: `` };
      this.semanas[dia - 1].semana[0].dias.push(dia1);
    }
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

    tarea = new Tarea(3, 10, this.asignaturasTemplete.Lenguaje, 'tarea Uno');
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

  private findtareas(): void {
    // this.semanas[0].semana[0].dias.find(x => x.diaNumber == 3).tareas = [];
    for (var dia = 0; dia < this.semanas.length; dia++) {
      for (var dia0 = 0; dia0 < this.semanas[dia].semana.length; dia0++) {
        //this.semanas[dia].semana[dia0].dias.find(x => x.diaNumber == 3)://.tareas = [];
        for (var dia1 = 0; dia1 < this.semanas[dia].semana[dia0].dias.length; dia1++) {
          let diaNumber = this.semanas[dia].semana[dia0].dias[dia1].diaNumber;
          let tareas = this.tareas.filter(x => x.dia == diaNumber);

          if (tareas.length > 0) {
            //console.log("diaNumber: " + diaNumber + " - tareas.length: " + tareas.length);
            //console.log("tareas: " + JSON.stringify(tareas));
            let actividades: Asignatura[] = [];
            for (let index = 0; index < tareas.length; index++) {
              const element = tareas[index];
              actividades.push(element.asignatura);
            }
            let servicesLimpio: Asignatura[] = Array.from(new Set(actividades))
            //console.log({servicesLimpio})

            //console.log("diaNumber: " + diaNumber + " - tareas.length: " + servicesLimpio.length);
            //console.log("servicesLimpio: " + JSON.stringify(servicesLimpio));

            // Eliminar repetidos en actividades.
            this.semanas[dia].semana[dia0].dias[dia1].tareas = servicesLimpio;
          }
        }
      }
    }
  }

}
