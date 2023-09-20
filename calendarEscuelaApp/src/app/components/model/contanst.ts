export class Asignaturas {
    constructor() {
        this.Lenguaje = new Lenguaje('Lenguaje', '#ffdf57');
        this.Ciencias = new Ciencias('Ciencias', '#07bc65');
        this.Matematicas = new Matematicas('Matematicas', '#fb332f');
        this.Tecnologia = new Tecnologia('Tecnología', '#f6b1bb');
        this.Ingles = new Ingles('Ingles', '#5370ff');
        this.ArtesVisuales = new ArtesVisuales('Artes Visuales', '#7c73b2'); 
        this.Musica = new Musica('Musica', '#62afbb');
        this.Historia = new Historia('Historia', '#a55c5c');
    }
}
export interface Asignaturas {
    Lenguaje: Lenguaje;
    Ciencias: Ciencias;
    Matematicas: Matematicas;
    Tecnologia: Tecnologia;
    Ingles: Ingles;
    ArtesVisuales: ArtesVisuales;
    Musica: Musica;
    Historia: Historia;
}

export class Asignatura {
    constructor(nombre: string, color: string) {
        this.nombre = nombre;
        this.color = color;
    }
}
export interface Asignatura {
    nombre: string
    color: string
}

export class Lenguaje extends Asignatura {
}
export interface Lenguaje {
}

export class Ciencias extends Asignatura {
}
export interface Ciencias {
}

export class Matematicas extends Asignatura {
}
export interface Matematicas {
}

export class Tecnologia extends Asignatura {
}
export interface Tecnologia {
}

export class Ingles extends Asignatura {
}
export interface Ingles {
}

export class ArtesVisuales extends Asignatura {
}
export interface ArtesVisuales {
}

export class Musica extends Asignatura {
}
export interface Musica {
}

export class Historia extends Asignatura {
}
export interface Historia {
}

/*****************************************************/
export interface Tarea {
    dia: number;
    mes: number;
    asignatura: Asignatura;
    actividad: string;
}
export class Tarea {
    constructor(dia: number, mes: number, asignatura: any, actividad: string) {
        this.dia = dia;
        this.mes = mes;
        this.asignatura = asignatura;
        this.actividad = actividad;
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
