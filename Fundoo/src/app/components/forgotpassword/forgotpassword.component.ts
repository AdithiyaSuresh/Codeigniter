import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { LoginService } from 'src/app/service/login.service';

@Component({
  selector: 'app-forgotpassword',
  templateUrl: './forgotpassword.component.html',
  styleUrls: ['./forgotpassword.component.scss']
})
export class ForgotpasswordComponent implements OnInit {

  /**
    * @description email validation 
    */
  email = new FormControl('', [Validators.required, Validators.email]);
  usererror: string = "";
  model: any = {};

  constructor(private logService:LoginService) { }

  ngOnInit() {
  }

  forgot() {
    this.model = {"email":this.email.value}

    this.logService.userPasswordRecoveryData(this.model);
    
  }

}
