import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { ReactiveFormsModule } from "@angular/forms";
import { FormBuilder, FormGroup } from '@angular/forms';

import { AppComponent } from './app.component';
import { MainComponent } from './componentes/main/main.component';
import { NavbarComponent } from './componentes/navbar/navbar.component';
import { TiempoComponent } from './componentes/tiempo/tiempo.component';
import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule } from "@angular/common/http";

@NgModule({
  declarations: [
    AppComponent,
    MainComponent,
    NavbarComponent,
    TiempoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
