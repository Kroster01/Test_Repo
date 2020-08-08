import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
  providers: [AuthService]
})
export class LoginComponent implements OnInit {
  loginForm = new FormGroup({
    email: new FormControl(''),
    password: new FormControl('')
  });
  constructor(private authSvc: AuthService,
              private router: Router) { }

  ngOnInit(): void {
  }

  async onLogin(): Promise<void> {
    console.log('loginForm 2 -> ' + JSON.stringify(this.loginForm.value));
    try {
      const {email, password} = this.loginForm.value;
      const user = await this.authSvc.login(email, password);
      if (user) {
        this.router.navigate(['/home']);
      } else {
        console.log('Usuario no encontrado.');
      }
    } catch (error) {
      console.log('Error Login.' + error);
    }
  }
}
