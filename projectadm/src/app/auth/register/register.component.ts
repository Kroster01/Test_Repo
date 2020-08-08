import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  registerForm = new FormGroup({
    email: new FormControl(''),
    password: new FormControl('')
  });
  constructor() { }

  ngOnInit(): void {
  }

  onRegister(): void {
    console.log('registerForm 2 -> ' + JSON.stringify(this.registerForm.value));
  }
}
