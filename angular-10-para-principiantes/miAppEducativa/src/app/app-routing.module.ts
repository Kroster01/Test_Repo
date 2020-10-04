import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { MainComponent } from './componentes/main/main.component';
import { TiempoComponent } from './componentes/tiempo/tiempo.component';

const ruotes: Routes = [
  { path: 'main', component: MainComponent },
  { path: 'tiempo', component: TiempoComponent },
  { path: '', redirectTo: '/main', pathMatch: 'full' },
  { path: '**', component: MainComponent }
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(ruotes)
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
