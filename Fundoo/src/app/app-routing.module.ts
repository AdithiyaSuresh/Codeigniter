import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {LoginComponent} from './components/login/login.component';
import {RegisterComponent} from './components/register/register.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { ForgotpasswordComponent } from './components/forgotpassword/forgotpassword.component';
import { ResetComponent } from './components/reset/reset.component';
import { SessionexpComponent } from './components/sessionexp/sessionexp.component';
import { NotesComponent } from './components/notes/notes.component';
import { RemainderComponent } from './components/remainder/remainder.component';
import { ArchiveComponent } from './components/archive/archive.component';
import { TrashComponent } from './components/trash/trash.component';
import { LabelComponent } from './components/label/label.component';
import { DisplayemptyComponent } from './components/displayempty/displayempty.component';
import { LabelnotesComponent } from './components/labelnotes/labelnotes.component';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path:'', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  {path: 'forgotpassword', component: ForgotpasswordComponent},
  {path: 'reset', component:ResetComponent},
  {path: 'sessionexp', component:SessionexpComponent},
  { path: 'dashboard', component: DashboardComponent,
        children: [
          {
            path: 'notes',
            component: NotesComponent
          },
          {
            path: 'remainder',
            component: RemainderComponent
          },
          {
            path: 'archive',
            component: ArchiveComponent
          },
          {
            path: 'trash',
            component: TrashComponent
          },
          {
            path: 'labelnotes',
            component: LabelnotesComponent
          },
          {
            path: 'displayempty',
            component: DisplayemptyComponent
          }
        ]
      }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
