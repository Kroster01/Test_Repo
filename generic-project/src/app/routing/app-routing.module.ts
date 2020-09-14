import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: 'login',
    loadChildren: () => import('../principal/login-y-registro/login-y-registro.module').then(mod => mod.LoginYRegistroModule)
  },
  {
    path: '**', redirectTo: 'login', pathMatch: 'full'
  } // cuando la ruta no existe
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
