import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CalendarPruebaComponent } from '../components/calendar-prueba/calendar-prueba.component';

const routes: Routes = [
  { path: '', component: CalendarPruebaComponent },
  { path: 'default', component: CalendarPruebaComponent },
  { path: '**', redirectTo: 'default', pathMatch: 'full' } // cuando la ruta no existe
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
