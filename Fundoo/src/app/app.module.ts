import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { MaterialModule } from './material.module';
import { FlexLayoutModule } from "@angular/flex-layout";
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import {RegisterService} from './service/register.service';
import { serviceUrl } from './ServiceUrl/serviceurl.service';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { ForgotpasswordComponent } from './components/forgotpassword/forgotpassword.component';
import { ResetComponent } from './components/reset/reset.component';
import { SessionexpComponent } from './components/sessionexp/sessionexp.component';
import { NotesComponent } from './components/notes/notes.component';
import { RemainderComponent } from './components/remainder/remainder.component';
import { CardComponent } from './components/card/card.component';
import { EditnotesComponent } from './components/editnotes/editnotes.component';


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    DashboardComponent,
    ForgotpasswordComponent,
    ResetComponent,
    SessionexpComponent,
    NotesComponent,
    RemainderComponent,
    CardComponent,
    EditnotesComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    FlexLayoutModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
   ],
  providers: [RegisterService, serviceUrl],
  bootstrap: [AppComponent],
  entryComponents: [EditnotesComponent]
})
export class AppModule { }
