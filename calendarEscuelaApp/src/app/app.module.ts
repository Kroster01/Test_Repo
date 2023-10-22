import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './routing/app-routing.module';
import { AppComponent } from './app.component';
import { CalendarItemComponent } from './components/calendar-item/calendar-item.component';
import { CalendarDetalleComponent } from './components/calendar-detalle/calendar-detalle.component';
import { CalendarPruebaComponent } from './components/calendar-prueba/calendar-prueba.component';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    AppComponent,
    CalendarItemComponent,
    CalendarDetalleComponent,
    CalendarPruebaComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
