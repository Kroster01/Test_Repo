import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';

// const urlBase: string = 'https://samples.openweathermap.org/data/2.5/weather';
// const appId: string = '439d4b804bc8187953eb36d2a8c26a02';
// https://api.openweathermap.org/data/2.5/weather
// ?q=
// London,uk
// &appid=
// d39632eac253cba58028bf6cbf6230f0
const urlBase: string = 'https://api.openweathermap.org/data/2.5/weather';
const appId: string = 'd39632eac253cba58028bf6cbf6230f0';

@Injectable({
  providedIn: 'root'
})
export class TemperaturaService {

  constructor(private http: HttpClient) { }

  getEstadoTiempo(ciudad: string, codigo: string) {
    const url = `${urlBase}?q=${ciudad},${codigo}&appid=${appId}`;
    console.log('url de consulta: ' + url);
    return this.http.get(url);
  }

}
