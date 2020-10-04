import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { MenuHeaderComponent } from '../principal/home/menu-header/menu-header.component';
import { LoginComponent } from '../principal/login-y-registro/login/login.component';
import { LoginYRegistroModule } from '../principal/login-y-registro/login-y-registro.module';

const routes: Routes = [
  {
    path: 'login',
    component: LoginComponent
    // loadChildren: () => import('../principal/login-y-registro/login-y-registro.module').then(mod => mod.LoginYRegistroModule)
  },
  {
    path: 'main',
    component: MenuHeaderComponent,
    // canActivate: [SessionGuard],
    children: [
      {
        path: 'test',
        loadChildren: () => import('../sections/test/test.module').then(mod => mod.TestModule)
      }
    ]
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
