import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-calendar-item',
  templateUrl: './calendar-item.component.html',
  styleUrls: ['./calendar-item.component.scss']
})
export class CalendarItemComponent implements OnInit {

  semanas: Semanas[] = [];
  semana: Semana[] = [];
  diasSemana: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
  tareas: Tarea[] = [];


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
    let tarea: Tarea = new Tarea();
    let asign: Asignatura = new Asignatura('Lenguaje', 'yellow');
    tarea.dia = 13;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'Dictado vocaublario y sinonimos';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 25;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'Libro "El cronograma de Beatriz"';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 28;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'Libro "El cronograma de Beatriz"';
    this.tareas.push(tarea);

    asign = new Asignatura('Ciencias', 'green');
    tarea = new Tarea();
    tarea.dia = 27;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'Elaboración de afiche co acciones que evidencien el cuidado del agua y acciones que malgastar';
    this.tareas.push(tarea);

    asign = new Asignatura('Matematicas', 'red');
    tarea = new Tarea();
    tarea.dia = 14;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea uno ';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 14;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea dos';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 14;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea tres';
    this.tareas.push(tarea);

    asign = new Asignatura('Tecnología', 'deeppink');
    tarea = new Tarea();
    tarea.dia = 7;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    asign = new Asignatura('Ingles', 'cadetblue');
    tarea = new Tarea();
    tarea.dia = 3;
    tarea.mes = 10;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 3;
    tarea.mes = 10;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    asign = new Asignatura('Artes Visuales', 'mediumpurple');
    tarea = new Tarea();
    tarea.dia = 11;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    asign = new Asignatura('Musica', 'cadetblue');
    tarea = new Tarea();
    tarea.dia = 27;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    asign = new Asignatura('Historia', 'brown');
    tarea = new Tarea();
    tarea.dia = 7;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
    this.tareas.push(tarea);

    tarea = new Tarea();
    tarea.dia = 29;
    tarea.mes = 9;
    tarea.asignatura = asign;
    tarea.actividad = 'tarea Uno';
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
            console.log("diaNumber: " + diaNumber + " - tareas.length: " + tareas.length);
            console.log("tareas: " + JSON.stringify(tareas));
            let actividades: Asignatura[] = [];
            for (let index = 0; index < tareas.length; index++) {
              const element = tareas[index];
              actividades.push(element.asignatura);
            }
            let servicesLimpio: Asignatura[] = Array.from(new Set(actividades))
            //console.log({servicesLimpio})

            console.log("diaNumber: " + diaNumber + " - tareas.length: " + servicesLimpio.length);
            console.log("servicesLimpio: " + JSON.stringify(servicesLimpio));

            // Eliminar repetidos en actividades.
            this.semanas[dia].semana[dia0].dias[dia1].tareas = servicesLimpio;
          }
        }
      }
    }
  }

}

export interface Dia {
  diaNumber: number;
  diaName: string;
  tareas?: Asignatura[];
}

export interface Semana {
  dias: Dia[];
}

export interface Semanas {
  semana: Semana[];
}

export interface Tarea {
  dia: number;
  mes: number;
  asignatura: Asignatura;
  actividad: string;
}
export class Tarea { }

export interface Asignatura {
  nombre: string;
  color: string;
}
export class Asignatura {
  constructor(nom: string, col: string) {
    this.nombre = nom;
    this.color = col;
  }
}
