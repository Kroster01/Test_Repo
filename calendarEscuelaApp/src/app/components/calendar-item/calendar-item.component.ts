import { Component, OnInit, Input } from '@angular/core';
import { Dia, Asignatura, Semana, Semanas, Tarea } from '../model/contanst';

@Component({
  selector: 'app-calendar-item',
  templateUrl: './calendar-item.component.html',
  styleUrls: ['./calendar-item.component.scss']
})
export class CalendarItemComponent implements OnInit {

  @Input() tareas!: Tarea[];
  semanas: Semanas[] = [];
  semana: Semana[] = [];
  diasSemana: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
  asignaturas: Asignatura[] = [];

  constructor() { }

  ngOnInit(): void {
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

  private findtareas(): void {
    for (var dia = 0; dia < this.semanas.length; dia++) {
      for (var dia0 = 0; dia0 < this.semanas[dia].semana.length; dia0++) {
        for (var dia1 = 0; dia1 < this.semanas[dia].semana[dia0].dias.length; dia1++) {
          let diaNumber = this.semanas[dia].semana[dia0].dias[dia1].diaNumber;
          let tareas = this.tareas.filter(x => x.dia == diaNumber);
          if (tareas.length > 0) {
            let actividades: Asignatura[] = [];
            for (let index = 0; index < tareas.length; index++) {
              const element = tareas[index];
              actividades.push(element.asignatura);
            }
            let servicesLimpio: Asignatura[] = Array.from(new Set(actividades))
            this.semanas[dia].semana[dia0].dias[dia1].tareas = servicesLimpio;
          }
        }
      }
    }
  }

}
