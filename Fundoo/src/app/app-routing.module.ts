import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {LoginComponent} from './components/login/login.component';
import {RegisterComponent} from './components/register/register.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { ForgotpasswordComponent } from './components/forgotpassword/forgotpassword.component';
import { ResetComponent } from './components/reset/reset.component';
import { SessionexpComponent } from './components/sessionexp/sessionexp.component';


const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path:'', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'dashboard', component: DashboardComponent},
  {path: 'forgotpassword', component: ForgotpasswordComponent},
  {path: 'reset', component:ResetComponent},
  {path: 'sessionexp', component:SessionexpComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
