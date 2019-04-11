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
import { ArchiveComponent } from './components/archive/archive.component';
import { TrashComponent } from './components/trash/trash.component';
import { LabelComponent } from './components/label/label.component';
import { AuthService as auth } from "./service/auth.service";
import {
  AuthService as social,
  SocialLoginModule,
  AuthServiceConfig,
  AuthService
} from "angular-6-social-login";
import { getAuthServiceConfigs } from  './socialloginConfig';
import { CookieService } from 'ngx-cookie-service';
import { SearchdataPipe } from './searchdata.pipe';
import { DisplayemptyComponent } from './components/displayempty/displayempty.component';


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
    EditnotesComponent,
    ArchiveComponent,
    TrashComponent,
    LabelComponent,
    SearchdataPipe,
    DisplayemptyComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    FlexLayoutModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    SocialLoginModule
   ],
  providers: [RegisterService,CookieService,serviceUrl,AuthService,auth,SocialLoginModule,
    {
    provide: AuthServiceConfig,
    useFactory: getAuthServiceConfigs
  }],
  bootstrap: [AppComponent],
  entryComponents: [EditnotesComponent,LabelComponent]
})
export class AppModule { }
