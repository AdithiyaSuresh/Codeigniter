import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { LoginService } from 'src/app/service/login.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-forgotpassword',
  templateUrl: './forgotpassword.component.html',
  styleUrls: ['./forgotpassword.component.scss']
})

export class ForgotpasswordComponent implements OnInit {

  model: any = {};
  usererror: string = "";

  /**
    * @description email validation 
    */
  email = new FormControl('', [Validators.required, Validators.email]);

  constructor(private router: Router,private logService:LoginService) { }

  ngOnInit() {
  }

  /**
   * @method forgot()
   * @return void
   * @description Function to recover the password
   */
  forgot() 
  {
    this.model = {"email":this.email.value}

    let obs = this.logService.userPasswordRecoveryData(this.model);
    obs.subscribe((res: any) => {
      if (res.message == "200") 
      {
        this.usererror = "reset link has been sent to your mail";
      } 
      else if(res.message == "400")
      {
        this.usererror = "something happened coudnot send the mail";
      }
      else
      {
        this.usererror = "user not registered";
      }
    });
  }

}
