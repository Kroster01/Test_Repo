import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Ng9RutModule , RutPipe } from 'ng9-rut';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { MatFormFieldModule, MatInputModule } from '@angular/material';
import { LoginComponent } from './login/login.component';

@NgModule({
  declarations: [LoginComponent],
  imports: [
    CommonModule,
    Ng9RutModule,
    ReactiveFormsModule,
    MatFormFieldModule,
    FormsModule,
    MatInputModule
  ],
  providers: [
    RutPipe
  ]
})
export class LoginYRegistroModule { }
