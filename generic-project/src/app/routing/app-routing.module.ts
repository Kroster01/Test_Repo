import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from '../principal/login-y-registro/login/login.component';

// import { MenuHeaderComponent } from '../principal/home/menu-header/menu-header.component';

const routes: Routes = [
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: '**', redirectTo: 'login', pathMatch: 'full'
  } // cuando la ruta no existe
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
    onSameUrlNavigation: 'reload',
    useHash: true,
    scrollPositionRestoration: 'enabled'
  })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
